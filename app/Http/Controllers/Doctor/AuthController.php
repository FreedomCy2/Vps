<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle login POST for doctors.
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $doctor = Doctor::where('email', $data['email'])->first();

        if (! $doctor || ! Hash::check($data['password'], $doctor->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        // store doctor id in session to mark as logged-in for doctor area
        $request->session()->put('doctor_id', $doctor->id);
        
            // regenerate session id to prevent fixation
            $request->session()->regenerate();

        return redirect()->route('doctor.dashboard');
    }

    /**
     * Logout doctor.
     */
    public function logout(Request $request)
    {
        $request->session()->forget('doctor_id');
        $request->session()->regenerateToken();
        return redirect()->route('doctor.login');
    }
}