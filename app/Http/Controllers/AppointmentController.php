<?php

namespace App\Http\Controllers;

use App\Models\UserBooking2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of user's appointments.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Check if user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $userId = $request->session()->get('user_id');
        
        // Get status filter from query parameter
        $statusFilter = $request->query('status');
        
        // Build query
        $query = UserBooking2::where('user_id', $userId)
                           ->orderBy('date', 'desc')
                           ->orderBy('time', 'desc');
        
        // Apply status filter if provided
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }
        
        $bookings = $query->get();
        
        return view('user.appointment', compact('bookings'));
    }

    /**
     * Display the specified appointment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        // Check if user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $userId = $request->session()->get('user_id');
        
        $booking = UserBooking2::where('id', $id)
                             ->where('user_id', $userId)
                             ->firstOrFail();
        
        return view('user.appointment-detail', compact('booking'));
    }

    /**
     * Show the form for editing the specified appointment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        // Check if user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $userId = $request->session()->get('user_id');
        
        $booking = UserBooking2::where('id', $id)
                             ->where('user_id', $userId)
                             ->firstOrFail();
        
        // Check if booking can be edited
        if (in_array($booking->status, ['Done', 'Cancelled'])) {
            return redirect()->route('user.appointment')
                           ->with('error', 'Cannot edit completed or cancelled appointments.');
        }
        
        return view('user.appointment-edit', compact('booking'));
    }

    /**
     * Update the specified appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Check if user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $userId = $request->session()->get('user_id');
        
        $booking = UserBooking2::where('id', $id)
                             ->where('user_id', $userId)
                             ->firstOrFail();
        
        // Check if booking can be edited
        if (in_array($booking->status, ['Done', 'Cancelled'])) {
            return redirect()->route('user.appointment')
                           ->with('error', 'Cannot edit completed or cancelled appointments.');
        }
        
        // Validate the request
        $validator = Validator::make($request->all(), [
            'service' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:1|max:150',
            'gender' => 'required|string|in:Male,Female,Other',
            'symptom' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        // Update the booking
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

        return redirect()->route('user.appointment')
                       ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Cancel the specified appointment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request, $id)
    {
        // Check if user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $userId = $request->session()->get('user_id');
        
        $booking = UserBooking2::where('id', $id)
                             ->where('user_id', $userId)
                             ->firstOrFail();
        
        // Check if booking can be cancelled
        if (in_array($booking->status, ['Done', 'Cancelled'])) {
            return redirect()->route('user.appointment')
                           ->with('error', 'Cannot cancel completed or already cancelled appointments.');
        }
        
        // Update status to Cancelled
        $booking->update(['status' => 'Cancelled']);
        
        return redirect()->route('user.appointment')
                       ->with('success', 'Appointment cancelled successfully.');
    }

    /**
     * Remove the specified appointment from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // Check if user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect()->route('user.login');
        }

        $userId = $request->session()->get('user_id');
        
        $booking = UserBooking2::where('id', $id)
                             ->where('user_id', $userId)
                             ->firstOrFail();
        
        $booking->delete();
        
        return redirect()->route('user.appointment')
                       ->with('success', 'Appointment deleted successfully.');
    }
}