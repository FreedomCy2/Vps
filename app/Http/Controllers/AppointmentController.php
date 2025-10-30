<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Patient booking form
    public function create()
    {
        return view('appointments.create');
    }

    // Patient stores appointment
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => Auth::id(),
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.create')->with('success', 'Appointment booked successfully!');
    }

    // Doctor views their appointments
    public function doctorIndex()
    {
        $appointments = Appointment::where('doctor_id', Auth::id())->get();
        return view('appointments.doctor_index', compact('appointments'));
    }

    // Doctor accepts appointment
    public function accept(Appointment $appointment)
    {
        $appointment->update(['status' => 'accepted']);
        return back()->with('success', 'Appointment accepted!');
    }

    // Doctor declines appointment
    public function decline(Appointment $appointment)
    {
        $appointment->update(['status' => 'declined']);
        return back()->with('error', 'Appointment declined!');
    }

    // Admin views all appointments
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    // Admin edits
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required',
        ]);

        $appointment->update($request->only('appointment_date', 'appointment_time', 'status', 'notes'));

        return redirect()->route('appointments.index')->with('success', 'Appointment updated!');
    }

    // Admin deletes
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted!');
    }
}
