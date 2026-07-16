<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased">
    @auth
    <nav x-data="{ open: false }" class="bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-8">
                    <span class="font-bold text-lg">Absensi Siswa</span>
                    <a href="/dashboard" class="hover:bg-blue-800 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="/students" class="hover:bg-blue-800 px-3 py-2 rounded-md text-sm font-medium">Data Siswa</a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm bg-blue-800 px-3 py-1 rounded-full">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-md">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="py-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>