@extends('admin.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">Total Bookings</p>
                    <h3 class="text-2xl font-bold mt-2">1,248</h3>
                    <p class="text-green-500 text-sm mt-1">+12% from last month</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i data-feather="calendar" class="text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">Today's Bookings</p>
                    <h3 class="text-2xl font-bold mt-2">24</h3>
                    <p class="text-green-500 text-sm mt-1">+2 from yesterday</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <i data-feather="clock" class="text-green-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">Pending</p>
                    <h3 class="text-2xl font-bold mt-2">18</h3>
                    <p class="text-red-500 text-sm mt-1">+3 from yesterday</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i data-feather="alert-circle" class="text-yellow-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">Cancelled</p>
                    <h3 class="text-2xl font-bold mt-2">32</h3>
                    <p class="text-red-500 text-sm mt-1">+5% from last month</p>
                </div>
                <div class="bg-red-100 p-3 rounded-lg">
                    <i data-feather="x-circle" class="text-red-500"></i>
                </div>
            </div>
        </div>
    </div>
@endsection