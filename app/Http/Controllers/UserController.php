<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Session;

class UserController extends Controller 
{
    public function grab($email)
    {
        $user = DB::table('users')->where('email', $email);

        return view('player_home', $user);
    }

    public function link(Request $request)
    {
        //dd($request->input('player_id'));
        $playerid = $request->input('player_id');
        $playername = $request->input('player_name');
        $user = Auth::user();
        $user->user_id = $playerid;
        $user->update();

        //DB::table('users')->where('id', $user->id)->update(['user_id' => $playerid]);

        Session::flash('message', 'User ' . $user->email . ' successfully linked with Player ' . $playername);

        return redirect()->route('index');
    }
}