<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id')->withDefault([
            'name' => 'Tanpa Kelas',
        ]);
        // Catatan: Jika nama model kelasmu "Classes", ubah ClassModel::class jadi Classes::class
    }
}