<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Doctor;

class DoctorProfileController extends Controller
{
    /**
     * Show the profile edit form
     */
    public function edit()
    {
        $doctorId = session('doctor_id');
        
        if (!$doctorId) {
            return redirect()->route('doctor.login')->with('error', 'Please login first.');
        }

        $doctor = Doctor::find($doctorId);
        
        if (!$doctor) {
            return redirect()->route('doctor.login')->with('error', 'Doctor not found.');
        }

        return view('doctor.profile', compact('doctor'));
    }

    /**
     * Update the doctor's profile
     */
    public function update(Request $request)
    {
        $doctorId = session('doctor_id');
        
        if (!$doctorId) {
            return redirect()->route('doctor.login')->with('error', 'Please login first.');
        }

        $doctor = Doctor::find($doctorId);
        
        if (!$doctor) {
            return redirect()->route('doctor.login')->with('error', 'Doctor not found.');
        }

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:255',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'appointment_duration' => 'nullable|integer|in:15,30,45,60',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($doctor->profile_picture && Storage::disk('public')->exists($doctor->profile_picture)) {
                Storage::disk('public')->delete($doctor->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        // Update doctor information
        $doctor->update($validated);

        return redirect('/doctor/profile')->with('success', 'Profile updated successfully!');
    }
}