<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // ✅ validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        // ✅ role wise login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ])) {

            $request->session()->regenerate();

            return redirect('/' . $request->role . '/dashboard');
        }

        return back()->with('error', '❌ Invalid credentials or role');
    }
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:3',
        'role' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    return redirect('/login')->with('success', '✅ Account created!');
}
}