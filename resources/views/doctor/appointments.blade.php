@extends('doctor.layout')

@section('title', 'My Appointments - Green Pulse Clinic')
@section('header-title', 'My Appointments')
@section('header-subtitle', 'Manage your patient appointments')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">My Appointments</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Service</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Time</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Patient</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Age</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Gender</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Symptom</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $booking->service }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $booking->date->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $booking->time }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $booking->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $booking->email }}<br>{{ $booking->phone }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $booking->age }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ ucfirst($booking->gender) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $booking->symptom }}</td>
                            @php $status = strtolower($booking->status ?? 'pending'); @endphp
                            <td class="px-4 py-3 text-sm">
                                @if($status === 'accepted')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i data-feather="check-circle" class="w-3 h-3 mr-1"></i> Accepted
                                    </span>
                                @elseif($status === 'declined')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i data-feather="x-circle" class="w-3 h-3 mr-1"></i> Declined
                                    </span>
                                @else
                                    <div class="flex space-x-2">
                                        <form action="{{ route('doctor.appointments.updateStatus', $booking->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700" onclick="return confirm('Are you sure you want to accept this appointment?')">
                                                <i data-feather="check" class="w-3 h-3 mr-1"></i> Accept
                                            </button>
                                        </form>

                                        <form action="{{ route('doctor.appointments.updateStatus', $booking->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="declined">
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700" onclick="return confirm('Are you sure you want to decline this appointment?')">
                                                <i data-feather="x" class="w-3 h-3 mr-1"></i> Decline
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i data-feather="calendar" class="w-12 h-12 text-gray-300 mb-2"></i>
                                    <p class="text-lg font-medium">No appointments found</p>
                                    <p class="text-sm">New appointments will appear here</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
