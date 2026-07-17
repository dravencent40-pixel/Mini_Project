<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Student;
use Livewire\Attributes\Layout; // 1. Tambahkan Import Attribute Layout ini
use Livewire\Component;

class Form extends Component
{
    public $class_id = '';
    public $date = '';
    public $attendances = [];

    public function mount()
    {
        $this->date = date('Y-m-d');
    }

    public function updatedClassId()
    {
        $this->loadStudents();
    }

    public function updatedDate()
    {
        $this->loadStudents();
    }

    public function loadStudents()
    {
        if (!$this->class_id) {
            $this->attendances = [];
            return;
        }

        $students = Student::where('class_id', $this->class_id)->get();

        $existingAttendances = Attendance::whereIn('student_id', $students->pluck('id'))
            ->where('date', $this->date)
            ->get()
            ->keyBy('student_id');

        $this->attendances = [];

        foreach ($students as $student) {
            $existing = $existingAttendances->get($student->id);

            $this->attendances[$student->id] = [
                'name' => $student->name,
                'nisn' => $student->nisn,
                'status' => $existing ? $existing->status : 'hadir',
                'note' => $existing ? $existing->note : '',
            ];
        }
    }

    public function save()
    {
        $this->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
            'attendances.*.status' => 'required|in:hadir,sakit,izin,alpa',
            'attendances.*.note' => 'nullable|string|max:255',
        ]);

        foreach ($this->attendances as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $this->date,
                ],
                [
                    'status' => $data['status'],
                    'note' => $data['note'] ?? null,
                ]
            );
        }

        session()->flash('message', 'Data absensi berhasil disimpan!');
    }

    #[Layout('layouts.app')] // 2. Gunakan Attribute ini di atas method render()
    public function render()
    {
        return view('livewire.attendance.form', [
            'classes' => ClassModel::all(),
        ]); // 3. Hapus ->layout('layouts.app') di ujung sini
    }
}