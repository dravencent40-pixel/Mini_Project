<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100">
    <!-- Card Container -->
    <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-gray-100">

        <!-- Header / Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-2xl shadow-lg mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Sistem Absensi Siswa</h2>
            <p class="text-xs text-gray-500 mt-1">Silakan masuk menggunakan akun admin / guru</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form Login -->
        <form wire:submit="login" class="space-y-5">
            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
                <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                    placeholder="admin@gmail.com"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-xs text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Kata Sandi</label>
                <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">
                <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-xs text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember" class="inline-flex items-center cursor-pointer">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="ml-2 text-xs text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-xl shadow-md transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Masuk ke Sistem
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Absensi Siswa App. All rights reserved.
        </div>
    </div>
</div>