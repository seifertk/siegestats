<?php

namespace App\Http\Api;
use App\Http\Api\Traits\FetchJson;
use Illuminate\Support\Facades\Cache;

/**
 *  This class provides access to the R6stats API
 */
 class R6stats
 {
    use FetchJson;
    const URL = 'https://api.r6stats.com/api/v1';
    const CACHE_TIME = 15;

    /**
    * Fetches some basic operator properites: name, role, ctu, figure, badge, bust
    * The most recent ops only have a bust
    *
    * @return   json    Array of operators 
    */
    public static function getOperators()
    {
        return Cache::remember('r6stats_operators', static::CACHE_TIME, function() {
            return static::fetchJson(static::URL . "/database/operators");
        });
    }

    /**
    * Fetches some basic weapon properites: name, damage, fire_rate, clip_size, mobility_cost
    * Icons are from a Ubisoft cdn, but includes none of the DLC operator weapons
    *
    * @return   json    Array of weapons 
    */
    public static function getWeapons()
    {
        return Cache::remember('r6stats_weapons', static::CACHE_TIME, function() {
            return static::fetchJson(static::URL . "/database/weapons");
        });
    }

    /**
    * This is pretty much strictly worse then the R6DB api call
    * 
    * @return   json    Player object 
    */
    public function getPlayer(string $name, string $platform="uplay")
    {
        return Cache::remember("r6stats_player_${name}_${platform}", function() use ($name, $platform) {
                return static::fetchJson(static::URL . "/players/$name?platform=$platform");
        });
    }
 }
