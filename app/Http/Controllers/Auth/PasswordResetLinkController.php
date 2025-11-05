<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle sending of the password reset link.
     */
    public function store(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        // Send the reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Redirect back with status
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
}
