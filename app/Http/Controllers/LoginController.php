<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index () {
        if (Auth::check()) {
            return redirect()->route('home-after-login');
        }
        return view('pages.auth.login');
    }

    public function action (Request $request) {
        $loginResult = Auth::attempt(['email' => $request->email, 'password' => $request->password], remember: $request->has('remember-me'));

        if ($loginResult == true) {
            return redirect()->route('home-after-login');
        } else {
            return redirect()->route('login')->withErrors([]);
        }
    }
}
