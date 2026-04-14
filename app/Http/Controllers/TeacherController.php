<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\LiveClass;
use App\Models\RecordedClass;
use App\Models\Submission;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $courses = Course::where('user_id', auth()->id())->latest()->get();

        return view('teacher.dashboard', compact('courses'));
    }

    public function createCourse()
    {
        return view('teacher.create-course');
    }

 public function storeCourse(Request $request)
{
    $course = \App\Models\Course::create([
        'title' => $request->title,
        'description' => $request->description,
        'user_id' => auth()->id(),
        'status' => 'pending'
    ]);

    return redirect()->route('teacher.course.show', $course->id);
}
public function show($id)
{
    $course = \App\Models\Course::with([
        'assignments',
        'liveClasses',
        'recordedClasses'
    ])->findOrFail($id);

    return view('teacher.course-details', compact('course'));
}
public function storeAssignment(Request $request)
{
    Assignment::create([
        'course_id' => $request->course_id,
        'title' => $request->title,
        'description' => $request->description,
        'deadline' => $request->deadline
    ]);

  return redirect()->route('teacher.course.show', $request->course_id)
    ->with('success', 'Assignment created!');
}
public function storeLive(Request $request)
{
    LiveClass::create([
        'course_id' => $request->course_id,
        'title' => $request->title,
        'date' => $request->date,
        'link' => $request->link,
    ]);

    return redirect()->route('teacher.course.show', $request->course_id)
    ->with('success','Live class created');
}
public function storeRecorded(Request $request)
{
    RecordedClass::create([
        'course_id' => $request->course_id,
        'title' => $request->title,
        'video_url' => $request->video_url,
    ]);

    return redirect()->route('teacher.course.show', $request->course_id)
    ->with('success','Recorded class created');;
}
public function createAssignment($course_id)
{
    return view('teacher.add-assignment', compact('course_id'));
}
public function createLive($course_id)
{
    return view('teacher.add-live', compact('course_id'));
}
public function createRecorded($course_id)
{
    return view('teacher.add-recorded', compact('course_id'));
}
public function showCourse($id)
{
    $course = Course::with([
        'assignments.submissions.user'
    ])->findOrFail($id);

    return view('teacher.course-show', compact('course'));
}



public function grade(Request $request, $id)
{
    $submission = Submission::findOrFail($id);

    $submission->marks = $request->marks;
    $submission->feedback = $request->feedback;
    $submission->save();

    return back()->with('success', 'Graded!');
}

// Assignment delete
public function deleteAssignment($id)
{
    Assignment::findOrFail($id)->delete();
    return back()->with('success', 'Assignment deleted!');
}

// Live delete
public function deleteLive($id)
{
    LiveClass::findOrFail($id)->delete();
    return back()->with('success', 'Live class deleted!');
}

// Recorded delete
public function deleteRecorded($id)
{
    RecordedClass::findOrFail($id)->delete();
    return back()->with('success', 'Recorded class deleted!');
}
public function deleteCourse($id)
{
    $course = Course::findOrFail($id);
    $course->delete();

    return back()->with('success', 'Course deleted!');
}
}