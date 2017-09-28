<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\R6db;
use Session;


class PlayerController extends Controller 
{
    /**
     * Searches for players by name and platform and 
     * shows player(s) that match criteria
     *
     * @param   Request  $request
     * @return  view    \player\ (index.blade or profile.blade)
     */
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

    /**
     * Searches for player using user id and shows related player data 
     *
     * @param   string  $id
     * @return  view    \player\profile.blade.php
     */
    public function show(Request $request, $id = null)
    {
        if ($id) {
            $player = R6db::getPlayer($id);
            return view('player.profile', ['player' => $player]);
        } elseif ($request->has('id')) {
            $player = R6db::getPlayer($request->get('id'));
            return view('player.profile', ['player' => $player]);
        }
        return redirect()->back()->withError('No linked profile found');
    }

    /**
     * Shows all operators and their stats for a user.
     * (Will need to use user id in future)
     *
     * @param   string  $id
     * @return  view    \player\operatorstats.blade.php
     */
    public function operatorStats()
    {
        $arr = json_decode(R6db::getPlayer('7d7ac237-a3da-45d3-9e41-6ed133a2d63c'),TRUE)['stats']['operator'];
        ksort($arr);
        return view('player.operatorstats', compact('arr'));
    }
}
