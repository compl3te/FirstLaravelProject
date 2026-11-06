<?php

namespace App\Services;

use App\Models\IpCheck;
use Illuminate\Support\Facades\Http;

class IpCheckService
{
    public function checkIp($ip)
    {
        $ipCheck = IpCheck::where('ip', $ip)->first();
        if ($ipCheck) {
            return $ipCheck;
        }  
        
        $ipwho = Http::timeout(10)->get("https://ipwho.is/{$ip}")->json();
        $rdap  = Http::timeout(10)->get("https://rdap.org/ip/{$ip}")->json();
        
        $country = $ipwho['country'] ?? null;
        $org = $ipwho['connection']['org'] ?? $ipwho['isp'] ?? null;
        $nameReg = $rdap['name'] ?? null;
        
        $start = $rdap['startAddress'] ?? null;
        $end = $rdap['endAddress'] ?? null;
        $ipRange = ($start && $end) ? "{$start} - {$end}" : null;
        
        $ipCheck = new IpCheck();
        $ipCheck->ip = $ip;
        $ipCheck->country = $country;
        $ipCheck->organization = $org;
        $ipCheck->netname = $nameReg;
        $ipCheck->ip_range = $ipRange;
        $ipCheck->save();
        
        return $ipCheck;   
    }
}