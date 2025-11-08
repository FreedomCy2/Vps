@extends('doctor.layout')

@section('title', 'Profile Settings - Green Pulse Clinic')
@section('active-profile', 'active-tab')

@section('content')

  @if(session('success'))
    <div class="alert alert-success mb-4">
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="alert bg-red-100 border-red-400 text-red-700 mb-4">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Profile Card -->
  <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-soft p-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-3">Profile Information</h3>

    <form method="POST" action="/doctor/profile" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      @php
        $doctor = \App\Models\Doctor::find(session('doctor_id'));
        $profilePicture = $doctor && $doctor->profile_picture 
          ? asset('storage/' . $doctor->profile_picture) 
          : 'https://i.pravatar.cc/150?img=47';
      @endphp

      <!-- Profile Picture Section -->
      <div class="flex flex-col md:flex-row md:items-center md:space-x-8 mb-8">
        <div class="relative w-32 h-32">
          <img id="profileImage" src="{{ $profilePicture }}" alt="Profile Photo"
            class="w-32 h-32 rounded-full object-cover shadow-md border-4 border-clinic-100" />
          <label for="fileUpload"
            class="absolute bottom-0 right-0 bg-clinic-500 hover:bg-clinic-600 text-white rounded-full p-2 cursor-pointer shadow-lg transition">
            <i data-feather="camera" class="w-4 h-4"></i>
          </label>
          <input id="fileUpload" name="profile_picture" type="file" accept="image/*" class="hidden" onchange="previewImage(event)" />
        </div>

        <div class="mt-4 md:mt-0">
          <h4 class="text-lg font-medium text-gray-800">{{ $doctor->name ?? 'Dr. Sarah Johnson' }}</h4>
          <p class="text-sm text-gray-500">{{ $doctor->specialization ?? 'Cardiologist' }} at Green Pulse Clinic</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column -->
        <div class="space-y-5">
          <h4 class="font-medium text-gray-800">Personal Details</h4>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $doctor->name ?? 'Dr. Sarah Johnson') }}"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" name="phone" value="{{ old('phone', $doctor->phone ?? '(555) 123-4567') }}"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
            <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization ?? 'Cardiology') }}"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-5">
          <h4 class="font-medium text-gray-800">Working Hours</h4>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
            <input type="time" name="start_time" value="{{ old('start_time', $doctor->start_time ?? '09:00') }}"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
            <input type="time" name="end_time" value="{{ old('end_time', $doctor->end_time ?? '17:00') }}"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Appointment Duration</label>
            <select name="appointment_duration" class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition">
              <option value="15" {{ old('appointment_duration', $doctor->appointment_duration ?? 30) == 15 ? 'selected' : '' }}>15 minutes</option>
              <option value="30" {{ old('appointment_duration', $doctor->appointment_duration ?? 30) == 30 ? 'selected' : '' }}>30 minutes</option>
              <option value="45" {{ old('appointment_duration', $doctor->appointment_duration ?? 30) == 45 ? 'selected' : '' }}>45 minutes</option>
              <option value="60" {{ old('appointment_duration', $doctor->appointment_duration ?? 30) == 60 ? 'selected' : '' }}>60 minutes</option>
            </select>
          </div>

          <button type="submit" class="w-full mt-6 bg-clinic-500 hover:bg-clinic-600 text-white py-3 rounded-xl font-medium shadow-md hover:shadow-lg transition-all">
            Save Changes
          </button>
        </div>
      </div>
    </form>
  </section>

  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profileImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
  </script>

@endsection