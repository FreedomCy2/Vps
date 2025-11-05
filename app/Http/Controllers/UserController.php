<?php

namespace App\Http\Controllers;

use App\Models\UserBooking;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Edit a booking
    public function edit($id)
    {
        // Ensure the booking exists and belongs to the logged-in user
        $booking = UserBooking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.editbooking', compact('booking'));
    }

    // Update a booking
    public function update(Request $request, $id)
    {
        $request->validate([
            'service' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required|string',
            'symptom' => 'required|string',
        ]);

        $booking = UserBooking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $booking->update($request->all());

        return redirect()->route('user.history')
            ->with('success', 'Booking updated successfully');
    }

    // Show profile page
    public function profile()
    {
        // Get the latest booking for the logged-in user
        $latestBooking = UserBooking::where('user_id', auth()->id())
            ->latest()
            ->first();

        return view('user.profile', compact('latestBooking'));
    }

    // Show service page
    public function service()
    {
        return view('user.service');
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        auth()->user()->update($validated);

        return back()->with('success', 'Profile updated successfully');
    }

    // Update profile picture
    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            auth()->user()->update(['profile_picture' => $path]);
        }

        return back()->with('success', 'Profile picture updated successfully');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->new_password)
        ]);

        return back()->with('success', 'Password updated successfully');
    }
}
