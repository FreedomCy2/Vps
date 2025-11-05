<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking | Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6', // Blue
                        danger: '#ef4444', // Red
                        secondary: '#10b981', // Green
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }

        /* Simple button base styles (Tailwind @apply not available at runtime) */
        .btn-base {
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: inherit; /* allow Tailwind text-* utilities to override when used */
            text-decoration: none;
        }
        .btn-base:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.12);
        }
        .btn-delete-action {
            background-color: #ef4444;
            color: #ffffff;
        }
        /* Ensure disabled state is visible */
        .btn-base:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
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
            <div class="flex items-center space-x-4">
                <a href="{{ route('user.history') }}" class="text-gray-600 font-medium hover:text-blue-700">History</a>
                <form method="POST" action="/logout"> 
                    @csrf
                    <button type="submit" class="text-gray-600 font-medium hover:text-gray-900">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-md mx-auto bg-white rounded-3xl shadow-xl p-8 sm:p-12 text-center">
        
        <i data-feather="alert-triangle" class="h-16 w-16 text-danger mx-auto mb-4"></i>
        
        <h1 class="text-3xl font-extrabold text-danger mb-4">Confirm Cancellation</h1>
        
        {{-- The booking_id is passed from the route closure in routes/web.php --}}
        <?php $booking_id = $booking_id ?? 'XXXXX'; ?>

        <p class="text-gray-700 mb-6">
            You are about to <strong>permanently cancel appointment #<span id="bookingIdDisplay" class="font-bold text-danger">{{ $booking_id }}</span></strong>.
        </p>
        <p class="text-gray-600 mb-8">
            Please confirm your decision. This action <strong>cannot be reversed</strong>.
        </p>

        {{-- Cancellation Form: This form would normally submit to a DELETE route on the backend --}}
        <form id="cancelForm" method="POST" action="{{-- route('user.booking.delete', $booking_id) --}}">
            @csrf
            @method('DELETE')
            
            <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                
                {{-- No, Go Back Button (Safely redirects to history) --}}
                <a href="{{ route('user.history') }}" class="btn-base bg-gray-300 text-gray-800 hover:bg-gray-400">
                    No, Keep Booking
                </a>
                
                {{-- Yes, Cancel Button (Triggers the simulated deletion and redirect) --}}
               <a href="{{ route('user.history') }}"
                  class="btn-base btn-delete-action" id="confirmCancelButton">
                   <i data-feather="x-circle" class="h-5 w-5 inline mr-2"></i>
                   Yes, Cancel It
               </a>
            </div>
        </form>

    </div>
</main>

<script>
    feather.replace();

    /**
     * Simulates the deletion process, changes the button state, and routes to history.blade.php.
     * @param {number|string} id - The ID of the booking to be cancelled.
     */
    function confirmCancel(id) {
        console.log(`Simulating cancellation of Booking ID: ${id}`);

        const confirmButton = document.getElementById('confirmCancelButton');
        confirmButton.textContent = 'Cancelling...';
        confirmButton.disabled = true;

        // --- CRITICAL: This is where the routing happens ---
        // After a small delay to simulate processing, it redirects to the history page,
        // passing 'status=cancelled' and the booking ID in the URL.
        setTimeout(() => {
            window.location.href = "{{ route('user.history') }}?status=cancelled&id=" + encodeURIComponent(id);
        }, 800);
    }
</script>

</body>
</html>