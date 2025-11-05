<?php

namespace App\Http\Controllers;

use App\Models\UserBooking;
use Illuminate\Http\Request;

class UserBookingHistoryController extends Controller
{
    public function index(Request $request)
    {
        $userEmail = $request->session()->get('user_email');
        
        if (!$userEmail) {
            return redirect()->route('user.login');
        }
        
        $bookings = UserBooking::where('email', $userEmail)
                              ->orderBy('created_at', 'desc')
                              ->get();
                              
        return view('user.history', compact('bookings'));
    }

    public function show(Request $request, $id)
    {
        $userEmail = $request->session()->get('user_email');
        
        if (!$userEmail) {
            return redirect()->route('user.login');
        }
        
        $booking = UserBooking::where('id', $id)
                              ->where('email', $userEmail)
                              ->first();

        if (!$booking) {
            return redirect()->route('user.history')->with('error', 'Booking not found.');
        }

        return view('user.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $userEmail = $request->session()->get('user_email');
        
        if (!$userEmail) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking::where('id', $id)
                              ->where('email', $userEmail)
                              ->first();

        if (!$booking) {
            return redirect()->route('user.history')->with('error', 'Booking not found.');
        }

        // Validate the request
        $request->validate([
            'service' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'symptom' => 'nullable|string',
        ]);

        // Update the booking
        $booking->update([
            'service' => $request->service,
            'date' => $request->date,
            'time' => $request->time,
            'symptom' => $request->symptom,
            'status' => 'Pending', // Reset status to pending when edited
        ]);

        return redirect()->route('user.history')->with('success', 'Appointment updated successfully!');
    }

    public function cancel(Request $request, $id)
    {
        $userEmail = $request->session()->get('user_email');
        
        if (!$userEmail) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking::where('id', $id)
                              ->where('email', $userEmail)
                              ->first();

        if (!$booking) {
            return redirect()->route('user.history')->with('error', 'Booking not found.');
        }

        // Update status to cancelled
        $booking->update(['status' => 'Cancelled']);

        return redirect()->route('user.history')->with('success', 'Appointment cancelled successfully!');
    }
}
