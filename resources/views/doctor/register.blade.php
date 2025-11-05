<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Pulse Clinic - Doctor Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clinic: {
                            100: '#ECFDF5',
                            500: '#10B981',
                            600: '#059669'
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .form-input-icon {
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
        }
        input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-clinic-100">
    <div class="w-full max-w-md px-6 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-clinic-500 py-6 px-8 text-center">
                <div class="flex items-center justify-center space-x-2">
                    <i data-feather="heart" class="text-white w-6 h-6"></i>
                    <h1 class="text-2xl font-bold text-white">Green Pulse Clinic</h1>
                </div>
                <p class="mt-2 text-clinic-100">Doctor Registration Portal</p>
            </div>

            <!-- Form -->
            <form action="{{ route('doctor.register') }}" method="POST" class="px-8 py-6">
                @csrf

                <div class="space-y-5">
                    <!-- Name Field -->
                    <div class="relative">
                        <div class="absolute form-input-icon text-clinic-500">
                            <i data-feather="user"></i>
                        </div>
                        <input 
                            type="text" 
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Full Name" 
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-clinic-500 focus:outline-none transition"
                            required
                        >
                        @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Email Field -->
                    <div class="relative">
                        <div class="absolute form-input-icon text-clinic-500">
                            <i data-feather="mail"></i>
                        </div>
                        <input 
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email Address" 
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-clinic-500 focus:outline-none transition"
                            required
                        >
                        @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password Field -->
                    <div class="relative">
                        <div class="absolute form-input-icon text-clinic-500">
                            <i data-feather="lock"></i>
                        </div>
                        <input 
                            type="password"
                            name="password"
                            placeholder="Password" 
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-clinic-500 focus:outline-none transition"
                            required
                        >
                        @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="relative">
                        <div class="absolute form-input-icon text-clinic-500">
                            <i data-feather="lock"></i>
                        </div>
                        <input 
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirm Password" 
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-clinic-500 focus:outline-none transition"
                            required
                        >
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="terms"
                            name="terms"
                            class="rounded border-gray-300 text-clinic-500 focus:ring-clinic-500 mr-2"
                            required
                        >
                        <label for="terms" class="text-sm text-gray-600">
                            I agree to the <a href="#" class="text-clinic-600 hover:underline">Terms of Service</a> and <a href="#" class="text-clinic-600 hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full bg-clinic-500 hover:bg-clinic-600 text-white font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center space-x-2"
                    >
                        <i data-feather="user-plus" class="w-4 h-4"></i>
                        <span>Register as Doctor</span>
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-4 text-center border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    Already have an account? <a href="/doctor/login" class="font-medium text-clinic-600 hover:underline">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>