<?php

namespace App\Livewire\Student;

use App\Models\ClassModel; // Ubah ke App\Models\Classes jika nama model kelasmu "Classes"
use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Filter & Search
    public $search = '';
    public $selectedClass = '';

    // Properti Form & Modal CRUD
    public $isModalOpen = false;
    public $studentId = null;
    public $nisn = '';
    public $name = '';
    public $class_id = '';
    public $gender = 'L';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedClass()
    {
        $this->resetPage();
    }

    // Buka Modal Tambah Data
    public function create()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    // Buka Modal Edit Data
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->studentId = $student->id;
        $this->nisn = $student->nisn;
        $this->name = $student->name;
        $this->class_id = $student->class_id;
        $this->gender = $student->gender;

        $this->isModalOpen = true;
    }

    // Tutup Modal
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    // Reset Form Input
    private function resetInputFields()
    {
        $this->studentId = null;
        $this->nisn = '';
        $this->name = '';
        $this->class_id = '';
        $this->gender = 'L';
        $this->resetErrorBag();
    }

    // Simpan Data (Create / Update)
    public function store()
    {
        $this->validate([
            'nisn' => 'required|numeric|unique:students,nisn,' . $this->studentId,
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'gender' => 'required|in:L,P',
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nisn.unique' => 'NISN ini sudah terdaftar.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'class_id.required' => 'Pilih kelas terlebih dahulu.',
            'gender.required' => 'Pilih jenis kelamin.',
        ]);

        Student::updateOrCreate(
            ['id' => $this->studentId],
            [
                'nisn' => $this->nisn,
                'name' => $this->name,
                'class_id' => $this->class_id,
                'gender' => $this->gender,
            ]
        );

        session()->flash('message', $this->studentId ? 'Data siswa berhasil diperbarui!' : 'Siswa baru berhasil ditambahkan!');

        $this->closeModal();
    }

    // Hapus Data Siswa
    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        session()->flash('message', 'Data siswa berhasil dihapus!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $students = Student::with('class')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('nisn', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedClass, function ($query) {
                $query->where('class_id', $this->selectedClass);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.student.index', [
            'students' => $students,
            'classes'  => ClassModel::all(), // Ubah ClassModel::all() ke Classes::all() jika nama modelmu Classes
        ]);
    }
}