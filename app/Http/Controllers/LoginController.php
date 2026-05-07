<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLogin(){
        return view('login');
    }
    
    public function verifLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user && $validated['password'] === $user->password) {
            Auth::login($user);
            if ($user->role === 'admin') {
                return redirect()->route('admin');
            }
            return redirect()->route('client');
        } else {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Wrong email or password.');
        }
    }
}
