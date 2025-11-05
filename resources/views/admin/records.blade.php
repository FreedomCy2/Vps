@extends('admin.layout')

@section('title','Record Management')
@section('header','Record Management')

@section('content')
    {{-- Record content (filters, stats, table) --}}
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">All Records</h3>
            <div class="flex items-center space-x-2">
                <button id="addRecordBtn" class="bg-[#68D6EC] text-white px-4 py-2 rounded">Add Record</button>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Record Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody id="record-rows" class="bg-white divide-y divide-gray-200">
                    @forelse($records as $record)
                        <tr data-id="{{ $record->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->user_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->created_by }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="edit-record text-[#68D6EC] mr-3" data-id="{{ $record->id }}">Edit</button>
                                <button class="delete-record text-red-600" data-id="{{ $record->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal and AJAX scripts for Records CRUD -->
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalHtml = `
        <div id="recordModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
            <div class="bg-white rounded-lg w-2/3 max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold">Add Record</h3>
                    <button id="closeRecordModal" class="text-gray-500 hover:text-gray-700"><i data-feather="x"></i></button>
                </div>
                <form id="recordForm">
                    <input type="hidden" id="record_id" />
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Record Title</label>
                            <input id="record_name" name="record_name" type="text" placeholder="Record title" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <input id="record_type" name="record_type" type="text" placeholder="Record type" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="record_description" name="record_description" placeholder="Description" class="w-full rounded-lg border border-gray-300 px-3 py-2"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Extra Data (email)</label>
                            <input id="record_email" name="record_email" type="email" placeholder="Email (optional)" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Extra Data (phone)</label>
                            <input id="record_phone" name="record_phone" type="text" placeholder="Phone (optional)" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-3">
                        <button type="button" id="cancelRecord" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700">Cancel</button>
                        <button type="submit" id="saveRecord" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        feather && feather.replace();

        const modal = document.getElementById('recordModal');
        const addBtn = document.getElementById('addRecordBtn');
        const closeBtn = document.getElementById('closeRecordModal');
        const cancelBtn = document.getElementById('cancelRecord');
        const form = document.getElementById('recordForm');

        function openModal(title = 'Add Record'){
            document.getElementById('modalTitle').textContent = title;
            modal.style.display = 'flex';
        }
        function closeModal(){ 
            modal.style.display = 'none'; 
            form.reset(); 
            const rid = document.getElementById('record_id'); if(rid) rid.value = ''; 
        }

        addBtn && addBtn.addEventListener('click', () => openModal('Add Record'));
        closeBtn && closeBtn.addEventListener('click', closeModal);
        cancelBtn && cancelBtn.addEventListener('click', closeModal);
        window.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

        // Attach edit listeners
        function attachEditListeners(){
            document.querySelectorAll('.edit-record').forEach(btn => {
                // remove previous handler if any
                if (btn._editHandler) btn.removeEventListener('click', btn._editHandler);
                btn._editHandler = async function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    try {
                        const res = await fetch(`/admin/records/${id}`, { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) throw res;
                        const json = await res.json();
                        const d = json.data || {};
                        document.getElementById('record_id').value = d.id || '';
                        document.getElementById('record_name').value = d.title || d.record_name || '';
                        document.getElementById('record_type').value = d.record_type || '';
                        document.getElementById('record_description').value = d.description || '';
                        // data may be stored in d.data (object) or fields
                        const data = d.data || {};
                        document.getElementById('record_email').value = data.email || d.email || '';
                        document.getElementById('record_phone').value = data.phone || d.phone || '';
                        openModal('Edit Record');
                    } catch(e){ alert('Failed to load record'); }
                };
                btn.addEventListener('click', btn._editHandler);
            });
        }

        // Attach delete listeners
        function attachDeleteListeners(){
            document.querySelectorAll('.delete-record').forEach(btn => {
                if (btn._delHandler) btn.removeEventListener('click', btn._delHandler);
                btn._delHandler = function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    if (!confirm('Are you sure you want to delete this record?')) return;
                    fetch(`/admin/records/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' } })
                    .then(async res => { if (!res.ok) throw res; return res.json(); })
                    .then(json => { const row = document.querySelector(`tr[data-id="${id}"]`); row && row.remove(); alert(json.message || 'Deleted'); })
                    .catch(async err => { let msg = 'Failed to delete'; try { const j = await err.json(); msg = j.message || msg; } catch(e){} alert(msg); });
                };
                btn.addEventListener('click', btn._delHandler);
            });
        }

        // initial attach
        attachEditListeners();
        attachDeleteListeners();

        // Submit form (create/update)
        form.addEventListener('submit', function(e){
            e.preventDefault();
            const id = document.getElementById('record_id').value;
            const title = document.getElementById('record_name').value;
            const record_type = document.getElementById('record_type').value;
            const description = document.getElementById('record_description').value;
            const email = document.getElementById('record_email').value;
            const phone = document.getElementById('record_phone').value;

            const payload = {
                title: title,
                record_type: record_type,
                description: description,
                data: { email: email || null, phone: phone || null }
            };

            const url = id ? `/admin/records/${id}` : '/admin/records';
            const method = id ? 'PUT' : 'POST';
            fetch(url, { method: method, headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' }, body: JSON.stringify(payload) })
            .then(async res => { 
                if (res.status === 422) { const j = await res.json(); alert(Object.values(j.errors || {}).flat().join('\n') || j.message); throw new Error('validation'); } 
                if (!res.ok) throw res; 
                return res.json(); 
            })
            .then(json => { alert(json.message || 'Saved'); location.reload(); })
            .catch(async err => { let msg = 'Failed to save'; try { const j = await err.json(); msg = j.message || msg; } catch(e){} if (msg !== 'validation') alert(msg); });
        });
    });
    </script>
    @endpush

@endsection
