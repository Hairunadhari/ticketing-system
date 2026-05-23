<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'role' => 'required|in:User,IT Helpdesk,IT Infra',
        ]);

        Auth::user()->update($request->only('name', 'email', 'role'));

        return back()->with('success', 'Profile updated successfully.');
    }
}
