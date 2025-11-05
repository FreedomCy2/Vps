<?php

namespace App\Http\Controllers;

use App\Models\UserEdit;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEditController extends Controller
{
    // Modify or reschedule an appointment
    public function modify($id)
    {
        $booking = UserHistory::where('id', $id)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        return view('user.modify', compact('booking'));
    }

    // Save modification record
    public function store(Request $request, $id)
    {
        $request->validate([
            'new_service' => 'required|string',
            'new_date' => 'required|date',
            'new_time' => 'required',
        ]);

        $history = UserHistory::findOrFail($id);

        UserEdit::create([
            'user_id' => Auth::id(),
            'history_id' => $history->id,
            'old_service' => $history->service,
            'new_service' => $request->new_service,
            'new_date' => $request->new_date,
            'new_time' => $request->new_time,
            'reason' => $request->reason,
        ]);

        // Update main appointment table
        $history->update([
            'service' => $request->new_service,
            'date' => $request->new_date,
            'time' => $request->new_time,
            'status' => 'Pending',
        ]);

        return redirect()->route('user.history')
                         ->with('success', 'Appointment updated successfully!');
    }

    // Cancel booking
    public function cancel($id)
    {
        $booking = UserHistory::where('id', $id)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        $booking->update(['status' => 'Cancelled']);

        return redirect()->route('user.history')
                         ->with('success', 'Booking cancelled successfully!');
    }
}
