@extends('admin.layout')

@section('title','Doctors')
@section('header','Doctors')

@section('content')
    <!-- Add CSRF token meta tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Doctors</h3>
            <button id="addDoctorBtn" class="bg-[#68D6EC] text-white px-4 py-2 rounded">Add Doctor</button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody id="doctor-rows" class="bg-white divide-y divide-gray-200">
                    @forelse($doctors as $doctor)
                        <tr data-id="{{ $doctor->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctor->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctor->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctor->created_at ? $doctor->created_at->format('d M, Y') : '' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="edit-doctor text-[#68D6EC] mr-3" data-id="{{ $doctor->id }}">Edit</button>
                                <button class="delete-doctor text-red-600" data-id="{{ $doctor->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No doctors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal and AJAX scripts for Doctors CRUD -->
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure CSRF token is available
        let csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            csrfToken = document.createElement('meta');
            csrfToken.name = 'csrf-token';
            csrfToken.content = '{{ csrf_token() }}';
            document.head.appendChild(csrfToken);
        }

        // Setup AJAX defaults for Laravel
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };

        const modalHtml = `
        <div id="doctorModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
            <div class="bg-white rounded-lg w-2/3 max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold">Add Doctor</h3>
                    <button id="closeDoctorModal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
                <form id="doctorForm">
                    <input type="hidden" id="doctor_id" />
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input id="name" name="name" type="text" placeholder="Full name" class="w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="email" name="email" type="email" placeholder="Email" class="w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input id="password" name="password" type="password" placeholder="Password (leave blank to keep current)" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            <small class="text-gray-500">Minimum 6 characters. Leave blank when editing to keep current password.</small>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-3">
                        <button type="button" id="cancelDoctor" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700">Cancel</button>
                        <button type="submit" id="saveDoctor" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        const modal = document.getElementById('doctorModal');
        const addBtn = document.getElementById('addDoctorBtn');
        const closeBtn = document.getElementById('closeDoctorModal');
        const cancelBtn = document.getElementById('cancelDoctor');
        const form = document.getElementById('doctorForm');

        function getCSRFToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content') || window.Laravel.csrfToken;
        }

        function openModal(title = 'Add Doctor'){
            document.getElementById('modalTitle').textContent = title;
            modal.style.display = 'flex';
        }
        
        function closeModal(){ 
            modal.style.display = 'none'; 
            form.reset(); 
            document.getElementById('doctor_id').value = '';
            const passwordField = document.getElementById('password');
            if (document.getElementById('modalTitle').textContent === 'Add Doctor') {
                passwordField.required = true;
            } else {
                passwordField.required = false;
            }
        }

        addBtn && addBtn.addEventListener('click', () => {
            document.getElementById('password').required = true;
            openModal('Add Doctor');
        });
        closeBtn && closeBtn.addEventListener('click', closeModal);
        cancelBtn && cancelBtn.addEventListener('click', closeModal);
        window.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

        // Attach edit listeners
        function attachEditListeners(){
            document.querySelectorAll('.edit-doctor').forEach(btn => {
                btn.removeEventListener('click', btn._editHandler);
                btn._editHandler = async function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    try {
                        const res = await fetch(`/admin/doctors/${id}`, { 
                            method: 'GET',
                            headers: { 
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': getCSRFToken(),
                                'X-Requested-With': 'XMLHttpRequest'
                            } 
                        });
                        if (!res.ok) throw res;
                        const json = await res.json();
                        const d = json.data || {};
                        document.getElementById('doctor_id').value = d.id || '';
                        document.getElementById('name').value = d.name || '';
                        document.getElementById('email').value = d.email || '';
                        document.getElementById('password').value = '';
                        document.getElementById('password').required = false;
                        openModal('Edit Doctor');
                    } catch(e){ 
                        console.error('Error:', e);
                        alert('Failed to load doctor'); 
                    }
                };
                btn.addEventListener('click', btn._editHandler);
            });
        }

        // Attach delete listeners
        function attachDeleteListeners(){
            document.querySelectorAll('.delete-doctor').forEach(btn => {
                btn.removeEventListener('click', btn._delHandler);
                btn._delHandler = function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    if (!confirm('Are you sure you want to delete this doctor?')) return;
                    
                    fetch(`/admin/doctors/${id}`, { 
                        method: 'DELETE', 
                        headers: { 
                            'X-CSRF-TOKEN': getCSRFToken(),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        } 
                    })
                    .then(async res => { 
                        if (!res.ok) {
                            const errorText = await res.text();
                            console.error('Delete error:', errorText);
                            throw new Error(`HTTP ${res.status}: ${errorText}`);
                        }
                        return res.json(); 
                    })
                    .then(json => { 
                        const row = document.querySelector(`tr[data-id="${id}"]`); 
                        row && row.remove(); 
                        alert(json.message || 'Deleted successfully'); 
                    })
                    .catch(err => { 
                        console.error('Delete failed:', err);
                        alert('Failed to delete: ' + err.message); 
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
            const id = document.getElementById('doctor_id').value;
            const payload = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
            };
            const pw = document.getElementById('password').value;
            if (pw || !id) payload.password = pw;
            
            const url = id ? `/admin/doctors/${id}` : '/admin/doctors';
            const method = id ? 'PUT' : 'POST';
            
            fetch(url, { 
                method: method, 
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': getCSRFToken(),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }, 
                body: JSON.stringify(payload) 
            })
            .then(async res => { 
                if (res.status === 422) { 
                    const j = await res.json(); 
                    alert(Object.values(j.errors || {}).flat().join('\n') || j.message); 
                    throw new Error('validation'); 
                } 
                if (!res.ok) {
                    const errorText = await res.text();
                    console.error('Save error:', errorText);
                    throw new Error(`HTTP ${res.status}: ${errorText}`);
                }
                return res.json(); 
            })
            .then(json => { 
                alert(json.message || 'Saved successfully'); 
                location.reload(); 
            })
            .catch(err => { 
                if (err.message !== 'validation') {
                    console.error('Save failed:', err);
                    alert('Failed to save: ' + err.message); 
                }
            });
        });
    });
    </script>
    @endpush

@endsection