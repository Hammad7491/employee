<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginform()
    {
        return view('auth.login');
    }

    public function registerform()
    {
        return view('auth.register');
    }

    public function error403()
    {
        return view('auth.errors.error403');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginform');
    }

    /**
     * Admin-only registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Admin');

        return redirect()->route('loginform')->with('success', 'Admin registered successfully.');
    }

    /**
     * Only admin login allowed
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        $user = Auth::user();

        // Check if user is Admin
        if (! $user->hasRole('Admin')) {
            Auth::logout();
            return back()->withErrors(['email' => 'Access denied. Admins only.'])->withInput();
        }

        return redirect()->route('admin.dashboard');
    }
}
