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
}