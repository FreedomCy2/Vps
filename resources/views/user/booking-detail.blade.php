<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details | Clinic Flow</title>
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
                <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('user.appointments') }}" class="text-gray-600 font-medium hover:text-gray-900">Back to Appointments</a>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-6 py-16">
    <div class="max-w-3xl mx-auto">
        
        <h1 class="text-4xl font-extrabold text-center text-primary mb-10">Appointment Details</h1>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Service</p>
                    <p class="text-lg font-bold text-gray-800">{{ $booking->service }}</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Status</p>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        @if($booking->status === 'Pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status === 'Confirmed') bg-blue-100 text-blue-800
                        @elseif($booking->status === 'Done') bg-green-100 text-green-800
                        @elseif($booking->status === 'Cancelled') bg-red-100 text-red-800
                        @endif
                    ">
                        {{ strtoupper($booking->status) }}
                    </span>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Date</p>
                    <p class="text-lg font-semibold text-gray-800">{{ date('M d, Y', strtotime($booking->date)) }}</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Time</p>
                    <p class="text-lg font-semibold text-gray-800">{{ date('h:i A', strtotime($booking->time)) }}</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Patient Name</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $booking->name }}</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Email</p>
                    <p class="text-lg text-gray-800">{{ $booking->email }}</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Phone</p>
                    <p class="text-lg text-gray-800">{{ $booking->phone }}</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Age</p>
                    <p class="text-lg text-gray-800">{{ $booking->age }} years old</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Gender</p>
                    <p class="text-lg text-gray-800">{{ $booking->gender }}</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500 font-medium mb-1">Booked On</p>
                    <p class="text-lg text-gray-800">{{ date('M d, Y', strtotime($booking->created_at)) }}</p>
                </div>
            </div>

            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-500 font-medium mb-2">Symptoms / Notes</p>
                <p class="text-base text-gray-700">{{ $booking->symptom ?? 'No symptoms provided.' }}</p>
            </div>

            <div class="mt-8 flex gap-4">
                @if($booking->status !== 'Cancelled' && $booking->status !== 'Done')
                    <a href="{{ route('user.booking.edit', $booking->id) }}" 
                       class="flex-1 text-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-md">
                        Edit Appointment
                    </a>
                @endif
                <a href="{{ route('user.appointments') }}" 
                   class="flex-1 text-center px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium shadow-md">
                    Back
                </a>
            </div>
        </div>
    </div>
</main>

</body>
</html>