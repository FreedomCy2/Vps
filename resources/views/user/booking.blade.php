<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Services | Clinic Flow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .service-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.1); /* Updated color */
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2); /* Updated color */
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <i data-feather="heart" class="text-[#3b82f6] h-8 w-8"></i>
                    <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
                </div>
            </div>

            <!-- Right-aligned navigation -->
            <div class="flex items-center space-x-8 ml-auto">
                <!-- Link to introduction.blade.php -->
                <a href="{{ route('user.introduction') }}" class="border-[#3b82f6] text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                <!-- Link to services section in booking.blade.php -->
                <a href="{{ route('user.service') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Services</a>
                <a href="#contact" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#3b82f6]">
                    <span class="sr-only">Open main menu</span>
                    <i data-feather="menu"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Main content -->
<main id="home" class="container mx-auto px-6 py-16">
    <div class="text-center mb-16">
        <h1 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#3b82f6] to-[#3b82f6] mb-4">
            Book Your Appointment
        </h1>
        <p class="text-lg text-[#3b82f6]/90 max-w-2xl mx-auto font-medium">
            Choose from our wide range of healthcare services
        </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Doctor Consultation -->
        <div class="bg-white rounded-xl p-6 service-card">
            <div class="text-[#3b82f6] mb-4">
                <i data-feather="activity" class="w-10 h-10"></i>
            </div>
            <h3 class="text-xl font-bold mb-3">Doctor Consultation</h3>
            <p class="text-gray-600 mb-4">
                • General Consultation Chronic Disease Care (Diabetes, Chronic Disease Care (Diabetes, Hypertension, Asthma) <br><br>
                • Men’s Health Consultation <br><br>
                • Women’s Health Consultation <br><br>
                • Travel & Fit-to-Work Medicals
            </p>
            <div class="flex justify-between items-center">
                <a href="{{ route('user.information2') }}" class="px-4 py-2 bg-[#3b82f6] text-white rounded-lg hover:bg-[#3b82f6]/90 transition">Book Now</a>
            </div>
        </div>

        <!-- Child Health Consultation -->
        <div class="bg-white rounded-xl p-6 service-card">
            <div class="text-[#3b82f6] mb-4">
                <i data-feather="heart" class="w-10 h-10"></i>
            </div>
            <h3 class="text-xl font-bold mb-3">Child Health Consultation</h3>
            <p class="text-gray-600 mb-4">
                • Child Health Consultation
                <br><br>• Growth & Development Check-ups
                <br><br>• Common Illnesses (Fever, Flu, Allergies)
                <br><br>• Nutrition & Feeding Advice
                <br><br>• School Medicals & Health Certificates
            </p>
            <div class="flex justify-between items-center">
                <a href="{{ route('user.information2') }}" class="px-4 py-2 bg-[#3b82f6] text-white rounded-lg hover:bg-[#3b82f6]/90 transition">Book Now</a>
            </div>
        </div>

        <!-- Health Screening -->
        <div class="bg-white rounded-xl p-6 service-card">
            <div class="text-[#3b82f6] mb-4">
                <i data-feather="user" class="w-10 h-10"></i>
            </div>
            <h3 class="text-xl font-bold mb-3">Health Screening</h3>
            <p class="text-gray-600 mb-4">
                • Routine Health Check
                <br><br>• Pre-employment Medicals
                <br><br>• Executive / Comprehensive Check-up
                <br><br>• Senior Health Screening
                <br><br>• Heart & Fitness Screening
            </p>
            <div class="flex justify-between items-center">
                <a href="{{ route('user.information2') }}" class="px-4 py-2 bg-[#3b82f6] text-white rounded-lg hover:bg-[#3b82f6]/90 transition">Book Now</a>
            </div>
        </div>
    </div>
</main>

<!-- Footer / Contact Section -->
<footer id="contact" class="bg-gray-800">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Clinic</h3>
                <ul class="mt-4 space-y-4">
                    <li><a href="{{ route('user.introduction') }}" class="text-base text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="#" class="text-base text-gray-300 hover:text-white">Careers</a></li>
                    <li><a href="#" class="text-base text-gray-300 hover:text-white">News</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Services</h3>
                <ul class="mt-4 space-y-4">
                    <li><a href="#home" class="text-base text-gray-300 hover:text-white">Book a Doctor Consultation</a></li>
                    <li><a href="#home" class="text-base text-gray-300 hover:text-white">Book a Child Health Consultation</a></li>
                    <li><a href="#home" class="text-base text-gray-300 hover:text-white">Book a Health Screening</a></li>
                </ul>
            </div>
            <div></div>
            <div>
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Contact</h3>
                <ul class="mt-4 space-y-4">
                    <li class="text-base text-gray-300">Lot 17, Building Haji Abdul Kasim, Bandar Seri Begawan, Brunei Darussalam</li>
                    <li class="text-base text-gray-300">Phone: 227 7777</li>
                    <li class="text-base text-gray-300">Email: inquiry@clinicflow.bn</li>
                </ul>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-8 md:flex md:items-center md:justify-between">
            <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">&copy; 2025 Clinic Flow. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    feather.replace();
</script>
</body>
</html>