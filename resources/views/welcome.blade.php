<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicFlow - Healthcare Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#F0F9FF',
                            100: '#E0F2FE',
                            500: '#0EA5E9',
                            600: '#0284C7',
                            700: '#0369A1',
                        },
                        patient: {
                            100: '#EFF6FF',
                            500: '#3B82F6',
                            600: '#2563EB',
                        },
                        staff: {
                            100: '#E3F6F9',
                            500: '#3DA6C1',
                            600: '#2C8AA6',
                        },
                        doctor: {
                            100: '#ECFDF5',
                            500: '#10B981',
                            600: '#059669',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fdff 0%, #f0f9ff 100%);
            min-height: 100vh;
        }
        .professional-card {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        .professional-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(14, 165, 233, 0.15);
            border-color: #0EA5E9;
        }
        .header-gradient {
            background: linear-gradient(135deg, #0EA5E9 0%, #0369A1 100%);
        }
        .staff-gradient {
            background: linear-gradient(135deg, #3DA6C1 0%, #2C8AA6 100%);
        }
        .pulse-glow {
            animation: pulse-glow 3s infinite;
        }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(14, 165, 233, 0); }
            100% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0); }
        }
    </style>
</head>
<body class="font-sans">
    <!-- Header -->
    <header class="header-gradient text-white py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold">ClinicFlow</h1>
            </div>
            <div class="text-sm">
                <span class="hidden md:inline">Healthcare Management System</span>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-12">
        <!-- Hero Section -->
        <div class="max-w-4xl mx-auto text-center mb-16">
            <div class="flex justify-center mb-6">
                <div class="bg-white p-4 rounded-full shadow-lg pulse-glow">
                    <div class="bg-primary-50 rounded-full p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Welcome to ClinicFlow</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-6">Professional healthcare management for modern medical practices</p>
            <div class="w-24 h-1 bg-primary-500 mx-auto rounded-full"></div>
        </div>

        <!-- Portal Cards -->
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Patient Portal -->
            <div class="professional-card bg-white rounded-xl shadow-sm overflow-hidden h-full border border-gray-100">
                <div class="p-8 h-full flex flex-col">
                    <div class="flex justify-center mb-6">
                        <div class="bg-patient-100 rounded-full p-4 border border-patient-500 border-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-patient-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-semibold text-center text-gray-800 mb-3">Patient Portal</h3>
                    <p class="text-gray-600 text-center mb-6 flex-grow">Access your medical records, schedule appointments, and communicate with your healthcare providers.</p>
                    <a href="{{ route('user.introduction') }}" class="block w-full bg-patient-500 hover:bg-patient-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 text-center">
                        Patient Login
                    </a>
                </div>
            </div>

            <!-- Staff Portal -->
            <div class="professional-card bg-white rounded-xl shadow-sm overflow-hidden h-full border border-gray-100">
                <div class="p-8 h-full flex flex-col">
                    <div class="flex justify-center mb-6">
                        <div class="bg-staff-100 rounded-full p-4 border border-staff-500 border-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-staff-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-semibold text-center text-gray-800 mb-3">Staff Portal</h3>
                    <p class="text-gray-600 text-center mb-6 flex-grow">Manage appointments, patient records, billing, and daily clinic operations.</p>
                    <a href="{{ route('admin.login') }}" class="block w-full staff-gradient text-white font-semibold py-3 px-4 rounded-lg transition duration-300 text-center">
                        Staff Login
                    </a>
                </div>
            </div>

            <!-- Doctor Portal -->
            <div class="professional-card bg-white rounded-xl shadow-sm overflow-hidden h-full border border-gray-100">
                <div class="p-8 h-full flex flex-col">
                    <div class="flex justify-center mb-6">
                        <div class="bg-doctor-100 rounded-full p-4 border border-doctor-500 border-opacity-20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-doctor-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-semibold text-center text-gray-800 mb-3">Doctor Portal</h3>
                    <p class="text-gray-600 text-center mb-6 flex-grow">Access patient charts, clinical notes, diagnostic results, and treatment plans.</p>
                    <a href="{{ route('doctor.login') }}" class="block w-full bg-doctor-500 hover:bg-doctor-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 text-center">
                        Medical Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="max-w-4xl mx-auto mt-16 bg-white rounded-xl shadow-sm p-8 border border-gray-100">
            <div class="grid md:grid-cols-3 gap-6 text-center">
                <div class="p-4">
                    <div class="bg-patient-100 rounded-full p-3 inline-flex mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-patient-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Secure & Compliant</h4>
                    <p class="text-sm text-gray-600">HIPAA compliant platform ensuring your health data privacy</p>
                </div>
                <div class="p-4">
                    <div class="bg-staff-100 rounded-full p-3 inline-flex mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-staff-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Efficient Workflow</h4>
                    <p class="text-sm text-gray-600">Streamlined processes for better patient care and clinic management</p>
                </div>
                <div class="p-4">
                    <div class="bg-doctor-100 rounded-full p-3 inline-flex mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-doctor-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-2">Integrated Care</h4>
                    <p class="text-sm text-gray-600">Seamless coordination between patients, staff and medical providers</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="max-w-4xl mx-auto mt-12 text-center">
            <p class="text-gray-500 text-sm">Need assistance? <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Contact our support team</a> or call (555) 123-4567</p>
            <div class="mt-4 text-xs text-gray-400">
                <p>© 2023 ClinicFlow Healthcare Management System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
        
        // Simple animation for the cards on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.professional-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease ' + (index * 0.1) + 's';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
</body>
</html>