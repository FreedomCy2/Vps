@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-semibold mb-4">My Appointments</h2>

    @foreach($appointments as $a)
        <div class="p-4 bg-white shadow rounded mb-3 flex justify-between items-center">
            <div>
                <p><strong>Date:</strong> {{ $a->appointment_date }}</p>
                <p><strong>Time:</strong> {{ $a->appointment_time }}</p>
                <p><strong>Status:</strong> {{ ucfirst($a->status) }}</p>
            </div>

            @if($a->status === 'pending')
                <div class="space-x-2">
                    <form method="POST" action="{{ route('appointments.accept', $a->id) }}" class="inline">
                        @csrf
                        <button class="bg-green-500 text-white px-3 py-1 rounded">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('appointments.decline', $a->id) }}" class="inline">
                        @csrf
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Decline</button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
</div>
@endsection
