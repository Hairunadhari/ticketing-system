<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',   // ← sesuaikan
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8|confirmed',
            'role'      => 'required|in:it_infra,it_helpdesk,user',
        ]);

        User::create([
            'name'     => $validatedData['full_name'],  // ← mapping ke kolom 'name' di DB
            'email'    => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role'     => $validatedData['role'],
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }
}
