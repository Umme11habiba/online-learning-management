<?php

namespace App\Http\Controllers;


use App\Models\Course;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{

public function dashboard()
{
    $user = auth()->user()->load('enrolledCourses');

    $enrolled = $user->enrolledCourses;

    $available = \App\Models\Course::where('status', 'approved')
        ->whereNotIn('id', $enrolled->pluck('id'))
        ->get();

    return view('student.dashboard', compact('enrolled', 'available'));
}
public function courseDetails($id)
{
    $course = Course::with(['assignments','liveClasses','recordedClasses'])->findOrFail($id);

    return view('student.course-details', compact('course'));
}
public function enroll(Request $request)
{
    $user = auth()->user();

    // duplicate avoid
    if (!$user->enrolledCourses->contains($request->course_id)) {
        $user->enrolledCourses()->attach($request->course_id);
    }

    return back()->with('success', 'Enrolled successfully!');
}

}