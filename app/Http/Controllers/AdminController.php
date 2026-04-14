<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
     public function dashboard()
    {
        $totalUsers = User::count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTeachers',
            'totalStudents',
            'totalCourses'
        ));
    }
public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function courses()
    {
        $courses = Course::latest()->get();
        return view('admin.courses', compact('courses'));
    }

public function deleteUser($id)
{
    User::findOrFail($id)->delete();

    return back()->with('success', 'User deleted successfully');
}
public function approveCourse($id)
{
    $course = \App\Models\Course::findOrFail($id);
    $course->status = 'approved';
    $course->save();

    return back();
}

public function rejectCourse($id)
{
    $course = \App\Models\Course::findOrFail($id);
    $course->status = 'rejected';
    $course->save();

    return back();
}
public function deleteCourse($id)
{
    Course::findOrFail($id)->delete();

    return back()->with('success', 'Course deleted successfully!');
}

    // 📋 All users
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // ➕ Create form
    public function create()
    {
        return view('admin.create-user');
    }

    // 💾 Store user
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users')->with('success', 'User created!');
    }

    // 🗑 Delete
    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'User deleted!');
    }
    
}

