<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments | Clinic Flow</title>
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
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
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
                <a href="{{ route('user.appointments') }}" class="text-primary font-medium">Appointments</a>
                <a href="{{ route('user.history') }}" class="text-gray-600 font-medium hover:text-gray-900">History</a>
                <a href="{{ route('user.profile') }}" class="text-gray-600 font-medium hover:text-gray-900">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="inline"> 
                    @csrf
                    <button type="submit" class="text-gray-600 font-medium hover:text-gray-900">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-6 py-16">
    <div class="max-w-5xl mx-auto">
        
        <h1 class="text-4xl font-extrabold text-center text-primary mb-10">My Active Appointments</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-6">

@if(isset($bookings) && $bookings->isNotEmpty())
    <div class="space-y-4">
        @foreach($bookings as $booking)
            <div class="p-5 border border-gray-200 rounded-lg card bg-gray-50 hover:bg-white transition duration-300">
                <div class="flex flex-wrap justify-between items-start gap-4">
                    <div class="flex-1">
                        <p class="text-sm text-gray-500 font-medium">Service</p>
                        <p class="text-xl font-bold text-gray-800">{{ $booking->service }}</p>
                        
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Patient Name</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $booking->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Contact</p>
                                <p class="text-sm text-gray-700">{{ $booking->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <p class="text-sm text-gray-500 font-medium">Date & Time</p>
                            <p class="text-md font-semibold text-gray-800">
                                {{ date('M d, Y', strtotime($booking->date)) }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ date('h:i A', strtotime($booking->time)) }}
                            </p>
                        </div>
                        
                        <div class="text-right">
                            <p class="text-sm text-gray-500 font-medium">Status</p>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                @if($booking->status === 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status === 'Confirmed') bg-blue-100 text-blue-800
                                @endif
                            ">
                                {{ strtoupper($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500 font-medium uppercase mb-1">Symptoms / Notes</p>
                    <p class="text-sm text-gray-700 italic">
                        {{ $booking->symptom ?? 'No symptoms provided.' }}
                    </p>
                </div>

                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="{{ route('user.booking.edit', $booking->id) }}"
                       class="px-4 py-2 text-sm bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-md">
                        <i data-feather="edit-2" class="inline h-4 w-4"></i> Edit
                    </a>
                    
                    <form method="POST" action="{{ route('user.booking.cancel', $booking->id) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to cancel this appointment?')"
                                class="px-4 py-2 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-medium shadow-md">
                            <i data-feather="x-circle" class="inline h-4 w-4"></i> Cancel
                        </button>
                    </form>
                    
                    <a href="{{ route('user.booking.show', $booking->id) }}"
                       class="px-4 py-2 text-sm bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-medium shadow-md">
                        <i data-feather="eye" class="inline h-4 w-4"></i> View Details
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="py-20 text-center">
        <i data-feather="calendar" class="h-16 w-16 text-gray-400 mx-auto mb-4"></i>
        <p class="text-xl font-semibold text-gray-700 mb-2">No Active Appointments</p>
        <p class="text-gray-500">You don't have any active appointments at the moment.</p>
        <a href="{{ route('user.information.form') }}" 
           class="mt-6 inline-block px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-md">
            Book New Appointment
        </a>
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