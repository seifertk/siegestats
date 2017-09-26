<?php

namespace App\Http\Api;

/**
 *  This class provides access to the R6stats API
 */
 class R6stats {
    protected static $URL = 'https://api.r6stats.com/api/v1';

    /**
    * Fetches some basic operator properites: name, role, ctu, figure, badge, bust
    * The most recent ops only have a bust
    *
    * @return   json    Array of operators 
    */
    public static function getOperators() {
        $curlHandle = curl_init(R6stats::$URL . '/database/operators');
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['accepts: application/json']);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($curlHandle);
    }

    /**
    * Fetches some basic weapon properites: name, damage, fire_rate, clip_size, mobility_cost
    * Icons are from a Ubisoft cdn, but includes none of the DLC operator weapons
    *
    * @return   json    Array of weapons 
    */
    public static function getWeapons() {
        $curlHandle = curl_init(R6stats::$URL . '/database/weapons');
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['accepts: application/json']);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($curlHandle);
    }

    /**
    * This is pretty much strictly worse then the R6DB api call
    * 
    * @return   json    Player object 
    */
    public static function getPlayer($name, $platform="uplay") {
        $curlHandle = curl_init(R6stats::$URL . '/players/' . $name . '?platform=' .$platform);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['accepts: application/json']);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($curlHandle);
    }
 }