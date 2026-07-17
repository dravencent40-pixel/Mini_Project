<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pencatatan Absensi Siswa</h1>
        <p class="text-sm text-gray-600">Pilih kelas dan tanggal untuk menginput presensi siswa.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Filter Pilih Kelas & Tanggal -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas</label>
            <select wire:model.live="class_id" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="">-- Pilih Kelas --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Absensi</label>
            <input wire:model.live="date" type="date" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
    </div>

    <!-- Form Absensi Massal -->
    @if(count($attendances) > 0)
        <form wire:submit.prevent="save">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">NISN</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Nama Siswa</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Status Kehadiran</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($attendances as $studentId => $data)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-mono text-gray-600">{{ $data['nisn'] }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $data['name'] }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        @foreach(['hadir' => 'Hadir', 'sakit' => 'Sakit', 'izin' => 'Izin', 'alpa' => 'Alpa'] as $key => $label)
                                            <label class="inline-flex items-center text-xs font-medium cursor-pointer">
                                                <input type="radio" wire:model="attendances.{{ $studentId }}.status" value="{{ $key }}" class="text-blue-600 focus:ring-blue-500">
                                                <span class="ml-1.5 text-gray-700">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" wire:model="attendances.{{ $studentId }}.note" placeholder="Keterangan (Opsional)" class="border border-gray-300 rounded px-3 py-1 text-xs w-full focus:outline-none focus:border-blue-500">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mb-8">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-md shadow-sm text-sm">
                    Simpan Absensi
                </button>
            </div>
        </form>
    @elseif($class_id)
        <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-lg text-sm text-center">
            Belum ada data siswa di kelas ini.
        </div>
    @endif
</div>