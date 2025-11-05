<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back | Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#10b981',
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .btn-primary {
            background-color: #3b82f6;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>



<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <i data-feather="heart" class="text-primary h-8 w-8"></i>
                <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Example Nav Links for logged-in user --}}
                <a href="{{ route('user.history') }}" class="text-gray-600 font-medium hover:text-blue-700">History</a>
                <a href="{{ route('user.profile') }}" class="text-gray-600 font-medium hover:text-gray-900">Profile</a>
                <form method="POST" action="/logout"> 
                    @csrf
                    <button type="submit" class="text-gray-600 font-medium hover:text-gray-900">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl p-12 text-center">
        
        <i data-feather="check-circle" class="text-secondary h-20 w-20 mx-auto mb-6"></i>
        
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">
            Booking successful, {{ Auth::user()->name ?? 'User' }}!
        </h1>
        <p class="text-xl text-gray-600 mb-8">
            You are now successfully logged into Clinic Flow.
        </p>

        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
            
            {{-- Option 1: View History (where they can edit/delete) --}}
            <a href="{{ route('user.edit') }}" class="w-full sm:w-auto btn-primary text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                <i data-feather="calendar" class="h-5 w-5 inline mr-2"></i>
                Check/Edit My Bookings
            </a>
            
            {{-- Option 2: Book a New Appointment --}}
            <a href="{{ route('user.booking') }}" class="w-full sm:w-auto bg-secondary text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition hover:bg-emerald-600">
                <i data-feather="plus-circle" class="h-5 w-5 inline mr-2"></i>
                Book a New Appointment
            </a>
        </div>
    </div>
</main>

<footer class="bg-gray-800 mt-16">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center text-gray-400">
        &copy; 2025 Clinic Flow. All rights reserved.
    </div>
</footer>

<script>
    feather.replace();
</script>

</body>
</html>