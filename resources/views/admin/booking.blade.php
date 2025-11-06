@extends('admin.layout')

@section('title','Booking Management')
@section('header','Booking Management')

@section('content')
    {{-- Booking content (filters, stats, table) --}}
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">All Bookings</h3>
            <div class="flex justify-between items-center mb-4">
                <button id="addBookingBtn" class="bg-[#68D6EC] text-white px-4 py-2 rounded">Add Booking</button>
            </div>
        </div>

        {{-- Table (static examples) --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Symptoms</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="booking-rows" class="bg-white divide-y divide-gray-200">
                    @forelse($user_bookings as $user_booking)
                        <tr data-id="{{ $user_booking->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user_booking->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user_booking->gender }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user_booking->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user_booking->age }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user_booking->service }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user_booking->symptom }}</td>

                            {{-- ✅ FIXED DATE PARSING --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!empty($user_booking->date))
                                    {{ \Carbon\Carbon::parse($user_booking->date)->format('d M, Y') }}
                                @else
                                    <span class="text-gray-400">No date</span>
                                @endif
                            </td>

                            {{-- ✅ FIXED TIME PARSING --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!empty($user_booking->time))
                                    @php
                                        try {
                                            $time = \Carbon\Carbon::createFromFormat('H:i:s', $user_booking->time)->format('h:i A');
                                        } catch (\Exception $e) {
                                            $time = $user_booking->time; // fallback if format invalid
                                        }
                                    @endphp
                                    {{ $time }}
                                @else
                                    <span class="text-gray-400">No time</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button data-id="{{ $user_booking->id }}" class="text-[#68D6EC] mr-3 edit-booking">Edit</button>
                                <button data-id="{{ $user_booking->id }}" class="text-red-600 delete-booking">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">No bookings found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal and scripts for AJAX CRUD -->
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get CSRF token from multiple possible sources
        function getCsrfToken() {
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            if (metaTag) return metaTag.getAttribute('content');
            const inputField = document.querySelector('input[name="_token"]');
            if (inputField) return inputField.value;
            if (typeof window.Laravel !== 'undefined' && window.Laravel.csrfToken) {
                return window.Laravel.csrfToken;
            }
            console.error('CSRF token not found');
            return null;
        }

        const csrfToken = getCsrfToken();

        const modalHtml = `
        <div id="bookingModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
            <div class="bg-white rounded-lg w-2/3 max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold">Add New Booking</h3>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700"><i data-feather="x"></i></button>
                </div>
                <form id="bookingForm">
                    <input type="hidden" id="booking_id" />
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Patient Name</label>
                            <input id="name" name="name" type="text" placeholder="Patient name" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input id="email" name="email" type="email" placeholder="Email" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                                <input id="age" name="age" type="number" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                <select id="gender" name="gender" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                                <select id="service" name="service" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                                    <option value="">-- Select Service --</option>
                                    <option value="General Consultation">General Consultation</option>
                                    <option value="Dental">Dental</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Physiotherapy">Physiotherapy</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Symptoms</label>
                            <textarea id="symptom" name="symptom" maxlength="500" oninput="if(this.value.length>500) this.value=this.value.slice(0,500);" class="w-full rounded-lg border border-gray-300 px-3 py-2" rows="3" style="resize:vertical; height:120px; max-height:200px; box-sizing:border-box; overflow:auto;"></textarea>
                            <p id="symptomCount" class="text-xs text-gray-400 mt-1">0 / 500</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input id="date" name="date" type="date" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                <input id="time" name="time" type="time" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-3">
                        <button type="button" id="cancelBooking" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700">Cancel</button>
                        <button type="submit" id="saveBooking" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg">Save Booking</button>
                    </div>
                </form>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        feather && feather.replace();
        // ... (rest of your JS remains unchanged)
    });
    </script>
    @endpush
@endsection