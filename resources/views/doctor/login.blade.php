<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login | Healing Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ECFDF5;
        }
        
        .login-card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .login-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .input-field:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="login-card bg-white rounded-xl p-8 relative">
            <div class="text-center mb-8">
                <!-- Back button positioned to the left side of the card -->
                <a href="{{ url('/') }}" class="absolute left-4 top-4 p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 z-10" title="Back to welcome">
                    <i data-feather="arrow-left" class="w-4 h-4"></i>
                </a>
                <div class="flex justify-center items-center mb-4">
                    <div class="bg-emerald-500 p-3 rounded-full">
                        <i data-feather="activity" class="text-white w-8 h-8"></i>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Doctor's Portal</h1>
                <p class="text-gray-500 mt-2">Sign in to access your dashboard</p>
            </div>
            
            <form action="{{ url('/doctor/login') }}" method="POST">
                @csrf
                @if($errors->any())
                    <div class="mb-4">
                        <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
                    </div>
                @endif
                @if(session('success'))
                    <div class="mb-4">
                        <p class="text-green-600 text-sm">{{ session('success') }}</p>
                    </div>
                @endif
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="input-field w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="doctor@example.com" required>
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" class="input-field w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="••••••••" required>
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <a href="/doctor/forgot-password" class="text-sm text-emerald-600 hover:text-emerald-500">Forgot password?</a>
                </div>
                
                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                    Sign In
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    New doctor? <a href="/doctor/register" class="text-emerald-600 hover:text-emerald-500 font-medium">Register your account</a>
                </p>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-400">
                © 2025 Clinic ClinicFlow. All rights reserved.
            </p>
        </div>
    </div>
    
    <script>
        feather.replace();
    </script>
</body>
</html>