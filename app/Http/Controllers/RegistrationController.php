<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * عرض التسجيلات
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Admin → كل التسجيلات
        if ($user->role === 'admin') {
            return Registration::with(['student', 'class'])->get();
        }

        // Teacher → تسجيلات صفوفه فقط
        if ($user->role === 'teacher') {

            $teacher = $user->teacher;
            $classIds = $teacher->classes()->pluck('classes.id');

            return Registration::whereIn('class_id', $classIds)
                ->with(['student', 'class'])
                ->get();
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    /**
     * تسجيل طالب (Admin + Teacher)
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'registration_date' => 'required|date',
        ]);

        $registration = Registration::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'registration_date' => $request->registration_date,
        ]);

        return response()->json([
            'message' => 'Registration created successfully',
            'registration' => $registration
        ], 201);
    }

    /**
     * عرض تسجيل واحد
     */
    public function show($id)
    {
        $registration = Registration::with(['student', 'class'])->find($id);

        if (! $registration) {
            return response()->json(['message' => 'Registration not found'], 404);
        }

        return response()->json($registration);
    }

    /**
     * عرض تسجيل الطالب نفسه
     */
    public function myRegistration(Request $request)
    {
        $student = $request->user()->student;

        if (! $student) {
            return response()->json(['message' => 'Student profile not found'], 404);
        }

        return Registration::where('student_id', $student->id)
            ->with('class')
            ->get();
    }

    /**
     * تعديل تسجيل (Admin فقط)
     */
    public function update(Request $request, $id)
    {
        $registration = Registration::find($id);

        if (! $registration) {
            return response()->json(['message' => 'Registration not found'], 404);
        }

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'registration_date' => 'required|date',
        ]);

        $registration->update($request->all());

        return response()->json(['message' => 'Registration updated successfully']);
    }

    /**
     * حذف تسجيل (Admin فقط)
     */
    public function destroy($id)
    {
        $registration = Registration::find($id);

        if (! $registration) {
            return response()->json(['message' => 'Registration not found'], 404);
        }

        $registration->delete();

        return response()->json(['message' => 'Registration deleted successfully']);
    }
}
