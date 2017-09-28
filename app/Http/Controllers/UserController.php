<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Session;

class UserController extends Controller 
{
    /**
     * Links a R6 account to a users Siege Stats account
     *
     * @param   Request $request
     * @return  view    \index.blade.php
     */
    public function link(Request $request)
    {
        $playerid = $request->input('player_id');
        $playername = $request->input('player_name');
        $user = Auth::user();
        $user->uplay_id = $playerid;
        $user->update();

        Session::flash('message', 'User ' . $user->email . ' successfully linked with Player ' . $playername);

        return redirect()->route('index');
    }
}