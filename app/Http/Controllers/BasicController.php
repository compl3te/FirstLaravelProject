<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IpCheckRequest;
use App\Services\IpCheckService;

class BasicController extends Controller
{
    public function ipCheck()
    {
        return view('static.ipCheck');
    }

    public function ipCheckPost(IpCheckRequest $request, IpCheckService $service)
    {
        $result = $service->checkIp($request->input('ip'));
        return view('static.ipCheck', compact('result'));
    }

    public function ipCheckRes($ip, IpCheckService $service, Request $request)
    {
        $request->merge(['ip' => $ip]);
        $request->validate([
            'ip' => 'required|ip|not_regex:/^(http)/i'
        ], [
            'ip.ip' => 'Введен некорректный IP-адрес. Введите, например, 8.8.8.8',
            'ip.not_regex' => 'Введите только IP-адрес в формате 8.8.8.8'
        ]);

        $ipInfo = $service->checkIp($ip);
        
        if (!$ipInfo) {
            return response()->json(['error' => 'Информация об IP-адресе не найдена']);
        }

        return response()->json($ipInfo);
    }
}