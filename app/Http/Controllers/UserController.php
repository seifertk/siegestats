<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class UserController extends Controller 
{
    public function grab($email)
    {
        $user = DB::table('users')->where('email', $email);

        return view('player_home', $user);
    }
}