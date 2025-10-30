<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;

class BookingController extends Controller
{
    public function create()
    {
        $doctors = User::where('role', 'doctor')->get();
        return view('patient.booking', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'doctor_id' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Appointment::create([
            'patient_name' => $request->name,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Appointment request sent!');
    }
}
