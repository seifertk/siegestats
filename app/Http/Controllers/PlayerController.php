<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\R6db;
use Session;

class PlayerController extends Controller 
{
    public function search(Request $request)
    {
        $name = $request->input('name');
        $platform = $request->input('platform');
        $results = json_decode(R6db::getPlayers($name, $platform));

        if(count($results) > 1) {
            return view('player.index', ['players' => $results]);
        } elseif (count($results) == 0) {
            Session::flash('message', 'No players found with the name – ' . $name);
            return redirect()->route('index');
        }

        $id = $results[0]->id;
        return redirect()->route('profile', ['id' => $id]);
    }

    public function show($id)
    {
        return view('player.profile', ['id' => $id]);
    }
}