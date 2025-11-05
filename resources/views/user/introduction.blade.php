<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#10b981',
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        html { scroll-behavior: smooth; }
        .welcome-bg {
            background-image: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)),
                              url('http://nep.test/images/clinicflow.png');
            background-size: cover;
            background-position: center;
        }
        .btn-primary { transition: all 0.3s ease; }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i data-feather="heart" class="text-primary h-8 w-8"></i>
                        <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="#home" class="border-primary text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                    <a href="#services" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Services</a>
                    <a href="#about" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">About Us</a>
                    <a href="#contact" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="{{ route('user.booking') }}" class="bg-primary hover:bg-primary-600 text-white px-4 py-2 rounded-md text-sm font-medium btn-primary">
                        Book an Appointment
                    </a>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
                        <span class="sr-only">Open main menu</span>
                        <i data-feather="menu"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <div id="home" class="welcome-bg">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Welcome to Clinic Flow</span>
                    <span class="block text-primary">Book your appointment in just a few taps</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Hope Clinic Flow is a trusted community clinic providing quality healthcare for families. Our team of experienced doctors and nurses are dedicated to offering personalized care in a warm and friendly environment
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="{{ route('user.booking') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-600 md:py-4 md:text-lg md:px-10 btn-primary">
                         Book an Appointment
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="{{ route('user.service') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                            Our Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Services</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Comprehensive Healthcare Solutions
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Book same-day appointments at ClinicFlow, know what you’ll pay before you go.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="activity"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Book a Doctor Consultation</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Consult with a specialist for check-ups, treatment, and prescriptions.
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="heart"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Book a Child Health Consultation</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Schedule pediatric consultations for growth monitoring, general health, or common illnesses
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="eye"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Book a Health Screening</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            General health checks, chronic disease screening, or pre-employment medical available
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <style>
        .AboutUs-bg {
            background-image: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)),
                              url('https://www.mua.edu/uploads/sites/10/2023/02/istock-482499394.webp');
            background-size: cover;
            background-position: center;
        }
    </style>
    <div id="about" class="AboutUs-bg">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    <h2 class="text-base text-primary font-semibold tracking-wide uppercase">About Us</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Book your appointment now
                    </p>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Welcome to our private clinic, designed to provide you with quick and reliable healthcare without the hassle of waiting. With our easy appointment booking system, you can schedule your visit at your preferred time and be seen promptly.<br><br>
                    Our clinic is proud to be home to top-tier doctors who have graduated from leading universities and medical schools. With years of experience and a strong commitment to patient care, our doctors ensure you receive the highest standard of medical treatment in a professional and friendly environment.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div id="contact" class="bg-primary">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to take control of your health?</span>
                <span class="block text-primary-200">Book your appointment today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
</a>

                    <a href="{{ route('user.booking') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50">
                        Book an Appointment
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#contact" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Clinic</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#about" class="text-base text-gray-300 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">News</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Services</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#services" class="text-base text-gray-300 hover:text-white">Book a Doctor Consultation</a></li>
                        <li><a href="#services" class="text-base text-gray-300 hover:text-white">Book a Child Health Consultation</a></li>
                        <li><a href="#services" class="text-base text-gray-300 hover:text-white">Book a Health Screening</a></li>
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
    <script>feather.replace();</script>
</body>
</html>
