<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    /**
     * ربط مادة بصف
     */
    public function attach(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $class = ClassModel::find($request->class_id);

        $class->subjects()->attach($request->subject_id);

        return response()->json([
            'message' => 'Subject attached to class successfully'
        ]);
    }

    /**
     * فك ربط مادة من صف
     */
    public function detach(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $class = ClassModel::find($request->class_id);

        $class->subjects()->detach($request->subject_id);

        return response()->json([
            'message' => 'Subject detached from class successfully'
        ]);
    }
}
