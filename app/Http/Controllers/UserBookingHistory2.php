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
        // Use Laravel auth or session-based login
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect()->route('user.login')
                ->with('error', 'Please login to view your booking history.');
        }

        // Optional status filter from ?status=Pending
        $status = $request->query('status');

        // Fetch bookings with optional status filter
        $bookings = UserBooking2::query()
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('user.history', compact('bookings'));
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect()->route('user.login');
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
            return redirect()->back()->withErrors($validator)->withInput();
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

        return redirect()->route('user.history')
            ->with('success', 'Appointment booked successfully!');
    }

    /**
     * Display a single booking
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

        // Only allow cancelling Pending/Confirmed bookings
        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return redirect()->route('user.history')
                ->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update(['status' => 'Cancelled']);

        return redirect()->route('user.history')
            ->with('success', 'Appointment cancelled successfully.');
    }

    /**
     * Delete booking
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
