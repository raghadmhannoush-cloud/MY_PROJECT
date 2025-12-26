<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * عرض الطلاب
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Admin → كل الطلاب
        if ($user->role === 'admin') {
            return Student::with('classRoom')->get();
        }

        // Teacher → طلاب صفوفه فقط
        if ($user->role === 'teacher') {

            $teacher = $user->teacher;
            $classIds = $teacher->classes()->pluck('classes.id');

            return Student::whereIn('class_id', $classIds)
                ->with('classRoom')
                ->get();
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    /**
     * إضافة طالب (Admin فقط)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student
        ], 201);
    }

    /**
     * عرض طالب واحد
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $student = Student::with('classRoom')->find($id);

        if (! $student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Admin → OK
        if ($user->role === 'admin') {
            return $student;
        }

        // Teacher → إذا الطالب من صفه
        if ($user->role === 'teacher') {

            $classIds = $user->teacher->classes()->pluck('classes.id');

            if ($classIds->contains($student->class_id)) {
                return $student;
            }
        }

        // Student → يشوف حاله بس
        if ($user->role === 'student' && $user->student->id === $student->id) {
            return $student;
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    /**
     * تعديل طالب (Admin فقط)
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (! $student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'class_id' => 'sometimes|required|exists:classes,id',
        ]);

        $student->update($request->all());

        return response()->json([
            'message' => 'Student updated successfully'
        ]);
    }

    /**
     * حذف طالب (Admin فقط)
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if (! $student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }

    /**
     * بيانات الطالب نفسه
     */
    public function myProfile(Request $request)
    {
        return Student::with('classRoom')
            ->find($request->user()->student->id);
    }
}
