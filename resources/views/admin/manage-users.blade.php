@extends('admin.layout')

@section('title','Users')
@section('header','Users')

@section('content')
    <!-- Add CSRF token meta tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Users</h3>
            <button id="addUserBtn" class="bg-[#68D6EC] text-white px-4 py-2 rounded">Add User</button>
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

                <tbody id="user-rows" class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr data-id="{{ $user->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at ? $user->created_at->format('d M, Y') : '' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="edit-user text-[#68D6EC] mr-3" data-id="{{ $user->id }}">Edit</button>
                                <button class="delete-user text-red-600" data-id="{{ $user->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal and AJAX scripts for Users CRUD -->
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
        <div id="userModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
            <div class="bg-white rounded-lg w-2/3 max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold">Add User</h3>
                    <button id="closeUserModal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
                <form id="userForm">
                    <input type="hidden" id="user_id" />
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
                        <button type="button" id="cancelUser" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700">Cancel</button>
                        <button type="submit" id="saveUser" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        const modal = document.getElementById('userModal');
        const addBtn = document.getElementById('addUserBtn');
        const closeBtn = document.getElementById('closeUserModal');
        const cancelBtn = document.getElementById('cancelUser');
        const form = document.getElementById('userForm');

        function getCSRFToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content') || window.Laravel.csrfToken;
        }

        function openModal(title = 'Add User'){
            document.getElementById('modalTitle').textContent = title;
            modal.style.display = 'flex';
        }
        
        function closeModal(){ 
            modal.style.display = 'none'; 
            form.reset(); 
            document.getElementById('user_id').value = '';
            const passwordField = document.getElementById('password');
            if (document.getElementById('modalTitle').textContent === 'Add User') {
                passwordField.required = true;
            } else {
                passwordField.required = false;
            }
        }

        addBtn && addBtn.addEventListener('click', () => {
            document.getElementById('password').required = true;
            openModal('Add User');
        });
        closeBtn && closeBtn.addEventListener('click', closeModal);
        cancelBtn && cancelBtn.addEventListener('click', closeModal);
        window.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

        // Attach edit listeners
        function attachEditListeners(){
            document.querySelectorAll('.edit-user').forEach(btn => {
                btn.removeEventListener('click', btn._editHandler);
                btn._editHandler = async function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    try {
                        const res = await fetch(`/admin/users/${id}`, { 
                            method: 'GET',
                            headers: { 
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': getCSRFToken(),
                                'X-Requested-With': 'XMLHttpRequest'
                            } 
                        });
                        if (!res.ok) throw res;
                        const json = await res.json();
                        const u = json.data || {};
                        document.getElementById('user_id').value = u.id || '';
                        document.getElementById('name').value = u.name || '';
                        document.getElementById('email').value = u.email || '';
                        document.getElementById('password').value = '';
                        document.getElementById('password').required = false;
                        openModal('Edit User');
                    } catch(e){ 
                        console.error('Error:', e);
                        alert('Failed to load user'); 
                    }
                };
                btn.addEventListener('click', btn._editHandler);
            });
        }

        // Attach delete listeners
        function attachDeleteListeners(){
            document.querySelectorAll('.delete-user').forEach(btn => {
                btn.removeEventListener('click', btn._delHandler);
                btn._delHandler = function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    if (!confirm('Are you sure you want to delete this user?')) return;
                    
                    fetch(`/admin/users/${id}`, { 
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
            const id = document.getElementById('user_id').value;
            const payload = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
            };
            const pw = document.getElementById('password').value;
            if (pw || !id) payload.password = pw;
            
            const url = id ? `/admin/users/${id}` : '/admin/users';
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