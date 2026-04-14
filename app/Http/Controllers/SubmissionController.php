<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
public function store(Request $request)
{
    $path = $request->file('file')->store('submissions', 'public');

    Submission::create([
        'assignment_id' => $request->assignment_id,
        'user_id' => auth()->id(),
        'file' => $path
    ]);

    return back()->with('success', 'Assignment Submitted successfully!');
}

    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);

        if ($submission->user_id != auth()->id()) {
            abort(403);
        }

        \Storage::delete($submission->file);
        $submission->delete();

        return back()->with('success', ' Assignment Deleted!');
    }


public function show($id)
{
    $submission = Submission::findOrFail($id);

    if (
        $submission->user_id !== auth()->id() &&
        auth()->user()->role !== 'teacher'
    ) {
        abort(403);
    }

    if (!Storage::disk('public')->exists($submission->file)) {
        abort(404, 'File not found');
    }

    return response()->file(
        storage_path('app/public/' . $submission->file)
    );
}


}