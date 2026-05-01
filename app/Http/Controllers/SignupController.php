<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function showSignup(){
        return view('signup');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date|before_or_equal:today',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'datenaissance' => $validated['birthdate'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'client',
        ]);

        return redirect('/login')->with('success', 'Account created successfully. Please login.');
    }
}
