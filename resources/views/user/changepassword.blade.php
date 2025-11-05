<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        danger: '#ef4444',
                        secondary: '#10b981',
                        clinicflow: '#67e8f9',
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
            transition: all 0.2s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background-color: #3b82f6;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3), 0 2px 4px -2px rgba(59, 130, 246, 0.3);
            text-decoration: none;
        }
        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="fixed top-0 left-0 right-0 h-16 bg-white shadow-sm flex items-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl w-full mx-auto flex items-center">
            <i data-feather="heart" class="text-primary h-6 w-6"></i>
            <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
        </div>
    </div>

    <div class="w-full max-w-md bg-white rounded-xl shadow-xl p-8 sm:p-10 text-center mt-16">

        <h1 class="text-2xl font-extrabold text-primary mb-2">Change Your Password</h1>
        
        <p class="text-gray-600 mb-8">
            Please enter your current password, then set your new password.
        </p>
        
        <div id="success-message" class="hidden mb-4 p-3 bg-secondary/10 text-secondary border border-secondary/50 rounded-lg font-medium">
             <i data-feather="check-circle" class="h-5 w-5 inline mr-2"></i>
             Password updated successfully! Redirecting...
        </div>
        
        {{-- This section is where general errors (like 'Incorrect current password') would appear. --}}
        {{-- @if (session('error'))
            <div class="mb-4 p-3 bg-danger/10 text-danger border border-danger/50 rounded-lg font-medium">
                {{ session('error') }}
            </div>
        @endif --}}

        {{-- Change Password Form --}}
        <form method="POST" action="{{-- route('user.password.update') --}}" id="password-form" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Current Password Input --}}
            <div>
                <label for="current_password" class="sr-only">Current Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-feather="lock" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input id="current_password" 
                           name="current_password" 
                           type="password" 
                           required 
                           placeholder="Current Password"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                {{-- @error('current_password') <p class="text-danger text-sm mt-1 text-left">{{ $message }}</p> @enderror --}}
            </div>

            {{-- New Password Input --}}
            <div>
                <label for="new_password" class="sr-only">New Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-feather="unlock" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input id="new_password" 
                           name="new_password" 
                           type="password" 
                           required 
                           placeholder="New Password"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                {{-- @error('new_password') <p class="text-danger text-sm mt-1 text-left">{{ $message }}</p> @enderror --}}
            </div>

            {{-- Confirm New Password Input --}}
            <div>
                <label for="new_password_confirmation" class="sr-only">Confirm New Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-feather="repeat" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input id="new_password_confirmation" 
                           name="new_password_confirmation" 
                           type="password" 
                           required 
                           placeholder="Confirm New Password"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                {{-- @error('new_password_confirmation') <p class="text-danger text-sm mt-1 text-left">{{ $message }}</p> @enderror --}}
            </div>

            {{-- Submit Button (Now calls JS function to simulate success) --}}
            <div>
                <button type="button" onclick="handlePasswordUpdate()" id="update-button" class="btn-primary w-full py-3">
                    Update Password
                </button>
            </div>
        </form>

        <div class="mt-6 text-sm">
            {{-- Link back to the profile page --}}
            <a href="{{ route('user.profile') }}" class="text-primary font-medium hover:text-blue-700">
                <i data-feather="arrow-left" class="h-4 w-4 inline mr-1"></i>
                Back to Profile
            </a>
        </div>

    </div>

<script>
    feather.replace();

    /**
     * Simulates the form submission process and handles the success/redirect flow.
     * In a real app, this function would handle AJAX submission or simply allow 
     * the form to post to the server.
     */
    function handlePasswordUpdate() {
        const form = document.getElementById('password-form');
        const successMessage = document.getElementById('success-message');
        const updateButton = document.getElementById('update-button');

        // *** Client-side validation check (basic simulation) ***
        const newPass = document.getElementById('new_password').value;
        const confirmPass = document.getElementById('new_password_confirmation').value;
        
        if (newPass !== confirmPass) {
             alert('Error: New Password and Confirm New Password do not match.');
             return; // Stop execution
        }
        
        // Disable button and change text to indicate processing
        updateButton.disabled = true;
        updateButton.textContent = 'Processing...';

        // --- SIMULATE SUCCESSFUL BACKEND UPDATE (1.5 second delay) ---
        setTimeout(() => {
            // 1. Show Success Message
            successMessage.classList.remove('hidden');
            
            // 2. Redirect to Profile
            setTimeout(() => {
                // *** THIS IS THE CRITICAL REDIRECT LINE ***
                // It routes the user back to the profile page upon successful update.
                window.location.href = "{{ route('user.profile') }}?password_updated=true";
            }, 1000); // Wait 1 second after showing success message
            
        }, 1500); // Simulate 1.5 seconds of server processing time
    }
</script>

</body>
</html>