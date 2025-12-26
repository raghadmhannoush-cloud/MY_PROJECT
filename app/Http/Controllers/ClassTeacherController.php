<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassTeacherController extends Controller
{
    /**
     * ربط مدرس بصف
     */
    public function attach(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $class = ClassModel::find($request->class_id);

        $class->teachers()->attach($request->teacher_id);

        return response()->json([
            'message' => 'Teacher attached to class successfully'
        ]);
    }

    /**
     * فك ربط مدرس من صف
     */
    public function detach(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $class = ClassModel::find($request->class_id);

        $class->teachers()->detach($request->teacher_id);

        return response()->json([
            'message' => 'Teacher detached from class successfully'
        ]);
    }
}
