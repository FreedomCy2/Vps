@extends('doctor.layout')

@section('title', 'Notifications - Green Pulse Clinic')
@section('page-title', 'Notifications')
@section('page-subtitle', 'Stay updated with clinic activities')
@section('notifications-active', 'active-tab')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-6">Notifications</h3>

    <div class="space-y-4">
        <div class="notification p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-start">
            <div class="p-2 bg-blue-100 rounded-lg mr-4">
                <i data-feather="calendar" class="w-5 h-5 text-blue-500"></i>
            </div>
            <div class="flex-1">
                <p class="font-medium text-gray-800">New Appointment Booking</p>
                <p class="text-sm text-gray-600">Robert Taylor booked an appointment for November 5, 2023 at 11:00 AM.</p>
                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-4 h-4"></i>
            </button>
        </div>

        <div class="notification p-4 bg-amber-50 border border-amber-200 rounded-lg flex items-start">
            <div class="p-2 bg-amber-100 rounded-lg mr-4">
                <i data-feather="alert-circle" class="w-5 h-5 text-amber-500"></i>
            </div>
            <div class="flex-1">
                <p class="font-medium text-gray-800">Appointment Cancellation</p>
                <p class="text-sm text-gray-600">Maria Garcia cancelled her appointment for October 20, 2023.</p>
                <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-4 h-4"></i>
            </button>
        </div>

        <div class="notification p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
            <div class="p-2 bg-green-100 rounded-lg mr-4">
                <i data-feather="info" class="w-5 h-5 text-clinic-500"></i>
            </div>
            <div class="flex-1">
                <p class="font-medium text-gray-800">System Update</p>
                <p class="text-sm text-gray-600">New features have been added to the doctor dashboard.</p>
                <p class="text-xs text-gray-500 mt-1">1 day ago</p>
            </div>
            <button class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
</div>
@endsection
