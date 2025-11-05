@extends('doctor.layout')

@section('title', 'Doctor Availability')
@section('header-title', 'Availability Settings')
@section('header-subtitle', 'Manage your available days and hours')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Set Your Availability</h3>
        
        {{-- Example content – you can replace this with your actual availability form --}}
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="day" class="block text-sm font-medium text-gray-700 mb-1">Day</label>
                    <select id="day" name="day" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-clinic-500 focus:border-clinic-500">
                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                    </select>
                </div>
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Available Hours</label>
                    <input id="time" type="text" name="time" placeholder="9:00 AM - 5:00 PM"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-clinic-500 focus:border-clinic-500">
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-clinic-500 text-white px-4 py-2 rounded-md hover:bg-clinic-600">
                    Save Availability
                </button>
            </div>
        </form>
    </div>
@endsection
