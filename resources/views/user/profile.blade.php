<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6', // Blue
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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f8f8f8; }
        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }
        .card:hover {
            box-shadow: 0 10px 20px -3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50">

<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <i data-feather="heart" class="text-primary h-8 w-8"></i>
                    <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
                </div>
            </div>

            <div class="flex items-center space-x-6 ml-auto">
                <a href="{{ route('user.dashboard') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium">Dashboard</a>
                <a href="{{ route('user.history') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium">History</a>
                <a href="{{ route('user.service') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium">Bookings</a>
                
                <div class="relative">
                    <button id="profileBtn" class="flex items-center text-primary font-medium hover:text-blue-700 focus:outline-none border-b-2 border-primary">
                        <i data-feather="user" class="w-6 h-6 mr-1"></i>
                        <span>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                        <i data-feather="chevron-down" class="w-4 h-4 ml-1"></i>
                    </button>
                    @if(Auth::check())
                    <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-primary font-medium hover:bg-gray-100">View Profile</a>
                        <form method="POST" action="{{ route('logout') }}"> 
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="max-w-4xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-extrabold text-center text-primary mb-10">My Profile</h1>

    {{-- Session Messages (Success/Error) --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    @error('current_password')
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
            <p>{{ $message }}</p>
        </div>
    @enderror

    <div class="bg-white p-8 rounded-xl shadow card">
        
        @if(Auth::check())
        
        <div class="flex flex-col items-center mb-10 border-b pb-6">
            <div class="relative">
                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/120/3b82f6/ffffff?text=' . substr(Auth::user()->name, 0, 1) }}" 
                     alt="Profile Picture" 
                     class="w-32 h-32 rounded-full object-cover border-4 border-primary/50 shadow-md">
            </div>
            
            <form action="{{ route('user.updatePicture') }}" method="POST" enctype="multipart/form-data" class="mt-4 flex flex-col items-center">
                @csrf
                <label class="block cursor-pointer">
                    <input type="file" name="profile_picture" class="hidden" id="profileUpload" accept="image/*" onchange="document.getElementById('uploadSubmitBtn').classList.remove('hidden')">
                    <span class="text-primary font-medium hover:underline">Choose New Picture</span>
                </label>
                <button type="submit" id="uploadSubmitBtn" class="hidden mt-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">Upload Picture</button>
                @error('profile_picture')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
            </form>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Personal Information</h2>
        <form action="{{ route('user.updateProfile') }}" method="POST" class="space-y-6 mb-10 pb-6 border-b">
            @csrf
            
            {{-- Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary" required>
                @error('name')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary" required>
                @error('email')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Phone Number --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary">
                @error('phone')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow">Save Changes</button>
            </div>
        </form>

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Change Password</h2>

        <form action="{{ route('user.updatePassword') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-2">Current Password</label>
                <input type="password" name="current_password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary" required>
                @error('current_password')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">New Password</label>
                <input type="password" name="new_password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary" required>
                @error('new_password')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary focus:border-primary" required>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-medium shadow">Update Password</button>
            </div>
        </form>
        @else
        <p class="text-center text-gray-500 mt-4">Please log in to view and update your profile.</p>
        @endif
    </div>

    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-700 mb-6">Latest Appointment Data</h2>
        @if(isset($latestBooking) && $latestBooking)
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><label class="block text-sm font-medium text-gray-600">Service</label><p class="mt-1 text-gray-900 font-semibold">{{ $latestBooking->service ?? 'N/A' }}</p></div>
                <div><label class="block text-sm font-medium text-gray-600">Date/Time</label><p class="mt-1 text-gray-900">{{ $latestBooking->scheduled_at ? $latestBooking->scheduled_at->format('M j, Y - g:i A') : (date('F j, Y, g:i A', strtotime($latestBooking->date . ' ' . $latestBooking->time)) ?? 'N/A') }}</p></div>
                
                <div class="col-span-2"><label class="block text-sm font-medium text-gray-600">Name (Used for Booking)</label><p class="mt-1 text-gray-900">{{ $latestBooking->name }}</p></div>
                
                <div><label class="block text-sm font-medium text-gray-600">Email</label><p class="mt-1 text-gray-900">{{ $latestBooking->email }}</p></div>
                <div><label class="block text-sm font-medium text-gray-600">Phone</label><p class="mt-1 text-gray-900">{{ $latestBooking->phone }}</p></div>
                <div><label class="block text-sm font-medium text-gray-600">Age</label><p class="mt-1 text-gray-900">{{ $latestBooking->age }}</p></div>
                <div><label class="block text-sm font-medium text-gray-600">Gender</label><p class="mt-1 text-gray-900 capitalize">{{ $latestBooking->gender }}</p></div>
            </div>
            
            <div class="mt-8 flex justify-end">
                <a href="{{ route('user.edit', $latestBooking->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow-md">Edit Booking</a>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <p class="text-gray-500 mb-4">You have no booking information on file.</p>
            <a href="{{ route('user.service') }}" class="inline-block px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 font-medium">Make Your First Booking</a>
        </div>
        @endif
    </div>
</main>

<footer class="bg-gray-800 mt-16">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-gray-400">&copy; {{ date('Y') }} Clinic Flow. All rights reserved.</p>
    </div>
</footer>

<script>
    // Initialize Feather icons
    feather.replace();

    // Profile Dropdown JavaScript
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');
    
    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent document click from immediately closing it
            profileMenu.classList.toggle('hidden');
        });
        
        document.addEventListener('click', function(event) {
            if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    }
</script>

</body>
</html>
