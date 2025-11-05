<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Clinic Flow</title>
  <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            aqua: '#3DA6C1',
            aquaDark: '#2C8AA6'
          }
        }
      }
    }
  </script>
  <style>
    .input-focus:focus-within {
      box-shadow: 0 0 0 3px rgba(61, 166, 193, 0.3);
      border-color: #3DA6C1;
    }
    .input-error {
      border-color: #ef4444;
    }
    .input-error:focus-within {
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.3);
      border-color: #ef4444;
    }
    .shake {
      animation: shake 0.5s ease-in-out;
    }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
  </style>
</head>
<body class="bg-[#e8faff] min-h-screen flex items-center justify-center p-4">
  <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-aqua py-6 px-8 text-center">
      <h1 class="text-3xl font-bold text-white">Create Account</h1>
      <p class="text-white/90 mt-2">Dive into your new experience</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.register.submit') }}" class="p-8" id="registerForm">
      @csrf
      
      <!-- Success Message Container -->
      @if (session('status'))
        <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded">
          <div class="flex items-center">
            <i data-feather="check-circle" class="text-green-500 mr-2"></i>
            <span class="text-green-700 text-sm">{{ session('status') }}</span>
          </div>
        </div>
      @endif

      <!-- Validation Errors -->
      @if ($errors->any())
        <div id="formErrors" class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
          <div class="flex items-center">
            <i data-feather="alert-triangle" class="text-red-500 mr-2"></i>
            <div>
              @foreach ($errors->all() as $error)
                <p class="text-red-700 text-sm">{{ $error }}</p>
              @endforeach
            </div>
          </div>
        </div>
      @endif

      <div class="space-y-6">
        <!-- Name -->
        <div class="transition-all duration-200 border border-gray-200 rounded-lg px-4 py-3 input-focus {{ $errors->has('name') ? 'input-error' : '' }}" id="nameContainer">
          <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
          <div class="flex items-center">
            <i data-feather="user" class="text-gray-400 mr-2"></i>
            <input 
              type="text" 
              id="name"
              name="name" 
              value="{{ old('name') }}"
              required 
              autofocus
              autocomplete="name"
              class="w-full outline-none bg-transparent placeholder-gray-300 text-gray-700"
              placeholder="John Doe"
            >
          </div>
          @error('name')
            <p class="text-red-500 text-xs mt-1 flex items-center" id="nameError">
              <i data-feather="alert-circle" class="w-3 h-3 mr-1"></i>
              <span class="error-message">{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Email -->
        <div class="transition-all duration-200 border border-gray-200 rounded-lg px-4 py-3 input-focus {{ $errors->has('email') ? 'input-error' : '' }}" id="emailContainer">
          <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email Address</label>
          <div class="flex items-center">
            <i data-feather="mail" class="text-gray-400 mr-2"></i>
            <input 
              type="email" 
              id="email"
              name="email" 
              value="{{ old('email') }}"
              required 
              autocomplete="email"
              class="w-full outline-none bg-transparent placeholder-gray-300 text-gray-700"
              placeholder="you@example.com"
            >
          </div>
          @error('email')
            <p class="text-red-500 text-xs mt-1 flex items-center" id="emailError">
              <i data-feather="alert-circle" class="w-3 h-3 mr-1"></i>
              <span class="error-message">{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Password -->
        <div class="transition-all duration-200 border border-gray-200 rounded-lg px-4 py-3 input-focus {{ $errors->has('password') ? 'input-error' : '' }}" id="passwordContainer">
          <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Password</label>
          <div class="flex items-center">
            <i data-feather="lock" class="text-gray-400 mr-2"></i>
            <input 
              type="password" 
              id="password"
              name="password" 
              required 
              autocomplete="new-password"
              class="w-full outline-none bg-transparent placeholder-gray-300 text-gray-700"
              placeholder="••••••••"
            >
          </div>
          @error('password')
            <p class="text-red-500 text-xs mt-1 flex items-center" id="passwordError">
              <i data-feather="alert-circle" class="w-3 h-3 mr-1"></i>
              <span class="error-message">{{ $message }}</span>
            </p>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="transition-all duration-200 border border-gray-200 rounded-lg px-4 py-3 input-focus" id="passwordConfirmationContainer">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1">Confirm Password</label>
          <div class="flex items-center">
            <i data-feather="lock" class="text-gray-400 mr-2"></i>
            <input 
              type="password" 
              id="password_confirmation"
              name="password_confirmation" 
              required 
              autocomplete="new-password"
              class="w-full outline-none bg-transparent placeholder-gray-300 text-gray-700"
              placeholder="••••••••"
            >
          </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start space-x-2" id="termsContainer">
          <input 
            type="checkbox" 
            id="terms"
            name="terms" 
            required
            class="mt-1 rounded border-gray-300 text-aqua focus:ring-aqua"
          >
          <label for="terms" class="text-sm text-gray-600">
            I agree to the 
            <a href="#" class="text-aqua hover:text-aquaDark font-medium">Terms of Service</a> 
            and 
            <a href="#" class="text-aqua hover:text-aquaDark font-medium">Privacy Policy</a>
          </label>
        </div>
        @error('terms')
          <p class="text-red-500 text-xs mt-1 flex items-center" id="termsError">
            <i data-feather="alert-circle" class="w-3 h-3 mr-1"></i>
            {{ $message }}
          </p>
        @enderror

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-aqua hover:bg-aquaDark text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
          <i data-feather="user-plus" class="mr-2"></i>
          Register Now
        </button>

        <!-- Login Link -->
        <p class="text-center text-gray-500 text-sm">
          Already have an account? 
          <a href="{{ route('admin.login') }}" class="text-aqua hover:text-aquaDark font-medium">Sign in</a>
        </p>
      </div>
    </form>
  </div>

  <script>
    feather.replace();
    
    // Real-time password confirmation validation
    document.getElementById('password_confirmation')?.addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = this.value;
      const errorElement = document.getElementById('passwordConfirmationError');
      const containerElement = document.getElementById('passwordConfirmationContainer');
      
      if (confirmPassword && password !== confirmPassword) {
        if (!errorElement) {
          const newErrorElement = document.createElement('p');
          newErrorElement.className = 'text-red-500 text-xs mt-1 flex items-center';
          newErrorElement.id = 'passwordConfirmationError';
          newErrorElement.innerHTML = '<i data-feather="alert-circle" class="w-3 h-3 mr-1"></i><span class="error-message">The passwords do not match.</span>';
          containerElement.appendChild(newErrorElement);
          feather.replace();
        }
        containerElement.classList.add('input-error');
      } else {
        if (errorElement) {
          errorElement.remove();
        }
        containerElement.classList.remove('input-error');
      }
    });
  </script>
</body>
</html>