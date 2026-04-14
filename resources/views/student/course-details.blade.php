@extends('layouts.app')

@section('content')

<style>
    body {
        background:#f1f5f9;
    }

    .header {
        margin-bottom:25px;
    }

    .header h1 {
        margin:0;
        font-size:28px;
        color:#0f172a;
    }

    .header p {
        color:#64748b;
        margin-top:5px;
    }

    .section {
        background:white;
        padding:20px;
        border-radius:14px;
        margin-bottom:20px;
        box-shadow:0 8px 20px rgba(0,0,0,0.08);
        transition:0.3s;
    }

    .section:hover {
        transform:translateY(-3px);
    }

    .section h3 {
        margin-bottom:15px;
        color:#1e293b;
        display:flex;
        align-items:center;
        gap:8px;
    }

    .card {
        background:#f8fafc;
        padding:12px;
        border-radius:10px;
        margin-bottom:10px;
        transition:0.3s;
        border-left:4px solid transparent;
    }

    .card:hover {
        background:#e2e8f0;
        transform:translateX(6px);
        border-left:4px solid #6366f1;
    }

    .link {
        color:#2563eb;
        text-decoration:none;
        font-size:14px;
    }

    .link:hover {
        text-decoration:underline;
    }

    .empty {
        color:#94a3b8;
        font-style:italic;
    }

    .badge {
        display:inline-block;
        background:#6366f1;
        color:white;
        padding:3px 8px;
        border-radius:6px;
        font-size:11px;
        margin-left:5px;
    }
</style>

<!-- 🔷 Header -->
<div class="header">
    <h1>📚 {{ $course->title }}</h1>
    <p>{{ $course->description }}</p>
</div>

<div class="section">
    <h3>
        📝 Assignments 
        <span class="badge">{{ $course->assignments->count() }}</span>
    </h3>

    @forelse($course->assignments as $a)

        @php
            $deadline = \Carbon\Carbon::parse($a->deadline);
            $isLate = now()->gt($deadline);

            $submission = $a->submissions
                ->where('user_id', auth()->id())
                ->first();
        @endphp

        <div class="card">

            👉 <strong>{{ $a->title }}</strong>

            <!-- ⏱ Deadline / Late -->
           <!-- ⏱ Deadline / Time -->
@if(!$isLate)

    @php
        $diff = now()->diff($deadline);
    @endphp

    <p style="color:#16a34a;">
        ⏳ {{ $diff->d }}d 
        {{ $diff->h }}h 
        {{ $diff->i }}m left
    </p>

@else

    @php
        $lateDiff = $deadline->diff(now());
    @endphp

    <p style="color:#f97316;">
        ⚠️ Late by 
        {{ $lateDiff->d }}d 
        {{ $lateDiff->h }}h 
        {{ $lateDiff->i }}m
    </p>

@endif
            

            <hr>

            {{-- ✅ IF SUBMITTED --}}
            @if($submission)

                <!-- VIEW -->
                <a href="{{ route('student.submission.view', $submission->id) }}" target="_blank">
                    📄 View Submission
                </a>

                <br><br>

                <!-- 🎯 MARKS -->
                @if($submission->marks !== null)

                    <div style="background:#ecfdf5;padding:10px;border-radius:8px;">
                        🎯 <strong>Marks:</strong> {{ $submission->marks }}

                        @if($submission->feedback)
                            <br>
                            💬 <strong>Feedback:</strong> {{ $submission->feedback }}
                        @endif
                    </div>

                @else
                    <p style="color:orange;">⏳ Not graded yet</p>
                @endif

                <!-- DELETE (always allowed) -->
                <form method="POST"
                      action="{{ route('student.submission.delete', $submission->id) }}"
                      style="margin-top:10px;">
                    @csrf
                    @method('DELETE')

                    <button style="background:red;color:white;padding:5px 10px;border:none;border-radius:5px;">
                        🗑 Delete
                    </button>
                </form>

            @else

                <!-- ✅ SUBMIT (always allowed even late) -->
                <form method="POST"
                      action="{{ route('student.submission.store') }}"
                      enctype="multipart/form-data"
                      style="margin-top:10px;">

                    @csrf
                    <input type="hidden" name="assignment_id" value="{{ $a->id }}">

                    <input type="file" name="file" required>

                    <button style="background:#10b981;color:white;padding:6px 12px;border:none;border-radius:6px;">
                        📤 Submit Assignment
                    </button>
                </form>

            @endif

        </div>

    @empty
        <p>No assignments available</p>
    @endforelse
</div>
<!-- 🔴 Live Classes -->
<div class="section">
    <h3>🔴 Live Classes <span class="badge">{{ $course->liveClasses->count() }}</span></h3>

    @forelse($course->liveClasses as $l)
        <div class="card">
            👉 <strong>{{ $l->title }}</strong><br>
            <small>{{ $l->date }}</small><br>

            @if($l->link)
                <a href="{{ $l->link }}" target="_blank" class="link">
                    🔗 Join Class
                </a>
            @endif
        </div>
    @empty
        <p class="empty">No live classes scheduled</p>
    @endforelse
    
</div>

<!-- 🎥 Recorded -->
<div class="section">
    <h3>🎥 Recorded Classes <span class="badge">{{ $course->recordedClasses->count() }}</span></h3>

    @forelse($course->recordedClasses as $r)
        <div class="card">
            👉 <strong>{{ $r->title }}</strong><br>

            @if($r->video_url)
                <a href="{{ $r->video_url }}" target="_blank" class="link">
                    ▶ Watch Video
                </a>
            @endif
        </div>
    @empty
        <p class="empty">No recorded classes available</p>
    @endforelse
</div>

@endsection