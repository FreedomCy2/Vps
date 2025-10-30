@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-semibold mb-4">All Appointments (Admin)</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Doctor</th>
                <th class="p-2 border">Patient</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Time</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $a)
            <tr>
                <td class="border p-2">{{ $a->id }}</td>
                <td class="border p-2">{{ $a->doctor->name ?? 'N/A' }}</td>
                <td class="border p-2">{{ $a->patient->name ?? 'N/A' }}</td>
                <td class="border p-2">{{ $a->appointment_date }}</td>
                <td class="border p-2">{{ $a->appointment_time }}</td>
                <td class="border p-2">{{ ucfirst($a->status) }}</td>
                <td class="border p-2 space-x-2">
                    <a href="{{ route('appointments.edit', $a->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('appointments.destroy', $a->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
