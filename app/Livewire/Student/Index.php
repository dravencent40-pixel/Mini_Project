<?php

namespace App\Livewire\Student; // Sesuaikan namespace kamu

use Livewire\Component;
use Livewire\Attributes\Layout; // 1. Import Attribute Layout
use App\Models\Student;

class Index extends Component
{
    // 2. Pasang Attribute #[Layout] di atas render() atau di atas class
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.student.index', [
            'students' => Student::latest()->paginate(10),
        ]);
    }
}