<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'user_id',
    ];

    // المدرس ↔ المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // المدرس ↔ الصفوف (Many to Many)
    public function classes()
    {
        return $this->belongsToMany(
            ClassModel::class,
            'class_teacher',
            'teacher_id',
            'class_id'
        );
    }
}
