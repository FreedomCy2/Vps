<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clinic Flow')</title>
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
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .sidebar { transition: all 0.3s ease; }
        .active-tab { background-color: #ECFDF5; border-left: 4px solid #10B981; color: #059669; }
        .history-card { transition: all 0.2s ease; }
        .history-card:hover { transform: translateY(-1px); box-shadow: 0 8px 25px -8px rgba(0,0,0,0.1); }
        .alert { padding: 1rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: 0.375rem; }
        .alert-success { color: #065f46; background-color: #d1fae5; border-color: #a7f3d0; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 shadow-md flex flex-col">
            <div class="p-6">
                <div class="flex items-center space-x-2">
                    <i data-feather="heart" class="text-clinic-500 w-6 h-6"></i>
                    <h1 class="text-xl font-bold text-gray-800">Clinic Flow</h1>
                </div>
                <p class="mt-1 text-sm text-gray-500">Doctor Dashboard</p>
            </div>
            
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-2">
                    <li>
                        <a href="/doctor/dashboard" 
                           class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 
                           {{ request()->is('doctor/dashboard') ? 'active-tab text-clinic-600 font-semibold' : 'text-gray-700' }}">
                           <i data-feather="home" class="w-5 h-5 mr-3"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/appointments" 
                           class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 
                           {{ request()->is('doctor/appointments') ? 'active-tab text-clinic-600 font-semibold' : 'text-gray-700' }}">
                           <i data-feather="calendar" class="w-5 h-5 mr-3"></i>My Appointments
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/history" 
                           class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 
                           {{ request()->is('doctor/history') ? 'active-tab text-clinic-600 font-semibold' : 'text-gray-700' }}">
                           <i data-feather="clock" class="w-5 h-5 mr-3"></i>History
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/availability" 
                           class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 
                           {{ request()->is('doctor/availability') ? 'active-tab text-clinic-600 font-semibold' : 'text-gray-700' }}">
                           <i data-feather="settings" class="w-5 h-5 mr-3"></i>Availability
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/notifications" 
                           class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 
                           {{ request()->is('doctor/notifications') ? 'active-tab text-clinic-600 font-semibold' : 'text-gray-700' }}">
                           <i data-feather="bell" class="w-5 h-5 mr-3"></i>
                           Notifications
                           <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/profile" 
                           class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 
                           {{ request()->is('doctor/profile') ? 'active-tab text-clinic-600 font-semibold' : 'text-gray-700' }}">
                           <i data-feather="user" class="w-5 h-5 mr-3"></i>Profile Settings
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">DR</div>
                    <div>
                        @php
                            $doctor = \App\Models\Doctor::find(session('doctor_id'));
                        @endphp
                        <span class="font-medium">{{ $doctor->name ?? 'Doctor' }}</span>
                        <p class="text-xs text-gray-500">Cardiologist</p>
                    </div>
                </div>
                <!-- Added ID for JS -->
                <button id="sidebar-logout-button" class="w-full mt-4 flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800 py-2 rounded-lg hover:bg-gray-100">
                    <i data-feather="log-out" class="w-4 h-4"></i>
                    <span>Logout</span>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">@yield('header-title')</h2>
                    <p class="text-sm text-gray-500">@yield('header-subtitle')</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <a href="/doctor/notifications" class="p-2 rounded-full hover:bg-gray-100">
                            <i data-feather="bell" class="w-5 h-5 text-gray-600"></i>
                        </a>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-2 h-2"></span>
                    </div>
                    <div class="w-8 h-8 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">SJ</div>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex items-center mb-4">
                <h3 class="text-lg font-semibold">Confirm Logout</h3>
            </div>
            <p class="text-gray-600 mb-6">Are you sure you want to logout?</p>
            <div class="flex justify-end space-x-3">
                <button id="cancel-logout" type="button" class="px-4 py-2 rounded bg-gray-200">Cancel</button>
                <button id="confirm-logout" type="button" class="px-4 py-2 rounded bg-red-500 text-white">Logout</button>
            </div>
        </div>
    </div>

    <!-- Hidden logout form -->
    <form id="logout-form" method="POST" action="{{ route('doctor.logout') }}" class="hidden">
        @csrf
    </form>

    <script>
        feather.replace();

        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('sidebar-logout-button');
            const logoutForm = document.getElementById('logout-form');
            const logoutModal = document.getElementById('logout-modal');
            const cancelLogout = document.getElementById('cancel-logout');
            const confirmLogout = document.getElementById('confirm-logout');

            // open modal when user clicks logout in the sidebar
            logoutButton && logoutButton.addEventListener('click', function(e) {
                e.preventDefault();
                logoutModal.classList.remove('hidden');
            });

            cancelLogout && cancelLogout.addEventListener('click', function() {
                logoutModal.classList.add('hidden');
            });

            // on confirm, submit the hidden POST logout form
            confirmLogout && confirmLogout.addEventListener('click', function() {
                logoutForm.submit();
            });

            // auto-hide alerts
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
</body>
</html>