<?php

namespace App\Services;

use App\Models\IpCheck;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IpCheckService
{
    public function checkIp($ip)
    {
        $ipCheck = IpCheck::where('ip', $ip)->first();
        if ($ipCheck) {
            return $ipCheck;
        }  
        
        $country = null;
        $org = null;
        $nameReg = null;
        $ipRange = null;
        
        try {
            $ipwho = Http::timeout(10)->get("https://ipwho.is/{$ip}")->json();
            $country = $ipwho['country'] ?? null;
            $org = $ipwho['connection']['org'] ?? $ipwho['isp'] ?? null;
        } catch (\Exception $e) {
            Log::warning("Ошибка при запросе к ipwho.is для IP {$ip}: " . $e->getMessage());
        }

        try {
            $rdap  = Http::timeout(10)->get("https://rdap.org/ip/{$ip}")->json();
            $nameReg = $rdap['name'] ?? null;

            $start = $rdap['startAdress'] ?? null;
            $end = $rdap['endAdress'] ?? null;
            $ipRange = ($start && $end) ? "{start} - {end}" : null; 
        } catch (\Exception $e) {
            Log::warning("Ошибка при запросе к rdap.org для IP {$ip}: " . $e->getMessage());
        }

        if (!$country && !$org && !$nameReg && !$ipRange) {
            return null;
        }

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