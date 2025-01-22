<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function AuthPage()
    {
        if (Auth::check()) {
            return redirect()->route("rates-index");
        }
        return view('pages.login');
    }

    public function AuthAction(AuthRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->route("rates-index");
        }
        session()->flash('error',  __("login.error"));

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function dashboard()
    {
        return view('pages.terminal');
    }

}
