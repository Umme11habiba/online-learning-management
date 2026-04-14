@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #0ea5e9, #6366f1);
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

    input {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: none;
        outline: none;
        background: rgba(255,255,255,0.85);
        transition: 0.3s;
    }

    input:focus {
        background: white;
        box-shadow: 0 0 8px rgba(255,255,255,0.6);
    }

    .btn {
        width: 100%;
        background: #6366f1;
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
        background: #4f46e5;
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

    .note {
        font-size: 12px;
        color: #e2e8f0;
        margin-top: 5px;
    }
</style>

<div class="form-container">

    <h2>🎥 Add Recorded Class</h2>

    <form method="POST" action="{{ route('teacher.recorded.store') }}">
        @csrf

        <input type="hidden" name="course_id" value="{{ $course_id }}">

        <div class="form-group">
            <label>📌 Title</label>
            <input type="text" name="title" placeholder="Enter class title" required>
        </div>

        <div class="form-group">
            <label>🎬 Video URL</label>
            <input type="text" name="video_url" placeholder="YouTube / Google Drive link">

            <div class="note">
                Example: https://youtube.com/... or https://drive.google.com/...
            </div>
        </div>

        <button type="submit" class="btn">
            💾 Save Recorded Class
        </button>
    </form>

    <!-- Back FIX -->
    <a href="{{ route('teacher.course.show', $course_id) }}" class="back">
        ← Back to Course
    </a>

</div>

@endsection