<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Masukkan method relasi ini ke dalam model Student
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
        // Catatan: sesuaikan 'SchoolClass::class' dengan nama Model Kelas kamu
        // (misal: Classroom::class atau ClassModel::class)
    }

    // Jika model kelas kamu namanya 'SchoolClass', tapi kamu mau panggil $student->class
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}