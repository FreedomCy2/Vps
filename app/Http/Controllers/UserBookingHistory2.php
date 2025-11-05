<?php

namespace App\Http\Controllers;

use App\Models\UserBooking2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBookingHistory2 extends Controller
{
    /**
     * Display a listing of user's bookings
     */
    public function index(Request $request)
    {
        // Get user_id from session
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('user.login')->with('error', 'Please login to view your booking history.');
        }

        // Get status filter from query string
        $status = $request->query('status');

        // Fetch bookings with optional status filter
        $bookings = UserBooking2::byUser($userId)
            ->byStatus($status)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('user.history', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create(Request $request)
    {
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('user.login');
        }

        return view('user.information');
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $userId = $request->session()->get('user_id');

        $validator = Validator::make($request->all(), [
            'service' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:1|max:150',
            'gender' => 'required|string|in:Male,Female,Other',
            'symptom' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        UserBooking2::create([
            'user_id' => $userId,
            'service' => $request->service,
            'date' => $request->date,
            'time' => $request->time,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'age' => $request->age,
            'gender' => $request->gender,
            'symptom' => $request->symptom,
            'status' => 'Pending',
        ]);

        return redirect()->route('user.history')->with('success', 'Appointment booked successfully!');
    }

    /**
     * Display the specified booking
     */
    public function show(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking2::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        return view('user.booking-detail', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking
     */
    public function edit(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking2::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$booking->canBeEdited()) {
            return redirect()->route('user.history')
                ->with('error', 'This booking cannot be edited.');
        }

        return view('user.booking-edit', compact('booking'));
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking2::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$booking->canBeEdited()) {
            return redirect()->route('user.history')
                ->with('error', 'This booking cannot be edited.');
        }

        $validator = Validator::make($request->all(), [
            'service' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:1|max:150',
            'gender' => 'required|string|in:Male,Female,Other',
            'symptom' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $booking->update([
            'service' => $request->service,
            'date' => $request->date,
            'time' => $request->time,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'age' => $request->age,
            'gender' => $request->gender,
            'symptom' => $request->symptom,
        ]);

        return redirect()->route('user.history')
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Cancel the specified booking
     */
    public function cancel(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking2::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$booking->canBeCancelled()) {
            return redirect()->route('user.history')
                ->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update(['status' => 'Cancelled']);

        return redirect()->route('user.history')
            ->with('success', 'Appointment cancelled successfully.');
    }

    /**
     * Remove the specified booking from storage (soft delete by status)
     */
    public function destroy(Request $request, $id)
    {
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('user.login');
        }

        $booking = UserBooking2::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $booking->delete();

        return redirect()->route('user.history')
            ->with('success', 'Booking deleted successfully.');
    }
}