<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Admin → كل الصفوف
        if ($user->role === 'admin') {
            return ClassModel::with(['subjects', 'teachers'])->get();
        }

        // Teacher → صفوفه فقط
        if ($user->role === 'teacher') {
            return $user->teacher->classes()->with('subjects')->get();
        }

        // Student → صفه فقط
        if ($user->role === 'student') {
            return ClassModel::with('subjects')
                ->where('id', $user->student->class_id)
                ->get();
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        return ClassModel::create($request->all());
    }

    public function show($id)
    {
        $class = ClassModel::with(['students', 'subjects', 'teachers'])->find($id);

        if (! $class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return $class;
    }

    public function update(Request $request, $id)
    {
        $class = ClassModel::find($id);

        if (! $class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $class->update($request->all());

        return response()->json(['message' => 'Class updated']);
    }

    public function destroy($id)
    {
        $class = ClassModel::find($id);

        if (! $class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $class->delete();

        return response()->json(['message' => 'Class deleted']);
    }
}
