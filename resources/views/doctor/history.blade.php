@extends('doctor.layout')

@section('title', 'Appointment History - Green Pulse Clinic')
@section('header-title', 'Appointment History')
@section('header-subtitle', 'View all processed and deleted appointments')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg"><i data-feather="check-circle" class="w-6 h-6 text-green-600"></i></div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Accepted</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $historyRecords->where('status', 'accepted')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg"><i data-feather="x-circle" class="w-6 h-6 text-red-600"></i></div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Declined</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $historyRecords->where('status', 'declined')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-gray-100 rounded-lg"><i data-feather="trash-2" class="w-6 h-6 text-gray-600"></i></div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Deleted</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $historyRecords->where('action_type', 'deletion')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg"><i data-feather="activity" class="w-6 h-6 text-blue-600"></i></div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Actions</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $historyRecords->total() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Appointment History</h3>
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    <i data-feather="filter" class="w-4 h-4 mr-2 inline"></i>Filter
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-clinic-500 rounded-md hover:bg-clinic-600">
                    <i data-feather="download" class="w-4 h-4 mr-2 inline"></i>Export
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Patient</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Service</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Date & Time</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Action</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Date Processed</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Doctor</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($historyRecords as $record)
                        <tr class="hover:bg-gray-50 transition-colors history-card">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-clinic-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-clinic-600">{{ substr($record->name, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $record->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $record->age }}y, {{ ucfirst($record->gender) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $record->service }}</td>
                            <td class="px-4 py-3 text-sm">
                                <p class="font-medium">{{ $record->date->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $record->time }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p class="text-xs">{{ $record->email }}</p>
                                <p class="text-xs text-gray-500">{{ $record->phone }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $record->status_badge_class }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $record->action_badge_class }}">
                                    {{ ucfirst($record->action_type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p class="font-medium">{{ $record->action_date->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $record->action_date->format('h:i A') }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $record->doctor_name ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                <i data-feather="archive" class="w-12 h-12 text-gray-300 mb-2 mx-auto"></i>
                                <p class="text-lg font-medium">No history records found</p>
                                <p class="text-sm">Processed appointments will appear here</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($historyRecords->hasPages())
            <div class="mt-6">{{ $historyRecords->links() }}</div>
        @endif
    </div>
@endsection
