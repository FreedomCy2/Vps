@extends('doctor.layout')

@section('title', 'Doctor Dashboard - Green Pulse Clinic')
@section('header-title', 'Dashboard')
@section('header-subtitle')
    @php
        $doctor = \App\Models\Doctor::find(session('doctor_id'));
    @endphp
    Welcome back, Dr. {{ $doctor->name ?? 'Doctor' }}
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Today's Appointments</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">5</p>
                </div>
                <div class="p-3 bg-clinic-100 rounded-lg">
                    <i data-feather="calendar" class="w-6 h-6 text-clinic-500"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">2 upcoming, 3 completed</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Weekly Appointments</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">24</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i data-feather="users" class="w-6 h-6 text-blue-500"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">+3 from last week</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Patient Satisfaction</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">94%</p>
                </div>
                <div class="p-3 bg-amber-100 rounded-lg">
                    <i data-feather="star" class="w-6 h-6 text-amber-500"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Based on 42 reviews</p>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Upcoming Appointments</h3>
            <a href="{{ url('/doctor/appointments') }}" class="text-sm text-clinic-600 font-medium hover:underline">View All</a>
        </div>
        
        <div class="space-y-4">
            <div class="appointment-card bg-white border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-clinic-100 rounded-full flex items-center justify-center">
                        <i data-feather="user" class="w-5 h-5 text-clinic-500"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Michael Chen</p>
                        <p class="text-sm text-gray-500">Regular Checkup</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-medium text-gray-800">10:30 AM</p>
                    <p class="text-sm text-gray-500">Today</p>
                </div>
            </div>

            <div class="appointment-card bg-white border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-clinic-100 rounded-full flex items-center justify-center">
                        <i data-feather="user" class="w-5 h-5 text-clinic-500"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Jennifer Lopez</p>
                        <p class="text-sm text-gray-500">Cardiac Consultation</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-medium text-gray-800">2:15 PM</p>
                    <p class="text-sm text-gray-500">Today</p>
                </div>
            </div>
        </div>
    </div>

    
@endsection