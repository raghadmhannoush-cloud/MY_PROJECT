<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Admin → كل المواد
        if ($user->role === 'admin') {
            return Subject::with('classes')->get();
        }

        // Teacher → مواد صفوفه
        if ($user->role === 'teacher') {
            $classIds = $user->teacher->classes()->pluck('classes.id');

            return Subject::whereHas('classes', function ($q) use ($classIds) {
                $q->whereIn('classes.id', $classIds);
            })->get();
        }

        // Student → مواد صفه
        if ($user->role === 'student') {
            return Subject::whereHas('classes', function ($q) use ($user) {
                $q->where('classes.id', $user->student->class_id);
            })->get();
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        return Subject::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        $subject->update($request->all());

        return response()->json(['message' => 'Subject updated']);
    }

    public function destroy($id)
    {
        Subject::find($id)->delete();
        return response()->json(['message' => 'Subject deleted']);
    }
}
