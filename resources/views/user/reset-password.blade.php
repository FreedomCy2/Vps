<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Clinic Flow</title>
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

<!-- Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <i data-feather="heart" class="text-primary h-8 w-8"></i>
                <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
            </div>
        </div>
    </div>
</nav>

<!-- Reset Password Section -->
<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-xl p-10">
        <h1 class="text-3xl font-extrabold text-primary mb-6 text-center">Reset Your Password</h1>
        <p class="text-gray-600 text-center mb-8">Enter your new password below.</p>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('user.password.update') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div>
                <label for="email" class="block text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary" required autofocus>
            </div>

            <div>
                <label for="password" class="block text-gray-700 mb-1">New Password</label>
                <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary" required>
                <p class="text-sm text-gray-500 mt-1">Minimum 8 characters</p>
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary" required>
            </div>

            <button type="submit" class="w-full btn-primary text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                Reset Password
            </button>
        </form>

        <!-- Back to Login -->
        <div class="mt-6 text-center">
            <a href="{{ route('user.login') }}" class="text-sm text-primary hover:underline">Back to login</a>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 mt-16">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center text-gray-400">
        &copy; 2025 Clinic Flow. All rights reserved.
    </div>
</footer>

<!-- Scripts -->
<script>
    feather.replace();
</script>

</body>
</html>