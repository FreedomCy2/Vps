<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Doctor') - Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .sidebar-item:hover .sidebar-icon { transform: translateX(5px); transition: all 0.3s ease; }
        .active-route { background-color: #10B981; color: white; }
        .active-route .sidebar-icon { color: white; }
        .modal { display: none; position: fixed; top: 0; left: 0; width:100%; height:100%; background: rgba(0,0,0,.5); z-index:1000; align-items:center; justify-content:center; }
        .modal-content { background:#fff; border-radius:8px; padding:24px; max-width:600px; width:90%; }
        .dropdown-menu { display:none; position:absolute; right:0; top:100%; background:#fff; min-width:180px; box-shadow:0 8px 16px rgba(0,0,0,.1); border-radius:8px; z-index:1000; margin-top:8px; border:1px solid #e5e7eb; }
        .dropdown-menu.show { display:block; }
        .dropdown-item { display:flex; align-items:center; padding:12px 16px; color:#374151; text-decoration:none; transition:all 0.2s ease; }
        .dropdown-item:hover { background-color:#f9fafb; }
        .dropdown-divider { height:1px; background-color:#e5e7eb; margin:4px 0; }
    </style>
    @stack('head')
</head>
<body class="bg-gray-100 font-sans flex">
    <!-- Sidebar following admin design but with green color -->
    <div class="w-64 bg-white shadow-lg h-screen fixed">
        <div class="p-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-[#10B981] flex items-center">
                <i data-feather="heart" class="mr-2"></i>
                Clinic Flow
            </h1>
            <p class="text-xs text-gray-500 mt-1">Doctor Dashboard</p>
        </div>
        <nav class="mt-6">
            <div class="px-4"><h3 class="text-xs uppercase text-gray-500 font-semibold tracking-wider">Main</h3></div>
            <div class="mt-3">
                <a href="/doctor/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#10B981]/10 sidebar-item {{ Request::is('doctor/dashboard') ? 'active-route' : '' }}">
                    <i data-feather="home" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/doctor/appointments" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#10B981]/10 sidebar-item {{ Request::is('doctor/appointments*') ? 'active-route' : '' }}">
                    <i data-feather="calendar" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">My Appointments</span>
                </a>
                <a href="/doctor/history" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#10B981]/10 sidebar-item {{ Request::is('doctor/history*') ? 'active-route' : '' }}">
                    <i data-feather="clock" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">History</span>
                </a>
                <a href="/doctor/availability" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#10B981]/10 sidebar-item {{ Request::is('doctor/availability*') ? 'active-route' : '' }}">
                    <i data-feather="settings" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">Availability</span>
                </a>
                <a href="/doctor/notifications" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#10B981]/10 sidebar-item {{ Request::is('doctor/notifications*') ? 'active-route' : '' }}">
                    <i data-feather="bell" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">Notifications</span>
                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </a>
                <a href="/doctor/profile" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#10B981]/10 sidebar-item {{ Request::is('doctor/profile*') ? 'active-route' : '' }}">
                    <i data-feather="user" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">Profile Settings</span>
                </a>
            </div>
        </nav>
        

                <div>

                </div>
            </div>
        </div>
    </div>

    <!-- Main content area following admin layout -->
    <div class="flex-1 ml-64 p-8">
        <header class="bg-white rounded-lg shadow-sm p-4 mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">@yield('header-title', 'Doctor Dashboard')</h2>
                <p class="text-sm text-gray-500">@yield('header-subtitle', 'Welcome back, Doctor')</p>
            </div>
            <div class="flex items-center space-x-4">

                <div class="relative">
                    <a href="/doctor/notifications" class="p-2 rounded-full hover:bg-gray-100">
                        <i data-feather="bell" class="text-gray-500 cursor-pointer hover:text-[#10B981]"></i>
                    </a>
                    <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                </div>
                <div class="relative" id="user-menu">
                    <button id="user-menu-button" class="flex items-center focus:outline-none">
                        <div class="w-8 h-8 bg-[#10B981] rounded-full flex items-center justify-center text-white font-medium mr-2">DR</div>
                        <span class="font-medium">{{ $doctor->name ?? 'Doctor' }}</span>
                        <i data-feather="chevron-down" class="ml-1 w-4 h-4"></i>
                    </button>
                    <div class="dropdown-menu" id="dropdown-menu">
                        <a href="/doctor/profile" class="dropdown-item"><i data-feather="user" class="mr-2 w-4 h-4"></i>Profile</a>
                        <a href="/doctor/settings" class="dropdown-item"><i data-feather="settings" class="mr-2 w-4 h-4"></i>Settings</a>
                        <div class="dropdown-divider"></div>
                        <button id="logout-button" type="button" class="dropdown-item text-red-600"><i data-feather="log-out" class="mr-2 w-4 h-4"></i>Logout</button>
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
    </div>

    <!-- Logout Confirmation Modal + form (same as admin) -->
    <div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex items-center mb-4"><h3 class="text-lg font-semibold">Confirm Logout</h3></div>
            <p class="text-gray-600 mb-6">Are you sure you want to logout from Clinic Flow?</p>
            <div class="flex justify-end space-x-3">
                <button id="cancel-logout" type="button" class="px-4 py-2 rounded bg-gray-200">Cancel</button>
                <button id="confirm-logout" type="button" class="px-4 py-2 rounded bg-red-500 text-white">Logout</button>
            </div>
        </div>
    </div>
    <form id="logout-form" method="POST" action="{{ route('doctor.logout') }}" class="hidden">@csrf</form>

    <script>
        feather.replace();
        document.addEventListener('DOMContentLoaded', function() {
            // User dropdown functionality
            const userMenuButton = document.getElementById('user-menu-button');
            const dropdownMenu = document.getElementById('dropdown-menu');
            userMenuButton && userMenuButton.addEventListener('click', function(){ dropdownMenu.classList.toggle('show'); });
            document.addEventListener('click', function(e){ if (!e.target.closest('#user-menu')) dropdownMenu && dropdownMenu.classList.remove('show'); });
            
            // Logout modal functionality
            const logoutButton = document.getElementById('logout-button');
            const logoutForm = document.getElementById('logout-form');
            const logoutModal = document.getElementById('logout-modal');
            const cancelLogout = document.getElementById('cancel-logout');
            const confirmLogout = document.getElementById('confirm-logout');
            logoutButton && logoutButton.addEventListener('click', function(e){ e.preventDefault(); logoutModal.classList.remove('hidden'); });
            cancelLogout && cancelLogout.addEventListener('click', function(){ logoutModal.classList.add('hidden'); });
            confirmLogout && confirmLogout.addEventListener('click', function(){ logoutForm.submit(); });
            
            // Auto-hide alerts (from doctor layout)
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>
</html>