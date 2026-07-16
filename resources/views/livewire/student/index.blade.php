<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Data Siswa</h1>
        <button wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium text-sm">
            + Tambah Siswa
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 rounded-lg shadow mb-6 flex flex-col md:flex-row gap-4">
        <input wire:model.live="search" type="text" placeholder="Cari Nama / NISN..." class="border border-gray-300 rounded-md px-3 py-2 w-full md:w-1/3 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">

        <select wire:model.live="selectedClass" class="border border-gray-300 rounded-md px-3 py-2 w-full md:w-1/4 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            <option value="">-- Semua Kelas --</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Table Data Siswa -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">NISN</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Gender</th>
                    <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($students as $student)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $student->nisn }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $student->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $student->classModel->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="edit({{ $student->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $student->id }})" onclick="confirm('Yakin ingin menghapus?') || event.stopImmediatePropagation()" class="text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data siswa ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $students->links() }}
        </div>
    </div>

    <!-- Modal Form (Create / Edit) -->
    @if($isModalOpen)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-bold mb-4">{{ $studentId ? 'Edit Siswa' : 'Tambah Siswa Baru' }}</h3>

                <form wire:submit.prevent="store" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600">NISN</label>
                        <input wire:model="nisn" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none">
                        @error('nisn') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600">Nama Lengkap</label>
                        <input wire:model="name" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600">Kelas</label>
                        <select wire:model="class_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600">Jenis Kelamin</label>
                        <select wire:model="gender" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-200 rounded text-sm text-gray-700">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>