<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBooking;

class AppointmentController extends Controller
{
    public function index()
    {
        // Load bookings from the user_bookings table
        $bookings = UserBooking::orderByDesc('date')->orderBy('time')->get();

        return view('doctor.appointments', compact('bookings'));
    }

    public function updateStatus(Request $request, UserBooking $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,declined',
        ]);

        // update the booking status (assign and save to avoid mass-assignment issues)
        $appointment->status = $validated['status'];
        $appointment->save();

        return back()->with('status', 'Appointment ' . $validated['status'] . ' successfully.');
    }
}
