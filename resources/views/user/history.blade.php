<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment History | Clinic Flow</title>
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
                <a href="{{ route('user.profile') }}" class="text-gray-600 font-medium hover:text-gray-900">Profile</a>
                <form method="POST" action="{{ route('user.logout') }}" class="inline"> 
                    @csrf
                    <button type="submit" class="text-gray-600 font-medium hover:text-gray-900">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-6 py-16">
    <div class="max-w-4xl mx-auto">
        
        <h1 class="text-4xl font-extrabold text-center text-primary mb-10">Your Appointment History</h1>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-6">
            
            <div class="flex flex-col sm:flex-row justify-between items-center pb-4 border-b border-gray-200 mb-6 space-y-4 sm:space-y-0">
                <div class="flex flex-wrap gap-2 text-sm font-medium">
                    <span class="text-gray-500 mr-2">Filter by Status:</span>
                    <a href="?status=" class="px-3 py-1 {{ request('status') === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-full transition">All</a>
                    <a href="?status=Pending" class="px-3 py-1 {{ request('status') === 'Pending' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-full transition">Pending</a>
                    <a href="?status=Confirmed" class="px-3 py-1 {{ request('status') === 'Confirmed' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-full transition">Confirmed</a>
                    <a href="?status=Done" class="px-3 py-1 {{ request('status') === 'Done' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-full transition">Done</a>
                    <a href="?status=Cancelled" class="px-3 py-1 {{ request('status') === 'Cancelled' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-full transition">Cancelled</a>
                </div>
                
                <div class="flex items-center space-x-2">
                    <a href="{{ route('user.information.form') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-md">
                        Book New Appointment
                    </a>
                </div>
            </div>

            {{-- SCENARIO 1: BOOKINGS FOUND --}}
            @if(isset($bookings) && $bookings->isNotEmpty())
                
                <div class="space-y-4">
                    @foreach($bookings as $booking)
                        <div class="p-4 border border-gray-100 rounded-lg card bg-gray-50 hover:bg-white transition duration-300">
                            
                            {{-- Main Appointment Summary Line --}}
                            <div class="flex flex-wrap justify-between items-center">
                                
                                {{-- Left Side: Service and Patient Info --}}
                                <div>
                                    <p class="text-sm text-gray-500 font-medium">Service</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $booking->service }}</p>
                                    <p class="text-sm text-gray-600">Patient: {{ $booking->name }}</p>
                                </div>

                                {{-- Right Side: Date/Time, Status, and Action Buttons --}}
                                <div class="flex items-center space-x-4 sm:space-x-6 mt-2 sm:mt-0">
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500 font-medium">Date & Time</p>
                                        <p class="text-md font-semibold text-gray-800">
                                            {{ $booking->date->format('M d, Y') }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($booking->time)->format('h:i A') }}
                                        </p>
                                    </div>
                                    
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500 font-medium">Status</p>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                            @if($booking->status === 'Pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->status === 'Confirmed') bg-blue-100 text-blue-800
                                            @elseif($booking->status === 'Done') bg-green-100 text-green-800
                                            @elseif($booking->status === 'Cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif
                                        ">
                                            {{ strtoupper($booking->status ?? 'Pending') }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col space-y-2">
                                        <a href="{{ route('user.booking.show', $booking->id) }}" class="px-4 py-2 text-sm bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-md text-center">
                                            View Details
                                        </a>
                                        
                                        @if($booking->status !== 'Done' && $booking->status !== 'Cancelled')
                                            <a href="{{ route('user.booking.edit', $booking->id) }}" class="px-4 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium shadow-md text-center">
                                                Edit
                                            </a>
                                            
                                            <form method="POST" action="{{ route('user.booking.cancel', $booking->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to cancel this appointment?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-full px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium shadow-md">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div> {{-- End Main Appointment Summary --}}

                            {{-- Expanded Details Section --}}
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-500 font-medium">Contact Information</p>
                                        <p class="text-gray-700">Email: {{ $booking->email }}</p>
                                        <p class="text-gray-700">Phone: {{ $booking->phone }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 font-medium">Patient Details</p>
                                        <p class="text-gray-700">Age: {{ $booking->age }} years</p>
                                        <p class="text-gray-700">Gender: {{ $booking->gender }}</p>
                                    </div>
                                </div>
                                
                                @if($booking->symptom)
                                    <div class="mt-3">
                                        <p class="text-gray-500 font-medium">Symptoms/Concerns</p>
                                        <p class="text-gray-700 italic">{{ $booking->symptom }}</p>
                                    </div>
                                @endif
                                
                                <div class="mt-3">
                                    <p class="text-xs text-gray-400">Booked on: {{ $booking->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            
            {{-- SCENARIO 2: NO BOOKINGS FOUND --}}
            @else
                <div class="py-20 text-center">
                    <i data-feather="calendar" class="h-16 w-16 text-gray-400 mx-auto mb-4"></i>
                    <p class="text-xl font-semibold text-gray-700 mb-2">No Appointments Found</p>
                    <p class="text-gray-500">You haven't booked any appointments yet.</p>
                    <a href="{{ route('user.information.form') }}" class="mt-6 inline-block px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-md">
                        Book Your First Appointment
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