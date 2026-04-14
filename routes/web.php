<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin');

    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    })->middleware('role:teacher');

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->middleware('role:student');

});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses');

});
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])
        ->name('student.dashboard');
});


Route::delete('/admin/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])
    ->name('admin.user.delete');



Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {

    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');

    Route::get('/courses/create', [TeacherController::class, 'createCourse'])->name('teacher.course.create');
    Route::post('/courses/store', [TeacherController::class, 'storeCourse'])->name('teacher.course.store');

});
Route::middleware(['auth','role:teacher'])->prefix('teacher')->group(function () {

    Route::get('/courses/{course}', [TeacherController::class, 'show'])->name('teacher.course.show');

    Route::post('/assignments/store', [TeacherController::class, 'storeAssignment'])->name('teacher.assignment.store');

    Route::post('/live/store', [TeacherController::class, 'storeLive'])->name('teacher.live.store');

    Route::post('/recorded/store', [TeacherController::class, 'storeRecorded'])->name('teacher.recorded.store');

});
Route::get('/teacher/course/{id}', [TeacherController::class, 'show'])
    ->name('teacher.course.show');
Route::post('/admin/course/{id}/approve', [AdminController::class, 'approveCourse'])->name('admin.course.approve');
Route::post('/admin/course/{id}/reject', [AdminController::class, 'rejectCourse'])->name('admin.course.reject');


Route::middleware(['auth','role:teacher'])->prefix('teacher')->group(function () {

    // Assignment create page
    Route::get('/assignment/create/{course}', 
        [TeacherController::class, 'createAssignment'])
        ->name('teacher.assignment.create');

    // Assignment store
    Route::post('/assignment/store', 
        [TeacherController::class, 'storeAssignment'])
        ->name('teacher.assignment.store');

});

Route::middleware(['auth','role:teacher'])->prefix('teacher')->group(function () {

    // LIVE CREATE
    Route::get('/live/create/{course}', 
        [TeacherController::class, 'createLive'])
        ->name('teacher.live.create');

    // LIVE STORE
    Route::post('/live/store', 
        [TeacherController::class, 'storeLive'])
        ->name('teacher.live.store');

});

Route::middleware(['auth','role:teacher'])->prefix('teacher')->group(function () {

    // RECORDED CREATE
    Route::get('/recorded/create/{course}', 
        [TeacherController::class, 'createRecorded'])
        ->name('teacher.recorded.create');

    // RECORDED STORE
    Route::post('/recorded/store', 
        [TeacherController::class, 'storeRecorded'])
        ->name('teacher.recorded.store');

});
Route::post('/student/enroll', [StudentController::class, 'enroll'])
    ->name('student.enroll');
    Route::get('/student/course/{id}', [App\Http\Controllers\StudentController::class, 'courseDetails'])
    ->name('student.course.show');
    Route::delete('/admin/user/reject/{id}', [AdminController::class, 'rejectUser'])
    ->name('admin.user.reject');

   Route::post('/admin/course/{id}/approve', [AdminController::class, 'approveCourse'])->name('admin.course.approve');

Route::delete('/admin/course/{id}/reject', [AdminController::class, 'rejectCourse'])->name('admin.course.reject');

Route::delete('/admin/course/{id}/delete', [AdminController::class, 'deleteCourse'])->name('admin.course.delete');
Route::post('/student/submit', [SubmissionController::class, 'store'])
    ->name('student.submit');
Route::get('/student/submission/{id}', [SubmissionController::class, 'show'])
    ->name('student.submission.view');
Route::delete('/student/submission/{id}', [SubmissionController::class, 'destroy'])
    ->name('student.submission.delete'); 
    Route::get('/teacher/course/{id}', [TeacherController::class, 'showCourse'])
    ->name('teacher.course.show');
    Route::post('/student/submission', [SubmissionController::class, 'store'])
    ->name('student.submission.store');
    Route::post('/teacher/submission/{id}/grade', [TeacherController::class, 'grade'])
    ->name('teacher.submission.grade');
Route::delete('/teacher/assignment/{id}', [TeacherController::class, 'deleteAssignment'])
    ->name('teacher.assignment.delete');

Route::delete('/teacher/live/{id}', [TeacherController::class, 'deleteLive'])
    ->name('teacher.live.delete');

Route::delete('/teacher/recorded/{id}', [TeacherController::class, 'deleteRecorded'])
    ->name('teacher.recorded.delete');
    Route::delete('/teacher/course/{id}', [TeacherController::class, 'deleteCourse'])
    ->name('teacher.course.delete');
    Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');

    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');

    Route::post('/admin/users/store', [AdminController::class, 'store'])->name('admin.users.store');

    Route::delete('/admin/users/{id}', [AdminController::class, 'delete'])->name('admin.users.delete');

});
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// register page
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// register submit
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');