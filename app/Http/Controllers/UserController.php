<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $playerid = $request->input('playerid');
        $user = Auth::user()->id;

        DB::table('users')->where('id', $user->id)->update(['user_id' => $playerid]);

        Session::flash('message', 'User ' . $user . ' successfully linked with Player ' . $playerid);

        return redirect()->route('index');
    }
}