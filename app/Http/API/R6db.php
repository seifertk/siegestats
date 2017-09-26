<?php 

namespace App\Http\Api;

use App\Http\Api\Traits\FetchJson;
use Illuminate\Support\Facades\Cache;

/**
 *  This class provides access to the R6db API using our unique x-app-id
 *
 *  NOTE: All GET requests must contain our x-app-id 
 */
class R6db
{
    use FetchJson;
    const URL = 'https://r6db.com/api/v2';
    const HEADERS = ['x-app-id: Boostin'];
    const CACHE_TIME = 15;

    /**
     * Searches for players by name and platform
     *
     * @param   string  $name
     * @param   string  $platform
     * @return  json    Array of 'basic' player objects    
     */
    public static function getPlayers(string $name, string $platform)
    {
        return Cache::remember("r6db_getplayers_${name}_${platform}", static::CACHE_TIME, function() use ($name, $platform) {
            return static::fetchJson(static::URL . "/players?name=${name}&platform=${platform}", static::HEADERS);
        });
    }

    /**
     * Searches for a player by id
     *
     * @param   string  $id
     * @return  json    'Detailed' player json object
     */
    public static function getPlayer($id)
    {
        return Cache::remember("r6db_getplayer_$id", static::CACHE_TIME, function() use ($id) {
            return static::fetchJson(static::URL . "/players/$id", static::HEADERS);
        });
    }

    /**
     *  Testing the route manually is getting me nothing
     */
    public static function getLeaderboard()
    {
        //
    }
}
