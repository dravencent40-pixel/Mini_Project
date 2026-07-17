<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        $today = date('Y-m-d');

        return view('livewire.dashboard', [
            'totalStudents' => Student::count(),
            'todayPresent'  => Attendance::where('date', $today)->where('status', 'hadir')->count(),
            'todaySickPermission' => Attendance::where('date', $today)->whereIn('status', ['sakit', 'izin'])->count(),
            'todayAbsent'   => Attendance::where('date', $today)->where('status', 'alpa')->count(),
        ]);
    }
}