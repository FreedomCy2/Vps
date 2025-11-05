<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor - Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              100: '#ECFDF5',
              500: '#10B981',
              600: '#059669'
            }
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background-color: #ECFDF5;
    }
    .card {
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .input-field:focus {
      border-color: #10B981;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">
  <custom-navbar></custom-navbar>

  <main class="flex-grow flex items-center justify-center p-4">
    <div class="card bg-white rounded-xl p-8 max-w-md w-full">
      <div class="text-center mb-8">
        <i data-feather="key" class="w-12 h-12 text-primary-500 mx-auto"></i>
        <h1 class="text-2xl font-bold text-gray-800 mt-4">Reset Your Password</h1>
        <p class="text-gray-600 mt-2">Enter your email to receive a password reset link</p>
      </div>

      {{-- success message (status) --}}
      @if (session('status'))
        <div class="mb-4 text-sm text-green-700 bg-green-100 p-3 rounded text-center">
          {{ session('status') }}
        </div>
      @endif

      {{-- validation errors --}}
      @if ($errors->any())
        <div class="mb-4 text-sm text-red-700 bg-red-100 p-3 rounded">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('doctor.password.email') }}" class="space-y-6">
        @csrf

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
          <div class="relative">
            <input 
              type="email" 
              name="email"
              id="email" 
              value="{{ old('email') }}"
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
              placeholder="your@email.com">
            <i data-feather="mail" class="absolute right-3 top-3.5 text-gray-400"></i>
          </div>
        </div>

        <button 
          type="submit" 
          class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center shadow-md hover:shadow-lg">
          <i data-feather="send" class="mr-2"></i>
          Send Password Reset Link
        </button>
      </form>

      <div class="mt-6 text-center">
            <a href="{{ route('doctor.login') }}" class="text-primary-500 hover:text-primary-600 font-medium flex items-center justify-center">
          <i data-feather="arrow-left" class="mr-1"></i> Back to Login
        </a>
      </div>
    </div>
  </main>

  <custom-footer></custom-footer>

  <script src="components/navbar.js"></script>
  <script src="components/footer.js"></script>
  <script> feather.replace(); </script>
</body>
</html>
