<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Appointments</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function openEditModal(id, date, time, reason) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editId').value = id;
            document.getElementById('editDate').value = date;
            document.getElementById('editTime').value = time;
            document.getElementById('editReason').value = reason;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center">

    <div class="w-full max-w-6xl bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-semibold mb-4 text-center">Admin - Manage Appointments</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Patient</th>
                    <th class="border p-2">Date</th>
                    <th class="border p-2">Time</th>
                    <th class="border p-2">Reason</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $a)
                <tr>
                    <td class="border p-2 text-center">{{ $a->id }}</td>
                    <td class="border p-2 text-center">{{ $a->patient->name ?? 'N/A' }}</td>
                    <td class="border p-2 text-center">{{ $a->date }}</td>
                    <td class="border p-2 text-center">{{ $a->time }}</td>
                    <td class="border p-2">{{ $a->reason }}</td>
                    <td class="border p-2 text-center capitalize">{{ $a->status }}</td>
                    <td class="border p-2 text-center">
                        <button 
                            onclick="openEditModal('{{ $a->id }}', '{{ $a->date }}', '{{ $a->time }}', '{{ $a->reason }}')"
                            class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</button>

                        <form action="{{ route('appointments.destroy', $a->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                onclick="return confirm('Are you sure you want to delete this appointment?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-xl font-semibold mb-4 text-center">Edit Appointment</h3>
            <form id="editForm" method="POST" action="{{ route('appointments.update', 0) }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">

                <div class="mb-3">
                    <label class="block mb-1 font-semibold">Date</label>
                    <input type="date" id="editDate" name="date" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label class="block mb-1 font-semibold">Time</label>
                    <input type="time" id="editTime" name="time" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label class="block mb-1 font-semibold">Reason</label>
                    <textarea id="editReason" name="reason" rows="3" class="w-full border rounded p-2" required></textarea>
                </div>

                <div class="flex justify-between mt-4">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-3 py-1 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dynamically update form action URL before submitting
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const id = document.getElementById('editId').value;
            this.action = '/appointments/' + id;
        });
    </script>

</body>
</html>
