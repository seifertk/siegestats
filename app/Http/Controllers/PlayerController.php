<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\R6db;
use App\Models\Api\Player;
use Auth;
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
        $user = Auth::user();
        if($user->uplay_id != null)
        {
            $arr = json_decode(R6db::getPlayer($user->uplay_id),TRUE)['stats']['operator'];
            ksort($arr);
            return view('player.operatorstats', compact('arr'));
        }
        else
        {
            Session::flash('message', 'No linked profile for user – ' . $user->email);
            return redirect()->route('index');
        }
    }

    /**
    * Compares the currently logged in users profile against anothers players and shows comparision
    * 
    */
    public function comparePlayers(Request $request)
    {
        //Create player object based on logged in user and user comparing against
        $player1 = new Player(R6db::getPlayer(Auth::user()->uplay_id));
        $player2 = new Player(R6db::getPlayer($request->get('player_id')));

        $players = array($player1, $player2);
        $compareData = array();

        //Store the players data in $compareData
        for($i =0; $i < 2;++$i)
        {
            $compareData[] = $players[$i]->getCompare();
        }

        //echo print_r($compareData, true);
        //echo print_r($compareData[0]['name'], true);

        //pass $compareData to modal
        return view('player.compare', compact('compareData'));
        //return redirect()->route('index');
    }
}
