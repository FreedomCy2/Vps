<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment | Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        accent: '#8b5cf6',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f8f8f8; 
            min-height: 100vh;
        }
    </style>
</head>
<body>

<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <i data-feather="heart" class="text-primary h-8 w-8"></i>
                <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('user.dashboard') }}" class="text-gray-600 font-medium hover:text-gray-900">Home</a>
                <a href="{{ route('user.history') }}" class="text-gray-600 font-medium hover:text-gray-900">History</a>
                <a href="{{ route('user.profile') }}" class="text-gray-600 font-medium hover:text-gray-900">Profile</a>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-6 py-16">
    <div class="max-w-3xl mx-auto">
        
        <div class="mb-6">
            <a href="{{ route('user.history') }}" class="text-primary hover:text-blue-600 font-medium flex items-center">
                <i data-feather="arrow-left" class="h-4 w-4 mr-2"></i>
                Back to History
            </a>
        </div>

        <h1 class="text-4xl font-extrabold text-center text-primary mb-10">Edit Appointment</h1>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-8">
            
            <form method="POST" action="{{ route('user.booking.update', $booking->id) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Service</label>
                        <select id="service" name="service" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select a service</option>
                            <option value="General Consultation" {{ old('service', $booking->service) == 'General Consultation' ? 'selected' : '' }}>General Consultation</option>
                            <option value="Dental Check-up" {{ old('service', $booking->service) == 'Dental Check-up' ? 'selected' : '' }}>Dental Check-up</option>
                            <option value="Eye Examination" {{ old('service', $booking->service) == 'Eye Examination' ? 'selected' : '' }}>Eye Examination</option>
                            <option value="Physical Therapy" {{ old('service', $booking->service) == 'Physical Therapy' ? 'selected' : '' }}>Physical Therapy</option>
                            <option value="Laboratory Tests" {{ old('service', $booking->service) == 'Laboratory Tests' ? 'selected' : '' }}>Laboratory Tests</option>
                            <option value="Vaccination" {{ old('service', $booking->service) == 'Vaccination' ? 'selected' : '' }}>Vaccination</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" id="date" name="date" value="{{ old('date', $booking->date->format('Y-m-d')) }}" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label for="time" class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                            <input type="time" id="time" name="time" value="{{ old('time', \Carbon\Carbon::parse($booking->time)->format('H:i')) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $booking->name) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $booking->email) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $booking->phone) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                            <input type="number" id="age" name="age" value="{{ old('age', $booking->age) }}" required min="1" max="150" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select id="gender" name="gender" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Select gender</option>
                                <option value="Male" {{ old('gender', $booking->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $booking->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $booking->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="symptom" class="block text-sm font-medium text-gray-700 mb-2">Symptoms/Concerns (Optional)</label>
                        <textarea id="symptom" name="symptom" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('symptom', $booking->symptom) }}</textarea>
                    </div>

                </div>

                <div class="mt-8 flex flex-wrap gap-4">
                    <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-md">
                        <i data-feather="save" class="h-4 w-4 inline mr-2"></i>
                        Update Appointment
                    </button>
                    <a href="{{ route('user.history') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</main>

<script>
    feather.replace();
</script>

</body>
</html>