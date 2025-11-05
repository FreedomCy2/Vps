<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in as admin
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Registration methods
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        // Validate the registration data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Create the admin user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Log the user in automatically after registration
            Auth::login($user);

            // Redirect to admin dashboard with success message
            return redirect()->route('admin.login')->with('success', 'Admin account created successfully!');

        } catch (\Exception $e) {
            // If there's an error, redirect back with error message
            return back()->withErrors([
                'registration' => 'There was an error creating your account. Please try again.'
            ])->withInput($request->except('password', 'password_confirmation'));
        }
    }

    public function showForgotPasswordForm()
    {
        return view('admin.forgot-password');
    }
}