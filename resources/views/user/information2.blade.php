<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Information | Clinic Flow</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/feather-icons"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f3f4f6;
}

input, select, textarea {
    transition: all 0.3s ease;
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
}

.btn-primary {
    background-color: #3b82f6;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background-color: #2563eb;
}

.section-title {
    color: #1f2937;
    font-weight: 600;
}

.feature-icon {
    width: 36px;
    height: 36px;
}

.feature-card {
    display: flex;
    align-items: start;
    gap: 1rem;
    margin-bottom: 2rem;
}
</style>
</head>
<body>

<!-- Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <i data-feather="heart" class="text-[#3b82f6] h-8 w-8"></i>
                <span class="ml-2 text-xl font-bold text-gray-800">Clinic Flow</span>
            </div>
            <div class="flex items-center space-x-8">
                <a href="{{ route('user.introduction') }}" class="border-[#3b82f6] text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                <a href="#contact" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-6 py-16">
    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
        
        <!-- Feature Panel Left -->
        <div class="bg-gradient-to-br from-[#3b82f6] to-indigo-500 text-white p-10 md:w-1/3 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-8">Why Choose Clinic Flow?</h2>
            <div class="feature-card">
                <i data-feather="heart" class="feature-icon"></i>
                <div>
                    <h3 class="font-semibold text-lg">Quality Care</h3>
                    <p class="text-gray-200 mt-1">Compassionate healthcare from experienced professionals</p>
                </div>
            </div>
            <div class="feature-card">
                <i data-feather="shield" class="feature-icon"></i>
                <div>
                    <h3 class="font-semibold text-lg">Safe Environment</h3>
                    <p class="text-gray-200 mt-1">Your health and safety are our top priorities</p>
                </div>
            </div>
            <div class="feature-card">
                <i data-feather="clock" class="feature-icon"></i>
                <div>
                    <h3 class="font-semibold text-lg">Flexible Scheduling</h3>
                    <p class="text-gray-200 mt-1">Book your appointments at a time convenient for you</p>
                </div>
            </div>
        </div>

        <!-- Booking Form Right -->
        <div class="md:w-2/3 p-10">
            <h1 class="text-4xl font-extrabold text-[#3b82f6] mb-6 text-center">Book Your Appointment</h1>
            <p class="text-gray-600 mb-10 text-center">Fill out the form below to schedule your doctor's visit</p>

            <!-- Form to redirect to login -->
            <form action="{{ route('user.login') }}" method="GET" class="space-y-8">
                @csrf

                <!-- Select Service -->
                <div>
                    <label class="block text-gray-700 mb-2">Select Service</label>
                    <select name="service" class="w-full border-gray-300 rounded-lg p-4" required>
                        <option disabled selected>-- Select a Service --</option>
                        <optgroup label="Doctor Consultation">
                            <option value="General Consultation">General Consultation</option>
                            <option value="Chronic Disease Care">Chronic Disease Care</option>
                            <option value="Men’s Health Consultation">Men’s Health Consultation</option>
                            <option value="Women’s Health Consultation">Women’s Health Consultation</option>
                            <option value="Travel & Fit-to-Work Medicals">Travel & Fit-to-Work Medicals</option>
                        </optgroup>
                        <optgroup label="Child Health Consultation">
                            <option value="Pediatric Consultation">Pediatric Consultation</option>
                            <option value="Growth & Development Check-ups">Growth & Development Check-ups</option>
                            <option value="Common Illnesses">Common Illnesses</option>
                            <option value="Nutrition & Feeding Advice">Nutrition & Feeding Advice</option>
                            <option value="School Medicals & Health Certificates">School Medicals & Health Certificates</option>
                        </optgroup>
                        <optgroup label="Health Screening">
                            <option value="Routine Health Check">Routine Health Check</option>
                            <option value="Pre-employment Medicals">Pre-employment Medicals</option>
                            <option value="Executive / Comprehensive Check-up">Executive / Comprehensive Check-up</option>
                            <option value="Senior Health Screening">Senior Health Screening</option>
                            <option value="Heart & Fitness Screening">Heart & Fitness Screening</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Date & Time -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 mb-2">Preferred Date</label>
                        <input type="date" name="date" class="w-full border-gray-300 rounded-lg p-4" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Preferred Time</label>
                        <input type="time" name="time" class="w-full border-gray-300 rounded-lg p-4" required>
                    </div>
                </div>

                <!-- User Info -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" placeholder="Enter your full name" class="w-full border-gray-300 rounded-lg p-4" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" placeholder="Enter your email" class="w-full border-gray-300 rounded-lg p-4" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" placeholder="Enter your phone number" class="w-full border-gray-300 rounded-lg p-4" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Age</label>
                        <input type="number" name="age" min="0" max="120" placeholder="Enter your age" class="w-full border-gray-300 rounded-lg p-4" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-2">Gender</label>
                        <select name="gender" class="w-full border-gray-300 rounded-lg p-4" required>
                            <option disabled selected>-- Select Gender --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Preferred not to say</option>
                        </select>
                    </div>
                </div>

                <!-- Symptom Description -->
                <div>
                    <label class="block text-gray-700 mb-2">Symptom:</label>
                    <textarea name="symptom" rows="4" placeholder="Please describe your symptoms or concerns" class="w-full border-gray-300 rounded-lg p-4"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn-primary px-10 py-4 rounded-xl text-white font-semibold text-lg shadow-lg hover:shadow-xl transition">
                        Confirm Booking
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>

<!-- Footer -->
<footer id="contact" class="bg-gray-800 mt-16">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-gray-300">
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
                    <li><a href="{{ route('user.booking') }}" class="hover:text-white">Doctor Consultation</a></li>
                    <li><a href="{{ route('user.booking') }}" class="hover:text-white">Child Health Consultation</a></li>
                    <li><a href="{{ route('user.booking') }}" class="hover:text-white">Health Screening</a></li>
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
