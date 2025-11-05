<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBooking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_bookings = UserBooking::orderBy('date', 'desc')->get();
        // If the request expects JSON (AJAX) return JSON, otherwise render view
        if (request()->wantsJson()) {
            return response()->json(['data' => $user_bookings], 200);
        }

        return view('admin.booking', compact('user_bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.booking');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'age' => 'required|integer',
            'gender' => 'required|string|max:50',
            'symptom' => 'nullable|string',
        ]);

        try {
            $date = Carbon::parse($validated['date'])->toDateString();
            $timeInput = $validated['time'];

            // If time input looks like a full datetime (contains '-' or 'T'), parse directly,
            // otherwise combine the validated date and the provided time.
            if (str_contains($timeInput, 'T') || str_contains($timeInput, '-')) {
                $dt = Carbon::parse($timeInput);
            } else {
                $dt = Carbon::parse($date . ' ' . $timeInput);
            }

            $time = $dt->toTimeString(); // H:i:s
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid date/time format.'], 422);
        }

        $booking = UserBooking::create([
            'service' => $validated['service'],
            'date' => $date,
            'time' => $time,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'symptom' => $validated['symptom'] ?? null,
        ]);

        return response()->json(['message' => 'Booking created', 'data' => $booking], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = UserBooking::find($id);
        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json(['data' => $booking], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = UserBooking::find($id);
        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $validated = $request->validate([
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'age' => 'required|integer',
            'gender' => 'required|string|max:50',
            'symptom' => 'nullable|string',
        ]);

        try {
            $date = Carbon::parse($validated['date'])->toDateString();
            $timeInput = $validated['time'];

            if (str_contains($timeInput, 'T') || str_contains($timeInput, '-')) {
                $dt = Carbon::parse($timeInput);
            } else {
                $dt = Carbon::parse($date . ' ' . $timeInput);
            }
            $time = $dt->toTimeString();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid date/time format.'], 422);
        }

        $booking->update([
            'service' => $validated['service'],
            'date' => $date,
            'time' => $time,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'symptom' => $validated['symptom'] ?? null,
        ]);

        return response()->json(['message' => 'Booking updated', 'data' => $booking], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = UserBooking::find($id);
        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking deleted'], 200);
    }
}
