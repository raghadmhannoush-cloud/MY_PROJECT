<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * عرض سجلات الحضور
     * - Admin: كل الحضور
     * - Teacher: حضور طلاب صفوفه فقط
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Admin → كل الحضور
        if ($user->role === 'admin') {
            return Attendance::with('student')->get();
        }

        // Teacher → حضور صفوفه فقط
        if ($user->role === 'teacher') {

            $teacher = $user->teacher;

            $classIds = $teacher->classes()->pluck('classes.id');

            return Attendance::whereHas('student', function ($query) use ($classIds) {
                $query->whereIn('class_id', $classIds);
            })
            ->with('student')
            ->get();
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    /**
     * عرض حضور الطالب نفسه فقط
     */
    public function myAttendance(Request $request)
    {
        $student = $request->user()->student;

        if (! $student) {
            return response()->json([
                'message' => 'Student profile not found'
            ], 404);
        }

        return Attendance::where('student_id', $student->id)->get();
    }

    /**
     * إنشاء سجل حضور جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'is_present' => 'required|boolean',
        ]);

        $attendance = Attendance::create([
            'student_id' => $request->student_id,
            'date' => $request->date,
            'is_present' => $request->is_present,
        ]);

        return response()->json([
            'message' => 'Attendance record created successfully',
            'attendance' => $attendance
        ], 201);
    }

    /**
     * عرض سجل حضور واحد
     */
    public function show($id)
    {
        $attendance = Attendance::with('student')->find($id);

        if (! $attendance) {
            return response()->json(['message' => 'Attendance not found'], 404);
        }

        return response()->json($attendance);
    }

    /**
     * تعديل سجل حضور
     */
    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        if (! $attendance) {
            return response()->json(['message' => 'Attendance not found'], 404);
        }

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'is_present' => 'required|boolean',
        ]);

        $attendance->update([
            'student_id' => $request->student_id,
            'date' => $request->date,
            'is_present' => $request->is_present,
        ]);

        return response()->json([
            'message' => 'Attendance record updated successfully'
        ]);
    }

    /**
     * حذف سجل حضور
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id);

        if (! $attendance) {
            return response()->json(['message' => 'Attendance not found'], 404);
        }

        $attendance->delete();

        return response()->json([
            'message' => 'Attendance record deleted successfully'
        ]);
    }
}
