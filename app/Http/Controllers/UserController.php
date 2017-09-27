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
        dd($request->input('player_id'));
        $playerid = $request->input('player_id');
        $user = Auth::user();
        $user->user_id = $playerid;
        $user->update();

        //DB::table('users')->where('id', $user->id)->update(['user_id' => $playerid]);

        Session::flash('message', 'User ' . $user->name . ' successfully linked with Player ' . $playerid);

        return redirect()->route('index');
    }
}