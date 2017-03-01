<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Passport\Passport;

class AuthController extends Controller
{


    public function logout(Request $request)
    {
        Auth::logout();

        // Delete all session data and get a new
        // session id for security
        $request->session()->flush();
        $request->session()->regenerate();

        // Go back to login page
        return redirect('/')

            // Delete the passport authentication token
            ->withCookie(Cookie::forget(Passport::cookie()));
    }

}
