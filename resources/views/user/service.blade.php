<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Services | Clinic Flow</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/feather-icons"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9fafb;
    color: #374151;
}

.btn-primary {
    background-color: #3b82f6;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background-color: #2563eb;
}

.service-card {
    background-color: white;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 6px 12px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.12);
}

.section-title {
    color: #1f2937;
    font-weight: 700;
    margin-bottom: 1.5rem;
    font-size: 1.875rem;
}

.subheading {
    font-weight: 600;
    color: #1e40af;
    margin-top: 1rem;
}

.subtext {
    color: #4b5563;
    margin-left: 1.25rem;
    margin-bottom: 0.5rem;
}

.divider {
    height: 1px;
    background-color: #e5e7eb;
    margin: 1.5rem 0;
}
</style>
</head>
<body>

<!-- Navigation -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <i data-feather="heart" class="text-[#3b82f6] h-8 w-8"></i>
                <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
            </div>
            <div class="flex items-center space-x-8">
                <a href="{{ route('user.introduction') }}" class="border-[#3b82f6] text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                <a href="{{ route('user.service') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Services</a>
                <a href="#contact" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <a href="{{ route('user.booking') }}" class="btn-primary text-white px-4 py-2 rounded-md text-sm font-medium">
                    Book an Appointment
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-[#3b82f6] to-indigo-500 text-white py-20 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Our Services</h1>
    <p class="text-lg md:text-xl max-w-2xl mx-auto">Comprehensive healthcare services for all ages. Explore our services and book your appointment easily online.</p>
</section>

<!-- Services Section -->
<section id="services" class="max-w-6xl mx-auto px-6 py-16 space-y-16">

    <!-- All Consultation -->
    <div class="service-card">
        <h2 class="section-title">All Consultation</h2>
        
        <div class="divider"></div>
        <h3 class="subheading">General Consultation</h3>
        <p class="subtext">For check-ups, minor illnesses, and medical advice</p>

        <div class="divider"></div>
        <h3 class="subheading">Chronic Disease Management</h3>
        <p class="subtext">Ongoing care for diabetes, hypertension, asthma, etc.</p>

        <div class="divider"></div>
        <h3 class="subheading">Pediatric Consultation</h3>
        <p class="subtext">For children’s growth, development, and common illnesses</p>

        <div class="divider"></div>
        <h3 class="subheading">Women’s Health Consultation</h3>
        <p class="subtext">Gynecology, fertility, and reproductive health</p>

        <div class="divider"></div>
        <h3 class="subheading">Men’s Health Consultation</h3>
        <p class="subtext">Urology, sexual health, and wellness</p>

        <div class="divider"></div>
        <h3 class="subheading">Mental Health & Wellness</h3>
        <p class="subtext">Stress management, therapy sessions, and lifestyle advice</p>

        <div class="divider"></div>
        <h3 class="subheading">Travel & Fit-to-Work Medicals</h3>
        <p class="subtext">Medical clearance, fit-to-fly, occupational health checks</p>

        <a href="{{ route('user.information') }}" class="btn-primary px-6 py-3 rounded-lg text-white font-semibold inline-block text-center mt-6">Book Now</a>
    </div>

    <!-- Child Health -->
    <div class="service-card">
        <h2 class="section-title">Child Health</h2>
        <p class="subtext mb-4">Keep your child healthy with same-day pediatric consultations in Brunei</p>
        
        <div class="divider"></div>
        <h3 class="subheading">Essential Child Health Services</h3>
        <ul class="list-disc list-inside subtext">
            <li>Growth & Development Check-ups</li>
            <li>Common Illnesses (fever, cough, flu, allergies)</li>
            <li>Nutrition & Feeding Advice</li>
            <li>School Medicals & Health Certificates</li>
            <li>Asthma & Allergy Management</li>
        </ul>

        <div class="divider"></div>
        <h4 class="subheading">Leaves decisions to the doctor</h4>
        <p class="subtext">Simply book your appointment. Your doctor will handle the rest, reviewing your child's records to make sure they get the care and vaccinations they need.</p>

        <div class="divider"></div>
        <h4 class="subheading">Skip long waits for appointments</h4>
        <p class="subtext">Book appointments at our private clinic with ease. The app lets you schedule next-day consultations, so you can get the care you need without a long wait.</p>

        <a href="{{ route('user.information') }}" class="btn-primary px-6 py-3 rounded-lg text-white font-semibold inline-block text-center mt-6">Book Now</a>
    </div>

    <!-- All Health Screening -->
    <div class="service-card">
        <h2 class="section-title">All Health Screening</h2>

        <div class="divider"></div>
        <h3 class="subheading">Basic Health Check</h3>
        <p class="subtext">General physical exam, blood pressure, BMI, urine test, and blood work</p>

        <div class="divider"></div>
        <h3 class="subheading">Pre-employment Medicals</h3>
        <p class="subtext">Comprehensive tests and medical certificates for job requirements</p>

        <div class="divider"></div>
        <h3 class="subheading">Executive / Comprehensive Health Check</h3>
        <p class="subtext">Full body check-up including blood tests, liver & kidney function, cholesterol, and ECG</p>

        <div class="divider"></div>
        <h3 class="subheading">Senior Health Screening</h3>
        <p class="subtext">Focused on elderly health: osteoporosis, memory, mobility, and heart health</p>

        <div class="divider"></div>
        <h3 class="subheading">Heart & Fitness Screening</h3>
        <p class="subtext">Includes ECG, stress test, cholesterol, and fitness assessment</p>

        <a href="{{ route('user.information') }}" class="btn-primary px-6 py-3 rounded-lg text-white font-semibold inline-block text-center mt-6">Book Now</a>
    </div>

</section>

<!-- Footer -->
<footer id="contact" class="bg-gray-800 mt-16 text-gray-300">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-sm font-semibold uppercase mb-4">Clinic</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('user.introduction') }}" class="hover:text-white">About Us</a></li>
                    <li><a href="#" class="hover:text-white">Careers</a></li>
                    <li><a href="#" class="hover:text-white">News</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase mb-4">Services</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('user.information') }}" class="hover:text-white">Doctor Consultation</a></li>
                    <li><a href="{{ route('user.information') }}" class="hover:text-white">Child Health Consultation</a></li>
                    <li><a href="{{ route('user.information') }}" class="hover:text-white">Health Screening</a></li>
                </ul>
            </div>
            <div></div>
            <div>
                <h3 class="text-sm font-semibold uppercase mb-4">Contact</h3>
                <ul class="space-y-2">
                    <li>Lot 17, Building Haji Abdul Kasim, Bandar Seri Begawan</li>
                    <li>Phone: 227 7777</li>
                    <li>Email: inquiry@clinicflow.bn</li>
                </ul>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-8 flex flex-col md:flex-row md:justify-between items-center">
            <p class="text-gray-400">&copy; 2025 Clinic Flow. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>feather.replace();</script>
</body>
</html>