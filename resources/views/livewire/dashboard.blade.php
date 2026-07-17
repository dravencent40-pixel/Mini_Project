<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header / Banner Selamat Datang -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg mb-8">
        <h1 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
        <p class="mt-1 text-blue-100 text-sm">Berikut adalah ringkasan absensi siswa pada hari ini ({{ date('d M Y') }}).</p>
    </div>

    <!-- Ringkasan Statistik (Stats Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Siswa -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Siswa</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-2">{{ $totalStudents }}</h3>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>

        <!-- Hadir Hari Ini -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Hadir Hari Ini</p>
                <h3 class="text-3xl font-extrabold text-green-600 mt-2">{{ $todayPresent }}</h3>
            </div>
            <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Sakit / Izin -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Sakit / Izin</p>
                <h3 class="text-3xl font-extrabold text-amber-500 mt-2">{{ $todaySickPermission }}</h3>
            </div>
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Alpa / Tanpa Keterangan -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Alpa (Tanpa Ket.)</p>
                <h3 class="text-3xl font-extrabold text-rose-600 mt-2">{{ $todayAbsent }}</h3>
            </div>
            <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Akses Cepat (Quick Actions) -->
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="flex flex-wrap gap-3">
            <!-- Tombol Input Absensi -->
            <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Input Absensi Hari Ini
            </a>

            <!-- Tombol Kelola Data Siswa -->
            <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Kelola Data Siswa
            </a>

            <!-- Tombol Laporan Absensi -->
            <a href="{{ route('attendances.report') }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Lihat Laporan Absensi
            </a>
        </div>
    </div>
</div>