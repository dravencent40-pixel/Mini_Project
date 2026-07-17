<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Page -->
    <div class="mb-6 print:hidden flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Rekapitulasi Absensi Siswa</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Pilih kelas dan rentang tanggal untuk melihat atau mencetak rekap presensi.</p>
        </div>

        @if(count($reports) > 0)
            <button onclick="window.print()" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-4 py-2 rounded-lg text-sm shadow-sm transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak / Export PDF
            </button>
        @endif
    </div>

    <!-- Filter Bar -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm mb-6 grid grid-cols-1 md:grid-cols-3 gap-4 print:hidden">
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1">Pilih Kelas</label>
            <select wire:model.live="class_id" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="">-- Pilih Kelas --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1">Dari Tanggal</label>
            <input wire:model.live="start_date" type="date" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1">Sampai Tanggal</label>
            <input wire:model.live="end_date" type="date" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
    </div>

    <!-- Area Tabel Laporan -->
    @if(count($reports) > 0)
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm print:shadow-none print:border-none print:p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700 print:bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold text-gray-600 dark:text-gray-200 border dark:border-gray-600">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-200 border dark:border-gray-600">NISN</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-200 border dark:border-gray-600">Nama Siswa</th>
                            <th class="px-4 py-3 text-center font-semibold text-emerald-600 dark:text-emerald-400 border dark:border-gray-600">Hadir</th>
                            <th class="px-4 py-3 text-center font-semibold text-amber-600 dark:text-amber-400 border dark:border-gray-600">Sakit</th>
                            <th class="px-4 py-3 text-center font-semibold text-blue-600 dark:text-blue-400 border dark:border-gray-600">Izin</th>
                            <th class="px-4 py-3 text-center font-semibold text-rose-600 dark:text-rose-400 border dark:border-gray-600">Alpa</th>
                            <th class="px-4 py-3 text-center font-semibold text-indigo-600 dark:text-indigo-400 border dark:border-gray-600">% Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($reports as $index => $row)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-4 py-3 text-center border dark:border-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-mono text-gray-600 dark:text-gray-400 border dark:border-gray-700">{{ $row['nisn'] }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white border dark:border-gray-700">{{ $row['name'] }}</td>
                                <td class="px-4 py-3 text-center border dark:border-gray-700 font-semibold text-emerald-600 dark:text-emerald-400">{{ $row['hadir'] }}</td>
                                <td class="px-4 py-3 text-center border dark:border-gray-700 font-semibold text-amber-600 dark:text-amber-400">{{ $row['sakit'] }}</td>
                                <td class="px-4 py-3 text-center border dark:border-gray-700 font-semibold text-blue-600 dark:text-blue-400">{{ $row['izin'] }}</td>
                                <td class="px-4 py-3 text-center border dark:border-gray-700 font-semibold text-rose-600 dark:text-rose-400">{{ $row['alpa'] }}</td>
                                <td class="px-4 py-3 text-center border dark:border-gray-700 font-bold text-indigo-600 dark:text-indigo-400">{{ $row['percentage'] ?? 0 }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif($class_id)
        <div class="bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800 text-amber-800 dark:text-amber-300 p-4 rounded-lg text-sm text-center">
            Tidak ada data presensi siswa untuk kelas dan periode tanggal ini.
        </div>
    @else
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-300 p-4 rounded-lg text-sm text-center">
            Silakan pilih kelas terlebih dahulu untuk melihat rekapitulasi absensi.
        </div>
    @endif
</div>