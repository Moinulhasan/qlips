<?php

namespace App\Http\Controllers\register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationWebController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');

    }
}
