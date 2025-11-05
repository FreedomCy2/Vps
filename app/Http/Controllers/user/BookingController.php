<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Make sure your Booking model is imported
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Handles the creation of a new booking.
     */
    public function store(Request $request)
    {
        // 1. VALIDATION (Basic example - customize this)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string',
            // ... add all other required fields ...
        ]);
        
        // 2. SAVE THE BOOKING
        $booking = new Booking();
        $booking->user_id = Auth::id(); // Assign the current user's ID
        $booking->name = $validatedData['name'];
        $booking->service = $validatedData['service'];
        $booking->date = $validatedData['date']; // Assuming separate date/time fields
        $booking->time = $validatedData['time'];
        $booking->status = 'Pending'; // Set initial status
        // ... assign other fields ...
        $booking->save();
        
        // 3. REDIRECT TO THE APPOINTMENT DETAILS PAGE (The Solution)
        // We use the ID of the newly created $booking object to redirect.
        return redirect()->route('user.edit', [
            'booking_id' => $booking->id
        ])->with('success', 'Your appointment has been successfully booked!');
    }

    /**
     * Fetches and displays a specific booking for editing/viewing.
     */
    public function edit($booking_id)
    {
        // Fetch the booking, ensuring it belongs to the authenticated user
        $booking = Booking::where('id', $booking_id)
                           ->where('user_id', Auth::id())
                           ->first();
        
        // Check if the booking was found (This prevents the "Booking not found." image)
        if (!$booking) {
            // If not found, you can return a view with an error or redirect
            return view('user.edit')->with('booking', null); // Pass null to trigger 'not found' message in Blade
        }
        
        // Pass the fetched booking data to your standalone edit view
        return view('user.edit', compact('booking'));
    }

    // You also need the history method to show all bookings
    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())
                           ->orderBy('date', 'desc')
                           ->orderBy('time', 'desc')
                           ->get();
                           
        return view('user.history', compact('bookings'));
    }
    // ...
    public function confirmBooking(Request $request)
    {
        // Add minimal validation to test if the form is being processed
        $request->validate([
            'patient_name' => 'required|string', 
            // Add other required fields from your form (date, time, etc.)
        ]);

        // 🛑 FOR TESTING: Return a simple string to confirm success.
        // Once this works, you'll put your Appointment::create(...) code here.
        return "Booking form successfully received!"; 
    }
// ...
}
