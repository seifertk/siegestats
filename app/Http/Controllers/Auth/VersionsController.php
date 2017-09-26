<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class VersionsController extends Controller
{
    protected function showLoginForm()
    {
        return view('user.versions');
    }
}
