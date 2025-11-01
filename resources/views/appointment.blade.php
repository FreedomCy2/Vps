<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-5xl bg-white shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-2xl font-semibold mb-4 text-center">Manage Appointments</h2>

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
                <th class="border p-2">Action</th>
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
                    @if ($a->status === 'pending')
                        <form action="{{ route('appointments.updateStatus', $a->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Accept</button>
                        </form>
                        <form action="{{ route('appointments.updateStatus', $a->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="declined">
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Decline</button>
                        </form>
                    @else
                        <span class="text-gray-500">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
