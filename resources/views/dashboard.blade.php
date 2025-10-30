<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl items-center justify-center p-6">

        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <div class="flex gap-4">
            <!-- Button 1 -->
            <a href="/patients/book"
               class="px-6 py-3 bg-blue-600 text-black font-bold rounded-lg hover:bg-blue-700 transition">
                Appointments
            </a>

            <!-- Button 2 -->
            <a href="/doctors/manage"
               class="px-6 py-3 bg-green-600 text-black font-bold rounded-lg hover:bg-green-700 transition">
                Doc manage
            </a>

            <!-- Button 3 -->
            <a href="/admin/appointments"
               class="px-6 py-3 bg-purple-600 text-black font-bold rounded-lg hover:bg-purple-700 transition">
                Admin appointments
            </a>

            <!-- Button 4 -->
            <a href="/admin/edit"
               class="px-6 py-3 bg-purple-600 text-black font-bold rounded-lg hover:bg-purple-700 transition">
                Admin edit
            </a>
        </div>
    </div>
</x-layouts.app>
