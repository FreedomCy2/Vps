<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class DoctorForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('doctor.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:doctor_login,email', // Changed from 'doctor' to 'doctor_login'
        ]);

        $status = Password::broker('doctors')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}