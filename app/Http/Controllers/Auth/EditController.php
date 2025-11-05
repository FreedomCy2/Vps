<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class EditController extends Controller
{
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'service' => $request->service,
            'doctor'  => $request->doctor,
            'date'    => $request->date,
            'time'    => $request->time,
            'notes'   => $request->notes,
        ]);

        return redirect()->route('user.history')->with('success', 'Booking updated successfully.');
    }
}
