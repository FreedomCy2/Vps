<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DoctorRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('doctor.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctor_login,email',
            'password' => 'required|confirmed|min:6',
            'terms' => 'accepted',
        ]);

        Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/doctor/login')->with('success', 'Account created successfully! Please login.');
    }
}
