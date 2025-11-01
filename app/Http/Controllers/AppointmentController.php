<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Store booking
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'reason' => 'required',
        ]);

        Appointment::create([
            'patient_id' => auth()->id(), // assuming logged-in user
            'date' => $request->date,
            'time' => $request->time,
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    // Show appointments to doctor
    public function index()
    {
        $appointments = Appointment::with('patient')->orderBy('created_at', 'desc')->get();
        return view('appointment', compact('appointments'));
    }

    // Update status
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment ' . $request->status . ' successfully!');
    }
    // Additional methods for admin management
public function adminIndex()
{
    $appointments = Appointment::with('patient')->orderBy('created_at', 'desc')->get();
    return view('admin', compact('appointments'));
}

public function update(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->update([
        'date' => $request->date,
        'time' => $request->time,
        'reason' => $request->reason,
    ]);

    return redirect()->back()->with('success', 'Appointment updated successfully!');
}

public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->delete();

    return redirect()->back()->with('success', 'Appointment deleted successfully!');
}

}
