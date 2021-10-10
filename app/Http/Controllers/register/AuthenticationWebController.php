<?php

namespace App\Http\Controllers\register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationWebController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }
}
