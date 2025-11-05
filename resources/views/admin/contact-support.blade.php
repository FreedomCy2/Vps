<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact Support - Clinic Flow (Admin)</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f5f7fa',
              100: '#c3cfe2',
              500: '#3DA6C1',
              600: '#2C8AA6'
            }
          }
        }
      }
    }
  </script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body { font-family: 'Inter', sans-serif; background: #ffffff; min-height:100vh; }
    .card-shadow { box-shadow: 0 10px 25px -5px rgba(0,0,0,0.08), 0 6px 12px -6px rgba(0,0,0,0.06); }
    .form-error { color: #ef4444; font-size: .8125rem; }
    .input-focus:focus { border-color: #3DA6C1; box-shadow: 0 0 0 4px rgba(61,166,193,0.08); }
    .btn-primary { background-color: #3DA6C1; }
    .btn-primary:hover { background-color: #2C8AA6; }
  </style>
</head>
<body class="flex items-center justify-center py-12 px-4">

  <div class="max-w-3xl w-full">
    <div class="bg-white rounded-xl card-shadow overflow-hidden">
      <!-- Header -->
      <div class="bg-gradient-to-r from-primary-500 to-primary-600 py-6 px-8 text-center">
        <i data-feather="headphones" class="w-12 h-12 mx-auto text-white"></i>
        <h1 class="text-2xl font-semibold text-white mt-3">Contact Support</h1>
        <p class="text-primary-100 mt-1 text-sm">We're here to help — send us a message and we'll get back to you ASAP</p>
      </div>

      <div class="p-8">
        @if(session('status'))
          <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <div class="flex items-center">
              <i data-feather="check-circle" class="text-green-500 mr-2"></i>
              <span class="text-green-700 text-sm">{{ session('status') }}</span>
            </div>
          </div>
        @endif

        @if($errors->any())
          <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <div class="flex items-center">
              <i data-feather="alert-triangle" class="text-red-500 mr-2"></i>
              <div class="text-red-700 text-sm">
                Please review the form and fix the errors below.
              </div>
            </div>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" id="supportForm" class="space-y-6">
          @csrf

          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
            <input id="name" name="name" type="text" required
                   value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 input-focus"
                   placeholder="Full name">
            @error('name') <p class="form-error mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input id="email" name="email" type="email" required
                   value="{{ old('email') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 input-focus"
                   placeholder="you@clinicflow.com">
            @error('email') <p class="form-error mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <input id="subject" name="subject" type="text"
                   value="{{ old('subject') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 input-focus"
                   placeholder="Short summary">
            @error('subject') <p class="form-error mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <textarea id="message" name="message" rows="6" required
                      class="w-full border border-gray-300 rounded-lg px-4 py-3 input-focus"
                      placeholder="Describe the issue or question">{{ old('message') }}</textarea>
            @error('message') <p class="form-error mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 text-sm hover:underline flex items-center">
              <i data-feather="arrow-left" class="mr-2"></i> Back to Dashboard
            </a>

            <button type="submit"
                    class="btn-primary text-white font-medium py-3 px-5 rounded-lg shadow-sm flex items-center">
              <i data-feather="send" class="mr-2"></i> Send Message
            </button>
          </div>
        </form>

        <div class="mt-6 text-sm text-gray-600">
          <p>If this is an urgent issue, call support at <span class="font-medium">+1 (555) 555-5555</span> or email <a href="mailto:support@clinicflow.com" class="text-primary-500 hover:text-primary-600">support@clinicflow.com</a>.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    feather.replace();

    // simple client-side validation to mirror server rules
    document.getElementById('supportForm')?.addEventListener('submit', function(e){
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const message = document.getElementById('message').value.trim();
      if (!name || !email || !message) {
        e.preventDefault();
        alert('Please fill in your name, email and message before sending.');
      }
    });
  </script>
</body>
</html>