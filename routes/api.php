<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Auth (بدون تسجيل دخول)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Routes تحتاج تسجيل دخول
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', fn (Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | Admin فقط
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        /* ===== Students ===== */
        Route::post('/students', [StudentController::class, 'store']);
        Route::put('/students/{id}', [StudentController::class, 'update']);
        Route::delete('/students/{id}', [StudentController::class, 'destroy']);

        /* ===== Classes ===== */
        Route::post('/classes', [ClassController::class, 'store']);
        Route::get('/classes/{id}', [ClassController::class, 'show']);
        Route::put('/classes/{id}', [ClassController::class, 'update']);
        Route::delete('/classes/{id}', [ClassController::class, 'destroy']);

        /* ===== Teachers ===== */
        Route::post('/teachers', [TeacherController::class, 'store']);
        Route::put('/teachers/{id}', [TeacherController::class, 'update']);
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);

        /* ===== Subjects ===== */
        Route::post('/subjects', [SubjectController::class, 'store']);
        Route::put('/subjects/{id}', [SubjectController::class, 'update']);
        Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);

        /* ===== 🔥 Class Relations (الخطوة الخامسة) ===== */
        // ربط صف ↔ أستاذ
        Route::post('/class-teacher/attach', [ClassTeacherController::class, 'attach']);
        Route::post('/class-teacher/detach', [ClassTeacherController::class, 'detach']);

        // ربط صف ↔ مادة
        Route::post('/class-subject/attach', [ClassSubjectController::class, 'attach']);
        Route::post('/class-subject/detach', [ClassSubjectController::class, 'detach']);

        /* ===== Payments ===== */
        Route::apiResource('payments', PaymentController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Admin + Teacher
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,teacher')->group(function () {

        Route::get('/students', [StudentController::class, 'index']);
        Route::get('/students/{id}', [StudentController::class, 'show']);

        Route::get('/registrations', [RegistrationController::class, 'index']);
        Route::post('/registrations', [RegistrationController::class, 'store']);
        Route::get('/registrations/{id}', [RegistrationController::class, 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | Student فقط
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:student')->group(function () {
        Route::get('/my-profile', [StudentController::class, 'myProfile']);
        Route::get('/my-registration', [RegistrationController::class, 'myRegistration']);
    });

    /*
    |--------------------------------------------------------------------------
    | Classes & Subjects (قراءة حسب الدور)
    |--------------------------------------------------------------------------
    */
    Route::get('/classes', [ClassController::class, 'index']);
    Route::get('/subjects', [SubjectController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/attendances', 'index');
        Route::post('/attendances', 'store');
        Route::get('/attendances/{id}', 'show');
        Route::put('/attendances/{id}', 'update');
        Route::delete('/attendances/{id}', 'destroy');
    });
});
