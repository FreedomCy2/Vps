<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details | Clinic Flow</title>
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

        <h1 class="text-4xl font-extrabold text-center text-primary mb-10">Appointment Details</h1>

        <div class="bg-white rounded-xl shadow-lg p-8">
            
            <div class="flex justify-between items-start mb-6 pb-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $booking->service }}</h2>
                    <p class="text-gray-500 mt-1">Booking ID: #{{ $booking->id }}</p>
                </div>
                <span class="px-4 py-2 text-sm font-semibold rounded-full 
                    @if($booking->status === 'Pending') bg-yellow-100 text-yellow-800
                    @elseif($booking->status === 'Confirmed') bg-blue-100 text-blue-800
                    @elseif($booking->status === 'Done') bg-green-100 text-green-800
                    @elseif($booking->status === 'Cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif
                ">
                    {{ strtoupper($booking->status) }}
                </span>
            </div>

            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Appointment Date</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $booking->date->format('l, F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Appointment Time</p>
                        <p class="text-lg font-semibold text-gray-800">{{ \Carbon\Carbon::parse($booking->time)->format('h:i A') }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Patient Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Full Name</p>
                            <p class="text-gray-800">{{ $booking->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Email</p>
                            <p class="text-gray-800">{{ $booking->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Phone</p>
                            <p class="text-gray-800">{{ $booking->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Age</p>
                            <p class="text-gray-800">{{ $booking->age }} years</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Gender</p>
                            <p class="text-gray-800">{{ $booking->gender }}</p>
                        </div>
                    </div>
                </div>

                @if($booking->symptom)
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Symptoms/Concerns</h3>
                    <p class="text-gray-700 italic">{{ $booking->symptom }}</p>
                </div>
                @endif

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-xs text-gray-400">Booked on: {{ $booking->created_at->format('M d, Y h:i A') }}</p>
                    @if($booking->updated_at != $booking->created_at)
                        <p class="text-xs text-gray-400">Last updated: {{ $booking->updated_at->format('M d, Y h:i A') }}</p>
                    @endif
                </div>

            </div>

            @if($booking->canBeEdited() || $booking->canBeCancelled())
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-4">
                @if($booking->canBeEdited())
                    <a href="{{ route('user.booking.edit', $booking->id) }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium shadow-md">
                        <i data-feather="edit" class="h-4 w-4 inline mr-2"></i>
                        Edit Appointment
                    </a>
                @endif
                
                @if($booking->canBeCancelled())
                    <form method="POST" action="{{ route('user.booking.cancel', $booking->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to cancel this appointment?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium shadow-md">
                            <i data-feather="x-circle" class="h-4 w-4 inline mr-2"></i>
                            Cancel Appointment
                        </button>
                    </form>
                @endif
            </div>
            @endif

        </div>
    </div>
</main>

<script>
    feather.replace();
</script>

</body>
</html>