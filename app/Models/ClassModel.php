<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = ['name'];

    // الصف → طلاب
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    // الصف ↔ مدرسين (Many To Many)
    public function teachers()
    {
        return $this->belongsToMany(
            Teacher::class,
            'class_teacher',
            'class_id',
            'teacher_id'
        );
    }

    // الصف ↔ مواد (Many To Many)
    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'class_subject',
            'class_id',
            'subject_id'
        );
    }

    // الصف → تسجيلات
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'class_id');
    }
}
