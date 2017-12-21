<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Api\R6db;

class LeaderboardController extends Controller
{
    public function getLeaderboard(Request $request)
    {
        $stat = $request->input('stat');
        $platform = $request->input('platform');

        if (is_null($stat) || is_null($platform)) {
            return view('leaderboard', ['players' => []]);
        }
        $results = json_decode(R6db::getLeaderboard($stat, $platform));

        // +"id": "7925e347-b18a-4c63-bd86-fc02c2af8d89"
        // +"userid": null
        // +"name": "GR4M4T1K"
        // +"placement": 1
        // +"platform": "PC"
        // +"value": 63.67353955064
        //dd($results);

        return view('leaderboard', ['players' => $results]);
    }
}