<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule - Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .sidebar-item:hover .sidebar-icon {
            transform: translateX(5px);
            transition: all 0.3s ease;
        }
        .active-route {
            background-color: #68D6EC;
            color: white;
        }
        .active-route .sidebar-icon {
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg h-screen fixed">
        <div class="p-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-[#68D6EC] flex items-center">
                <i data-feather="activity" class="mr-2"></i>
                Clinic Flow
            </h1>
        </div>
        <nav class="mt-6">
            <div class="px-4">
                <h3 class="text-xs uppercase text-gray-500 font-semibold tracking-wider">Main</h3>
            </div>
            <div class="mt-3">
                <a href="/admin/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="home" class="sidebar-icon mr-3 text-blue-500"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/admin/booking" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="calendar" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">Booking</span>
                </a>
                <a href="/admin/doctors" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="user" class="sidebar-icon mr-3 text-purple-500"></i>
                    <span class="font-medium">Doctors</span>
                </a>
                <a href="/admin/manage-users" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="users" class="sidebar-icon mr-3 text-red-500"></i>
                    <span class="font-medium">Manage Users</span>
                </a>
                <a href="/admin/reminders" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="bell" class="sidebar-icon mr-3 text-yellow-500"></i>
                    <span class="font-medium">Reminders</span>
                </a>
                <a href="/admin/schedule" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item active-route">
                    <i data-feather="clock" class="sidebar-icon mr-3 text-indigo-500"></i>
                    <span class="font-medium">Schedule</span>
                </a>
                <a href="/admin/records" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="file-text" class="sidebar-icon mr-3 text-teal-500"></i>
                    <span class="font-medium">Records</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-8">
        <!-- Header -->
        <header class="bg-white rounded-lg shadow-sm p-4 mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Dashboard Overview</h2>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                </div>
                <div class="relative">
                    <i data-feather="bell" class="text-gray-500 cursor-pointer hover:text-[#68D6EC]"></i>
                    <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                </div>
                <div class="flex items-center">
                    <img src="http://static.photos/people/200x200/1" alt="Admin" class="w-8 h-8 rounded-full mr-2">
                    <span class="font-medium">Admin</span>
                </div>
            </div>
        </header>

        <!-- Empty Content Area -->
        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
            <div class="max-w-md mx-auto">
                <div class="bg-indigo-100 p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i data-feather="clock" class="text-indigo-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Schedule Management</h3>
                <p class="text-gray-500 mb-6">This page will contain the schedule management interface. Content will be added here later.</p>
                <div class="text-gray-400">
                    <i data-feather="folder" class="w-12 h-12 mx-auto mb-2"></i>
                    <p class="text-sm">Empty content area</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
        
        // Highlight current route in sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname.split('/').pop() || 'dashboard';
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            
            sidebarItems.forEach(item => {
                const href = item.getAttribute('href').split('/').pop();
                if (href === currentPath || (currentPath === '' && href === 'dashboard')) {
                    item.classList.add('active-route');
                } else {
                    item.classList.remove('active-route');
                }
            });
        });
    </script>
</body>
</html>