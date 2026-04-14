@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #6366f1, #0ea5e9);
        min-height:100vh;
    }

    .form-container {
        max-width: 520px;
        margin: 60px auto;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(15px);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {opacity:0; transform:translateY(20px);}
        to {opacity:1; transform:translateY(0);}
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: white;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: white;
    }

    input, textarea {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: none;
        outline: none;
        background: rgba(255,255,255,0.8);
        transition: 0.3s;
    }

    input:focus, textarea:focus {
        background: white;
        box-shadow: 0 0 8px rgba(255,255,255,0.6);
    }

    textarea {
        resize: none;
        height: 100px;
    }

    .btn {
        width: 100%;
        background: #10b981;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn:hover {
        background: #059669;
        transform: scale(1.03);
    }

    .back {
        display: block;
        text-align: center;
        margin-top: 15px;
        text-decoration: none;
        color: white;
        opacity: 0.8;
    }

    .back:hover {
        opacity: 1;
    }
</style>

<div class="form-container">

    <h2>➕ Add Assignment</h2>

    <form method="POST" action="{{ route('teacher.assignment.store') }}">
        @csrf

        <input type="hidden" name="course_id" value="{{ $course_id }}">

        <div class="form-group">
            <label>📌 Title</label>
            <input type="text" name="title" placeholder="Enter assignment title" required>
        </div>

        <div class="form-group">
            <label>📝 Description</label>
            <textarea name="description" placeholder="Write assignment details..."></textarea>
        </div>

        <div class="form-group">
            <label>📅 Deadline</label>
            <input type="date" name="deadline">
        </div>

        <button type="submit" class="btn">
            💾 Save Assignment
        </button>
    </form>

    <a href="{{ route('teacher.course.show', $course_id) }}" class="back">
    ← Back
</a>

</div>

@endsection