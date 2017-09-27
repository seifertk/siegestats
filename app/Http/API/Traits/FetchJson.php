<?php

namespace App\Http\Api\Traits;

trait FetchJson
{
    protected static function fetchJson(string $url, array $headers = [])
    {
        $headers = array_merge([
            'accepts: application/json'
        ], $headers);

        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

        return curl_exec($curlHandle);
    }
}
