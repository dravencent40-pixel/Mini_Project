<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use App\Models\ClassModel; // Sesuaikan jika nama model kelasmu Classes
use App\Models\Student;

class Report extends Component
{
    public $class_id = '';
    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->start_date = date('Y-m-01');
        $this->end_date = date('Y-m-d');
    }

    public function render()
    {
        $classes = ClassModel::all();

        $reports = [];
        if ($this->class_id) {
            $startDate = $this->start_date;
            $endDate = $this->end_date;

            $reports = Student::where('class_id', $this->class_id)
            ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }])
            ->get()
            ->map(function ($student) {
                $hadir = $student->attendances->where('status', 'hadir')->count();
                $sakit = $student->attendances->where('status', 'sakit')->count();
                $izin  = $student->attendances->where('status', 'izin')->count();
                $alpa  = $student->attendances->where('status', 'alpa')->count();

                $totalDays = $hadir + $sakit + $izin + $alpa;

                // Hitung persentase (Hadir / Total Hari) * 100
                $percentage = $totalDays > 0 ? round(($hadir / $totalDays) * 100, 1) : 0;

                return [
                    'nisn'       => $student->nisn,
                    'name'       => $student->name,
                    'hadir'      => $hadir,
                    'sakit'      => $sakit,
                    'izin'       => $izin,
                    'alpa'       => $alpa,
                    'percentage' => $percentage,
                ];
            });
        }

        return view('livewire.attendance.report', [
            'classes' => $classes,
            'reports' => $reports,
        ]);
    }
}