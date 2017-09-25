<?php 

namespace App\Http\Api;

/**
 *  This class provides access to the R6db API using our unique x-app-id
 *
 *  NOTE: All GET requests must contain our x-app-id 
 */
class R6db {
    protected $URL = 'https://r6db.com/api/v2';
    protected $APP_ID = 'Boostin';

    /**
     * Searches for players by name and platform
     *
     * @param   string  $name
     * @param   string  $platform
     * @return  json    Array of 'basic' player objects    
     */
    public function getPlayers($name, $platform) {
        $curlHandle = curl_init($this->URL . '/players?name=' . $name . '&platform='. $platform);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['accepts: application/json', 'x-app-id: ' . $this->APP_ID]);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($curlHandle);
    }

    /**
     * Searches for a player by id
     *
     * @param   string  $id
     * @return  json    'Detailed' player json object
     */
    public function getPlayer($id) {
        $curlHandle = curl_init($this->URL . '/players/' . $id);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['accepts: application/json', 'x-app-id: ' . $this->APP_ID]);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($curlHandle);
    }

    /**
     *  Testing the route manually is getting me nothing
     */
    public function getLeaderboard() {

    }
}