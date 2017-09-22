<?php 

namespace App\Http\Api;

class R6db {
    protected $URL = 'https://r6db.com/api/v2';
    protected $APP_ID = 'Boostin';

    public function getPlayers($name) {
        $curlHandle = curl_init($this->URL . '/players?name=' . $name);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['accepts: application/json', 'x-app-id: ' . $this->APP_ID]);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($curlHandle);
    }

    public function getPlayer($id) {
        $curlHandle = curl_init($this->URL . '/players/' . $id);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['accepts: application/json', 'x-app-id: ' . $this->APP_ID]);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($curlHandle);
    }

    public function getLeaderboard() {

    }
}