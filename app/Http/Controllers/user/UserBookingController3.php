<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserBooking3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBookingController3 extends Controller
{
    /**
     * Display a listing of active appointments (not cancelled)
     */
    public function index(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        // Get all bookings except cancelled, done, or hidden ones
        $bookings = UserBooking3::where('is_hidden', false)
            ->whereNotIn('status', ['Cancelled', 'Done'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('user.appointment', compact('bookings'));
    }

    /**
     * Display a listing of cancelled/completed appointments (history)
     */
    public function history(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        // Get only cancelled and done bookings that are not hidden
        $bookings = UserBooking3::where('is_hidden', false)
            ->whereIn('status', ['Cancelled', 'Done'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('user.history', compact('bookings'));
    }

    /**
     * Show the form for editing the specified booking
     */
    public function edit(Request $request, $id)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking3::where('id', $id)
            ->where('is_hidden', false)
            ->firstOrFail();

        return view('user.booking-edit', compact('booking'));
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, $id)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking3::where('id', $id)
            ->where('is_hidden', false)
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'service' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:1|max:150',
            'gender' => 'required|in:Male,Female,Other',
            'symptom' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $booking->update($request->only([
            'service',
            'date',
            'time',
            'name',
            'email',
            'phone',
            'age',
            'gender',
            'symptom'
        ]));

        return redirect()->route('user.appointments')
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Cancel the specified booking
     */
    public function cancel(Request $request, $id)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking3::where('id', $id)
            ->where('is_hidden', false)
            ->firstOrFail();
        
        $booking->update(['status' => 'Cancelled']);

        return redirect()->route('user.history')
            ->with('success', 'Appointment cancelled successfully!');
    }

    /**
     * Show the details of a specific booking
     */
    public function show(Request $request, $id)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking3::where('id', $id)
            ->where('is_hidden', false)
            ->firstOrFail();

        return view('user.booking-details', compact('booking'));
    }

    /**
     * Hide the specified booking from view (soft delete)
     * The record remains in the database but is hidden from user view
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking3::where('id', $id)
            ->where('is_hidden', false)
            ->firstOrFail();
        
        // Mark as hidden instead of deleting
        $booking->update(['is_hidden' => true]);

        return redirect()->route('user.history')
            ->with('success', 'Appointment removed from view successfully!');
    }
}