<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionUserController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($attributes)) {
            $request->session()->regenerate();
            return redirect('/jobs');
        };

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function destroy() {
        Auth::logout();
        return redirect('/');
    }
}
