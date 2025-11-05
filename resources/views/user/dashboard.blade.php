<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Clinic Flow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.1);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <i data-feather="heart" class="text-[#3b82f6] h-8 w-8"></i>
                    <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
                </div>
            </div>

            <!-- Right-aligned navigation with Profile -->
            <div class="flex items-center space-x-6 ml-auto">
                <a href="{{ route('user.dashboard') }}" class="border-[#3b82f6] text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Dashboard</a>
                <a href="{{ route('user.service') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Bookings</a>
                
                <!-- Profile dropdown -->
                <div class="relative">
                    <button id="profileBtn" class="flex items-center text-gray-600 hover:text-gray-800 focus:outline-none">
                        <i data-feather="user" class="w-6 h-6 mr-1 text-[#3b82f6]"></i>
                        <span>{{ session('user_name', 'Guest') }}</span>
                        <i data-feather="chevron-down" class="w-4 h-4 ml-1"></i>
                    </button>
                    <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">View Profile</a>
                        <form method="POST" action="{{ route('user.logout') }}" class="inline"> 
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-6 py-16">
    <!-- ✅ SUCCESS MESSAGE ALERT - ADDED THIS SECTION -->
    @if(session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 4000)" 
            class="max-w-3xl mx-auto mb-8"
        >
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-md" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Welcome Message -->
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#3b82f6] to-[#3b82f6]">
            Welcome, {{ session('user_name', 'Guest') }}!
        </h1>
        <p class="text-lg text-[#3b82f6]/90 mt-3 font-medium">Manage your appointments easily below</p>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Booking History -->
        <div class="bg-white rounded-xl p-6 card">
            <div class="text-[#3b82f6] mb-4">
                <i data-feather="clock" class="w-10 h-10"></i>
            </div>
            <h3 class="text-xl font-bold mb-3">Booking History</h3>
            <p class="text-gray-600 mb-4">View all your past and upcoming appointments in one place.</p>
            <a href="{{ route('user.history') }}" class="px-4 py-2 bg-[#3b82f6] text-white rounded-lg hover:bg-[#3b82f6]/90 transition">View History</a>
        </div>

        <!-- Edit Booking -->
        <div class="bg-white rounded-xl p-6 card">
            <div class="text-[#3b82f6] mb-4">
                <i data-feather="edit" class="w-10 h-10"></i>
            </div>
            <h3 class="text-xl font-bold mb-3">Manage Bookings</h3>
            <p class="text-gray-600 mb-4">View, edit, or cancel your existing appointments.</p>
            <a href="{{ route('user.history') }}" class="px-4 py-2 bg-[#3b82f6] text-white rounded-lg hover:bg-[#3b82f6]/90 transition">
                Manage Now
            </a>
        </div>

        <!-- New Booking -->
        <div class="bg-white rounded-xl p-6 card">
            <div class="text-[#3b82f6] mb-4">
                <i data-feather="plus-circle" class="w-10 h-10"></i>
            </div>
            <h3 class="text-xl font-bold mb-3">New Booking</h3>
            <p class="text-gray-600 mb-4">Book a new appointment with our clinic for any of our available services.</p>
            <a href="{{ route('user.service') }}" class="px-4 py-2 bg-[#3b82f6] text-white rounded-lg hover:bg-[#3b82f6]/90 transition">Book Now</a>
        </div>
    </div>

    <!-- Additional Content for Dashboard -->
    <div class="mt-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Quick Actions -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                <div class="space-y-4">
                    <a href="{{ route('user.service') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                        <div class="flex items-center">
                            <i data-feather="calendar" class="w-5 h-5 text-blue-500"></i>
                            <span class="ml-3">Book Appointment</span>
                        </div>
                    </a>
                    <a href="{{ route('user.history') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                        <div class="flex items-center">
                            <i data-feather="clock" class="w-5 h-5 text-blue-500"></i>
                            <span class="ml-3">View History</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Profile Overview -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Profile Overview</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i data-feather="user" class="w-5 h-5 text-gray-400"></i>
                        <span class="ml-3">{{ session('user_name', 'Guest') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i data-feather="mail" class="w-5 h-5 text-gray-400"></i>
                        <span class="ml-3">{{ session('user_email', 'No Email') }}</span>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('user.profile') }}" class="text-blue-500 hover:text-blue-600">
                            Edit Profile →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-gray-400">&copy; 2025 Clinic Flow. All rights reserved.</p>
    </div>
</footer>

<script>
    feather.replace();

    // Simple dropdown toggle for profile
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');
    profileBtn.addEventListener('click', () => {
        profileMenu.classList.toggle('hidden');
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
            profileMenu.classList.add('hidden');
        }
    });
</script>
</body>
</html>