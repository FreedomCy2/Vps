@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Book Appointment</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf

        <label class="block mb-2">Doctor ID</label>
        <input type="number" name="doctor_id" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Date</label>
        <input type="date" name="appointment_date" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Time</label>
        <input type="time" name="appointment_time" class="w-full border p-2 rounded mb-3" required>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Book</button>
    </form>
</div>
@endsection
