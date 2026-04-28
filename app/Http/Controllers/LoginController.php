<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin(){
        return view('login');
    }
    
    public function verifLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)
                    ->where('password', $password)
                    ->first();

        if ($user) {
            if ($user->role === 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/client');
            }
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }
}
