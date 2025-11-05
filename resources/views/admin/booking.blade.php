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
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($user_booking->date)->format('d M, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::createFromFormat('H:i:s', $user_booking->time)->format('h:i A') }}</td>
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
                // Try meta tag first
                const metaTag = document.querySelector('meta[name="csrf-token"]');
                if (metaTag) return metaTag.getAttribute('content');
                
                // Try hidden input field
                const inputField = document.querySelector('input[name="_token"]');
                if (inputField) return inputField.value;
                
                // Try Laravel's global variable
                if (typeof window.Laravel !== 'undefined' && window.Laravel.csrfToken) {
                    return window.Laravel.csrfToken;
                }
                
                console.error('CSRF token not found');
                return null;
            }

            const csrfToken = getCsrfToken();
            
            // Create modal HTML
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
            
            // update symptom counter
            document.addEventListener('input', function(e){
                if (e.target && e.target.id === 'symptom') {
                    const el = e.target;
                    const countEl = document.getElementById('symptomCount');
                    if (countEl) countEl.textContent = `${el.value.length} / ${el.getAttribute('maxlength') || '∞'}`;
                    // enforce a strict cap on visual size so user can't drag it arbitrarily large
                    el.style.maxHeight = '200px';
                    // optionally adjust current height to fit content but never exceed 200px
                    el.style.height = Math.min(el.scrollHeight, 200) + 'px';
                }
            });
            
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            feather && feather.replace();

            const modal = document.getElementById('bookingModal');
            const addBtn = document.getElementById('addBookingBtn');
            const closeBtn = document.getElementById('closeModal');
            const cancelBtn = document.getElementById('cancelBooking');
            const form = document.getElementById('bookingForm');

            function openModal(title = 'Add New Booking'){
                document.getElementById('modalTitle').textContent = title;
                modal.style.display = 'flex';
            }
            function closeModal(){ modal.style.display = 'none'; form.reset(); document.getElementById('booking_id').value = ''; }

            addBtn && addBtn.addEventListener('click', () => openModal('Add New Booking'));
            closeBtn && closeBtn.addEventListener('click', closeModal);
            cancelBtn && cancelBtn.addEventListener('click', closeModal);
            window.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

            // Attach edit listeners
            function attachEditListeners(){
                document.querySelectorAll('.edit-booking').forEach(btn => {
                    btn.removeEventListener('click', btn._editHandler);
                    btn._editHandler = async function(){
                        const id = this.dataset.id;
                        if (!id) return alert('Missing id');
                        try {
                            const res = await fetch(`/admin/bookings/${id}`, { headers: { 'Accept': 'application/json' } });
                            if (!res.ok) throw res;
                            const json = await res.json();
                            const b = json.data;
                            document.getElementById('booking_id').value = b.id;
                            document.getElementById('name').value = b.name || '';
                            document.getElementById('email').value = b.email || '';
                            document.getElementById('phone').value = b.phone || '';
                            document.getElementById('age').value = b.age || '';
                            document.getElementById('gender').value = b.gender || '';
                            document.getElementById('service').value = b.service || '';
                            document.getElementById('symptom').value = b.symptom || '';
                            if (b.date) document.getElementById('date').value = (new Date(b.date)).toISOString().slice(0,10);
                            if (b.time) {
                                // b.time can be "HH:MM:SS" or "HH:MM"
                                const t = b.time.slice(0,5);
                                document.getElementById('time').value = t;
                            }
                             openModal('Edit Booking');
                        } catch(e){ alert('Failed to load booking'); }
                    };
                    btn.addEventListener('click', btn._editHandler);
                });
            }

            // Attach delete listeners
            function attachDeleteListeners(){
                document.querySelectorAll('.delete-booking').forEach(btn => {
                    btn.removeEventListener('click', btn._delHandler);
                    btn._delHandler = function(){
                        const id = this.dataset.id;
                        if (!id) return alert('Missing id');
                        if (!csrfToken) {
                            alert('CSRF token not found. Please refresh the page.');
                            return;
                        }
                        if (!confirm('Are you sure you want to delete this booking?')) return;
                        fetch(`/admin/bookings/${id}`, { 
                            method: 'DELETE', 
                            headers: { 
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json' 
                            } 
                        })
                        .then(async res => { if (!res.ok) throw res; return res.json(); })
                        .then(json => { 
                            const row = document.querySelector(`tr[data-id="${id}"]`); 
                            row && row.remove(); 
                            alert(json.message || 'Deleted'); 
                        })
                        .catch(async err => { 
                            let msg = 'Failed to delete'; 
                            try { 
                                const j = await err.json(); 
                                msg = j.message || msg; 
                            } catch(e){} 
                            alert(msg); 
                        });
                    };
                    btn.addEventListener('click', btn._delHandler);
                });
            }

            attachEditListeners();
            attachDeleteListeners();

            // Submit form (create/update)
            form.addEventListener('submit', function(e){
                e.preventDefault();
                if (!csrfToken) {
                    alert('CSRF token not found. Please refresh the page.');
                    return;
                }
                const id = document.getElementById('booking_id').value;
                const payload = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    age: document.getElementById('age').value,
                    gender: document.getElementById('gender').value,
                    service: document.getElementById('service').value,
                    symptom: document.getElementById('symptom').value,
                    date: document.getElementById('date').value,
                    time: document.getElementById('time').value,
                };
                const url = id ? `/admin/bookings/${id}` : '/admin/bookings';
                const method = id ? 'PUT' : 'POST';
                fetch(url, { 
                    method: method, 
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json' 
                    }, 
                    body: JSON.stringify(payload) 
                })
                .then(async res => { 
                    if (res.status === 422) { 
                        const j = await res.json(); 
                        alert(Object.values(j.errors || {}).flat().join('\n') || j.message); 
                        throw new Error('validation'); 
                    } 
                    if (!res.ok) throw res; 
                    return res.json(); 
                })
                .then(json => { alert(json.message || 'Saved'); location.reload(); })
                .catch(async err => { 
                    let msg = 'Failed to save'; 
                    try { 
                        const j = await err.json(); 
                        msg = j.message || msg; 
                    } catch(e){} 
                    if (msg !== 'validation') alert(msg); 
                });
            });

        });
        </script>
        @endpush

@endsection