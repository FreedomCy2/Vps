<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBooking; // Make sure this model exists

class UserBookingController extends Controller
{
    /**
     * Show the booking form.
     */
    public function create()
    {
        return view('user.information');
    }

    /**
     * Store booking information and redirect to login page.
     */
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'age' => 'required|integer|min:0|max:120',
            'gender' => 'required|string|max:50',
            'symptom' => 'nullable|string',
        ]);

        // Save to database
        UserBooking::create($validatedData);

        // Redirect to dashboard
        return redirect()->route('user.dashboard')->with('success', 'Booking information saved successfully!');
    }
}
