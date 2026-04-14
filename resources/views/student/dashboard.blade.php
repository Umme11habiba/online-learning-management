@extends('layouts.app')

@section('content')

<style>
    body { background:#f1f5f9; }

    h1 { margin-bottom:20px; }

    .section {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .cards {
        display:flex;
        gap:15px;
        margin-bottom:20px;
    }

    .card {
        flex:1;
        background:white;
        padding:15px;
        border-radius:10px;
        box-shadow:0 4px 10px rgba(0,0,0,0.1);
        text-align:center;
    }

    .course-item {
        background:#f8fafc;
        padding:10px;
        border-radius:8px;
        margin-bottom:10px;
        transition:0.3s;
    }

    .course-item:hover {
        background:#e2e8f0;
        transform:translateX(5px);
    }

    .link {
        text-decoration:none;
        color:#2563eb;
        font-weight:500;
    }

    .btn {
        padding:6px 12px;
        background:#0ea5e9;
        color:white;
        border:none;
        border-radius:6px;
        cursor:pointer;
        font-size:13px;
    }

    .btn:hover {
        background:#0284c7;
    }

    .empty {
        color:#64748b;
        font-style:italic;
    }
</style>

<h1>🎓 Student Dashboard</h1>


<!-- Stats -->
<div class="cards">
    <div class="card">
        <h4>Courses</h4>
        <p>{{ $enrolled->count() }}</p>
    </div>
</div>

<!-- Enrolled Courses -->
<div class="section">
    <h2>📚 My Courses</h2>

    @if($enrolled->count())
        @foreach($enrolled as $course)
            <div class="course-item">
                ✔ 
                <a href="{{ route('student.course.show', $course->id) }}" class="link">
                    {{ $course->title }}
                </a>
            </div>
        @endforeach
    @else
        <p class="empty">No enrolled courses</p>
    @endif

    <hr>

    <!-- Available Courses -->
    <h2>🆕 Available Courses</h2>

    @if($available->count())
        @foreach($available as $course)
            <div class="course-item">
                <b>{{ $course->title }}</b>

                <form method="POST" action="{{ route('student.enroll') }}" style="margin-top:5px;">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit" class="btn">Enroll</button>
                </form>
            </div>
        @endforeach
    @else
        <p class="empty">No available courses</p>
    @endif

</div>

@endsection