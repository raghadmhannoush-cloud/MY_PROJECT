<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name',
        'class_id',
        'user_id', // ⬅️ ضروري
    ];

    // الطالب ↔ المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // الطالب ↔ الصف
    public function classRoom()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
