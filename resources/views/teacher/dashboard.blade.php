@extends('layouts.app')

@section('content')

<style>
    h1 {
        margin-bottom: 20px;
    }

    .top {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }

    .btn {
        padding:10px 18px;
        background: linear-gradient(45deg, #0ea5e9, #6366f1);
        color:white;
        border:none;
        border-radius:8px;
        text-decoration:none;
        font-weight:bold;
        transition:0.3s;
    }

    .btn:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }

    .stats {
        display:flex;
        gap:15px;
        margin-bottom:25px;
    }

    .stat-card {
        flex:1;
        background:white;
        padding:15px;
        border-radius:12px;
        box-shadow:0 4px 10px rgba(0,0,0,0.1);
        text-align:center;
        transition:0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .courses {
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(220px,1fr));
        gap:20px;
    }

    .card {
        background:white;
        padding:18px;
        border-radius:12px;
        box-shadow:0 5px 15px rgba(0,0,0,0.1);
        transition:0.3s;
        cursor:pointer;
    }

    .card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow:0 10px 25px rgba(0,0,0,0.2);
    }

    .badge {
        display:inline-block;
        margin-top:10px;
        padding:5px 10px;
        border-radius:6px;
        color:white;
        font-size:12px;
    }

    .pending { background:#f59e0b; }
    .approved { background:#10b981; }
    .rejected { background:#ef4444; }

    .empty {
        color:#64748b;
        font-style:italic;
    }
</style>

<div class="top">
    <h1>👨‍🏫 Teacher Dashboard</h1>
    <a href="{{ route('teacher.course.create') }}" class="btn">+ Create Course</a>
</div>

<!-- Stats -->
<div class="stats">
    <div class="stat-card">
        <h3>Total Courses</h3>
        <p>{{ $courses->count() }}</p>
    </div>

    <div class="stat-card">
        <h3>Approved</h3>
        <p>{{ $courses->where('status','approved')->count() }}</p>
    </div>

    <div class="stat-card">
        <h3>Pending</h3>
        <p>{{ $courses->where('status','pending')->count() }}</p>
    </div>
</div>

<!-- Courses -->
<h2>📚 My Courses</h2>

@if($courses->count())

<div class="courses">

    @foreach($courses as $course)

        <div class="card" style="position:relative;cursor:pointer;"
             onclick="window.location='{{ route('teacher.course.show', $course->id) }}'">

            <!-- DELETE BUTTON -->
            <form method="POST"
                  action="{{ route('teacher.course.delete', $course->id) }}"
                  style="position:absolute;top:10px;right:10px;"
                  onclick="event.stopPropagation();"
                  onsubmit="return confirm('Delete this course?')">

                @csrf
                @method('DELETE')

                <button style="background:#ef4444;color:white;border:none;padding:5px 8px;border-radius:6px;">
                    🗑
                </button>
            </form>

            <h3>{{ $course->title }}</h3>
            <p>{{ $course->description }}</p>

            <span class="badge {{ $course->status }}">
                {{ ucfirst($course->status) }}
            </span>

        </div>

    @endforeach

</div>

@else
    <p class="empty">No courses yet</p>
@endif

@endsection