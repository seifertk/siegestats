<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\R6db;

class PlayerController extends Controller 
{
    public function show()
    {
        return view('player.search');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $platform = $request->input('platform');

        $api = new R6db();
        $search = json_decode($api->getPlayers($name, $platform));
        dd($api->getPlayers($name, $platform));
        $filtered =  '';       

        if(count($search) == 1) {
            var_dump($search);
            dd("One Found");
        } elseif (count($search) == 0) {
            return view('player.search');
            dd("None Found");
        } else {
            var_dump(json_encode($search));
            dd(count($search) . " Found");
        }
        return view('player.search', ['name' => $name]);
    }
}