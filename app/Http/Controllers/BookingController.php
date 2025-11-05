<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingHistory;

class BookingController extends Controller
{
    // 🧍‍♀️ User booking form
    public function create()
    {
        return view('user.booking');
    }

    // 🧍‍♀️ Store booking
    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'age' => 'required|integer',
            'gender' => 'required',
        ]);

        Booking::create($request->all());

        return redirect()->back()->with('success', 'Booking submitted successfully!');
    }

    // 🩺 Doctor view all bookings (only pending ones)
    public function index()
    {
        // Only show pending bookings for decision making
        $bookings = Booking::whereIn('status', ['pending', null])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('doctor.appointments', compact('bookings'));
    }

    // 🩺 Doctor view history of all processed bookings
    public function history()
    {
        $historyRecords = BookingHistory::orderBy('action_date', 'desc')
            ->paginate(20);

        return view('doctor.history', compact('historyRecords'));
    }

    // 🩺 Update booking status (Accept/Decline) and save to history
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,declined'
        ]);

        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->status;
        $booking->status = $request->status;
        $booking->save();

        // Save to history
        BookingHistory::createFromBooking(
            $booking, 
            'Status updated', 
            'Dr. Sarah Johnson', // You can get this from authenticated doctor
            "Status changed from {$oldStatus} to {$request->status}"
        );

        $statusText = ucfirst($request->status);
        return redirect()->back()->with('success', "Booking {$statusText} successfully! Record saved to history.");
    }

    // Update an existing booking (from admin edit form)
    public function update(Request $request, $id)
    {
        $request->validate([
            'service' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'age' => 'required|integer',
            'gender' => 'required',
            'symptom' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update($request->only([
            'service', 'date', 'time', 'name', 'email', 'phone', 'age', 'gender', 'symptom', 'status'
        ]));

        return redirect()->back()->with('success', 'Booking updated successfully!');
    }

    // Delete booking but save to history first
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Save to history before deletion
        BookingHistory::createFromBooking(
            $booking, 
            'deletion', 
            'Dr. Sarah Johnson', // You can get this from authenticated doctor
            'Booking deleted by doctor'
        );

        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully! Record saved to history.');
    }

    // 🩺 Doctor accept booking (alternative method)
    public function accept($id)
    {
        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->status;
        $booking->status = 'accepted';
        $booking->save();

        // Save to history
        BookingHistory::createFromBooking(
            $booking, 
            'Status updated', 
            'Dr. Sarah Johnson',
            "Status changed from {$oldStatus} to accepted"
        );

        return back()->with('success', 'Booking accepted! Record saved to history.');
    }

    // 🩺 Doctor decline booking (alternative method)
    public function decline($id)
    {
        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->status;
        $booking->status = 'declined';
        $booking->save();

        // Save to history
        BookingHistory::createFromBooking(
            $booking, 
            'Status updated', 
            'Dr. Sarah Johnson',
            "Status changed from {$oldStatus} to declined"
        );

        return back()->with('success', 'Booking declined! Record saved to history.');
    }
}