<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBooking;
use Illuminate\Support\Facades\Auth;

class BookingConfirmationController extends Controller
{
    public function show(Request $request)
    {
        $bookingId = session('intended_booking');

        if (!$bookingId) {
            return redirect()->route('user.booking')->with('error', 'No booking selected.');
        }

        $booking = UserBooking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$booking) {
            return redirect()->route('user.booking')->with('error', 'Booking not found.');
        }

        // Clear session after confirming booking
        session()->forget('intended_booking');

        return view('user.bookingconfirm', compact('booking'));
    }
}
