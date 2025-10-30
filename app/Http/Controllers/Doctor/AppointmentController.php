<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function notifications()
    {
        $appointments = Appointment::where('doctor_id', auth()->id())->get();
        return view('doctor.notifications', compact('appointments'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment updated!');
    }
}
