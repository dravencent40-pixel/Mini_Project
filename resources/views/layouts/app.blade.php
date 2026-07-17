<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sistem Absensi Siswa' }}</title>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 antialiased transition-colors duration-200">
    <!-- NAVBAR BIRU -->
    <nav class="bg-indigo-900 text-white px-6 py-4 flex items-center justify-between shadow-md">
        <!-- Brand & Links Navigasi -->
        <div class="flex items-center space-x-8">
            <a href="{{ route('dashboard') }}" class="font-bold text-xl tracking-wide">
                Absensi Siswa
            </a>

            <div class="flex space-x-6 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-white border-b-2 border-white' : 'text-indigo-200 hover:text-white' }} pb-1 transition">
                    Dashboard
                </a>

                <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'text-white border-b-2 border-white' : 'text-indigo-200 hover:text-white' }} pb-1 transition">
                    Data Siswa
                </a>

                <!-- Route Input Absensi (Sesuaikan jika nama routemu 'attendances.input') -->
                <a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.index') ? 'text-white border-b-2 border-white' : 'text-indigo-200 hover:text-white' }} pb-1 transition">
                    Input Absensi
                </a>

                <a href="{{ route('attendances.report') }}" class="{{ request()->routeIs('attendance.report') ? 'text-white border-b-2 border-white' : 'text-indigo-200 hover:text-white' }} pb-1 transition">
                    Laporan Absensi
                </a>
            </div>
        </div>

        <!-- User Info & Logout Button -->
        <div class="flex items-center space-x-4">
            <span class="bg-indigo-800 text-indigo-100 text-xs font-semibold px-3 py-1.5 rounded-full">
                {{ auth()->user()->name ?? 'Administrator' }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 rounded-md transition">
                    Logout
                </button>
            </form>
        </div>

        <div x-data="{
            darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
            toggle() {
                this.darkMode = !this.darkMode;
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }
         }">
        <button @click="toggle()"
                type="button"
                class="p-2 rounded-lg text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition">

            <!-- Icon Matahari (Tampil saat mode Dark) -->
            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>

            <!-- Icon Bulan (Tampil saat mode Light) -->
            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </button>
    </div>
    </nav>

    <!-- KONTEN UTAMA HALAMAN -->
    <main>
        {{ $slot }}
    </main>

</body>
</html>