<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login | Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6', secondary: '#10b981' } } } }</script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .btn-primary { background-color: #3b82f6; transition: all 0.3s ease; }
        .btn-primary:hover { background-color: #2563eb; transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);}
        .error-message { color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; }
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
        </div>
    </div>
</nav>

<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden p-10">
        <h1 class="text-4xl font-extrabold text-primary mb-6 text-center">Login to Your Account</h1>

        <div class="flex justify-center mb-8 space-x-6">
            <button id="login-tab" class="px-4 py-2 font-medium text-primary border-b-2 border-primary">Login</button>
            <button id="register-tab" class="px-4 py-2 font-medium text-gray-500 border-b-2 border-transparent hover:text-primary">Register</button>
        </div>

        {{-- Success message --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error message --}}
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Login form (POST) --}}
        <form id="login-form" method="POST" action="{{ route('user.login.submit') }}" class="space-y-6">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
                    <ul class="text-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="email" class="block text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary"
                    required
                >
            </div>
            <div>
                <label for="password" class="block text-gray-700 mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary"
                    required
                >
            </div>

            <div class="flex justify-end">
                <a href="{{ route('user.forgotpassword') ?? '#' }}" class="text-sm text-primary hover:underline">Forgot password?</a>
            </div>

            <button type="submit" class="w-full block text-center bg-primary text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition btn-primary">
                Login
            </button>
        </form>

        {{-- Register form (separate) --}}
        <form id="register-form" action="{{ route('register') }}" method="POST" class="space-y-6 hidden mt-6">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="email_reg" class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email_reg" class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password_reg" class="block text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password_reg" class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded-lg p-4 focus:ring-primary focus:border-primary" required>
            </div>
            <button type="submit" class="w-full btn-primary text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                Register
            </button>
        </form>

    </div>
</main>

<footer class="bg-gray-800 mt-16">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center text-gray-400">
        &copy; 2025 Clinic Flow. All rights reserved.
    </div>
</footer>

<script>
    feather.replace();

    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    loginTab.addEventListener('click', () => {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        loginTab.classList.add('border-primary', 'text-primary');
        loginTab.classList.remove('text-gray-500');
        registerTab.classList.remove('border-primary', 'text-primary');
        registerTab.classList.add('text-gray-500');
    });

    registerTab.addEventListener('click', () => {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        registerTab.classList.add('border-primary', 'text-primary');
        registerTab.classList.remove('text-gray-500');
        loginTab.classList.remove('border-primary', 'text-primary');
        loginTab.classList.add('text-gray-500');
    });
</script>

</body>
</html>