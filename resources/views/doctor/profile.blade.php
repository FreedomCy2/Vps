@extends('doctor.layout')

@section('title', 'Profile Settings - Green Pulse Clinic')
@section('active-profile', 'active-tab')

@section('content')

  <!-- Header -->
  <header class="bg-white shadow-soft rounded-2xl px-6 py-4 flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-semibold text-gray-800">Profile Settings</h2>
      <p class="text-sm text-gray-500">Manage your personal and professional information</p>
    </div>
    <div class="flex items-center space-x-4">
      <div class="relative">
        <button class="p-2 rounded-full hover:bg-clinic-100 transition">
          <i data-feather="bell" class="w-5 h-5 text-gray-600"></i>
        </button>
        <span class="absolute top-2 right-2 bg-red-500 w-2 h-2 rounded-full"></span>
      </div>
      <div class="w-8 h-8 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">SJ</div>
    </div>
  </header>

  <!-- Profile Card -->
  <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-soft p-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-3">Profile Information</h3>

    <!-- Profile Picture Section -->
    <div class="flex flex-col md:flex-row md:items-center md:space-x-8 mb-8">
      <div class="relative w-32 h-32">
        <img id="profileImage" src="https://i.pravatar.cc/150?img=47" alt="Profile Photo"
          class="w-32 h-32 rounded-full object-cover shadow-md border-4 border-clinic-100" />
        <label for="fileUpload"
          class="absolute bottom-0 right-0 bg-clinic-500 hover:bg-clinic-600 text-white rounded-full p-2 cursor-pointer shadow-lg transition">
          <i data-feather="camera" class="w-4 h-4"></i>
        </label>
        <input id="fileUpload" type="file" accept="image/*" class="hidden" onchange="previewImage(event)" />
      </div>

      <div class="mt-4 md:mt-0">
        <h4 class="text-lg font-medium text-gray-800">Dr. Sarah Johnson</h4>
        <p class="text-sm text-gray-500">Cardiologist at Green Pulse Clinic</p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Left Column -->
      <div class="space-y-5">
        <h4 class="font-medium text-gray-800">Personal Details</h4>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input type="text" value="Dr. Sarah Johnson"
            class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
          <input type="email" value="sarah.johnson@greenpulse.com"
            class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
          <input type="tel" value="(555) 123-4567"
            class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
          <input type="text" value="Cardiology"
            class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
        </div>
      </div>

      <!-- Right Column -->
      <div class="space-y-5">
        <h4 class="font-medium text-gray-800">Working Hours</h4>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
          <input type="time" value="09:00"
            class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
          <input type="time" value="17:00"
            class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Appointment Duration</label>
          <select class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition">
            <option>15 minutes</option>
            <option selected>30 minutes</option>
            <option>45 minutes</option>
            <option>60 minutes</option>
          </select>
        </div>

        <button class="w-full mt-6 bg-clinic-500 hover:bg-clinic-600 text-white py-3 rounded-xl font-medium shadow-md hover:shadow-lg transition-all">
          Save Changes
        </button>
      </div>
    </div>
  </section>

@endsection
