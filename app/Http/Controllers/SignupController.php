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
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $birthdate = $request->birthdate;
        $gender = $request->gender;
        $email = $request->email;
        $password = $request->password;

        User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'datenaissance' => $birthdate,
            'gender' => $gender,
            'email' => $email,
            'password' => $password,
        ]);

        return redirect('/login')->with('success', 'Account created successfully. Please login.');
    }
}
