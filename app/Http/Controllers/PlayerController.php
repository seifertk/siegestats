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

        return redirect()->route('profile', ['id' => 3]);
    }

    public function show($id)
    {
        Session::flash('message', $id);
        return view('player.profile');
    }
}