@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f1f5f9;
    }

    .header {
        margin-bottom: 25px;
    }

    .header h1 {
        font-size: 28px;
        color: #0f172a;
    }

    .header p {
        color: #64748b;
    }

    .section {
        background: white;
        padding: 20px;
        border-radius: 14px;
        margin-bottom: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        transition: 0.3s;
    }

    .section:hover {
        transform: translateY(-3px);
    }

    .top {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom: 15px;
    }

    .top h3 {
        margin: 0;
        font-size: 18px;
    }

    .btn {
        padding:7px 14px;
        background: linear-gradient(45deg,#0ea5e9,#6366f1);
        color:white;
        border:none;
        border-radius:8px;
        text-decoration:none;
        font-size:13px;
        font-weight:600;
        transition:0.3s;
    }

    .btn:hover {
        transform: scale(1.05);
        opacity:0.9;
    }

    .card {
        background:#f8fafc;
        padding:12px;
        border-radius:10px;
        margin-bottom:10px;
        transition:0.3s;
        border-left: 4px solid #0ea5e9;
    }

    .card:hover {
        background:#e2e8f0;
        transform: translateX(6px);
    }

    .card small {
        color:#64748b;
    }

    .link {
        display:inline-block;
        margin-top:5px;
        color:#2563eb;
        font-size:13px;
    }

    .link:hover {
        text-decoration:underline;
    }

    .empty {
        color:#94a3b8;
        font-style:italic;
    }
</style>

<!-- Header -->
<div class="header">
    <h1>📚 {{ $course->title }}</h1>
    <p>{{ $course->description }}</p>
</div>

<!-- ================= ASSIGNMENTS ================= -->
<div class="section">

    <!-- HEADER -->
    <div class="top" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
        <h3 style="color:#1e293b;">📝 Assignments</h3>

        <a href="{{ route('teacher.assignment.create', $course->id) }}"
           style="background:#3b82f6;color:white;padding:8px 14px;border-radius:8px;text-decoration:none;font-size:14px;">
            + Add
        </a>
    </div>

    @foreach($course->assignments as $a)

    <div class="card" style="background:white;padding:18px;border-radius:14px;margin-bottom:18px;box-shadow:0 6px 18px rgba(0,0,0,0.08);">

        <!-- TITLE -->
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">

            <div>
                <h4 style="margin:0;color:#0f172a;">👉 {{ $a->title }}</h4>

                <!-- DEADLINE -->
                <p style="color:#64748b;font-size:13px;margin-top:6px;">
                    📅 {{ \Carbon\Carbon::parse($a->deadline)->format('d M Y, h:i A') }}
                </p>
            </div>

            <!-- DELETE -->
            <form method="POST"
                  action="{{ route('teacher.assignment.delete', $a->id) }}"
                  onsubmit="return confirm('Delete assignment?')">

                @csrf
                @method('DELETE')

                <button style="background:#ef4444;color:white;padding:6px 10px;border:none;border-radius:8px;">
                    🗑
                </button>
            </form>

        </div>

        <hr style="margin:15px 0;">

        <h4 style="margin-bottom:12px;color:#334155;">📥 Submissions</h4>

        @forelse($a->submissions as $s)

        @php
            $deadline = \Carbon\Carbon::parse($a->deadline);
            $submittedAt = \Carbon\Carbon::parse($s->created_at);
            $isLate = $submittedAt->gt($deadline);
        @endphp

        <div style="background:#f8fafc;padding:14px;border-radius:10px;margin-bottom:12px;border-left:4px solid {{ $isLate ? '#f97316' : '#22c55e' }};">

            <!-- USER -->
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <strong style="color:#1e293b;">👤 {{ $s->user->name }}</strong>

                <a href="{{ route('student.submission.view', $s->id) }}" target="_blank"
                   style="color:#2563eb;font-size:14px;text-decoration:none;">
                    📄 View
                </a>
            </div>

            <!-- STATUS -->
            @if(!$isLate)
                @php $earlyDiff = $submittedAt->diff($deadline); @endphp

                <p style="color:#16a34a;font-size:13px;margin-top:5px;">
                    ⏳ Early by {{ $earlyDiff->d }}d {{ $earlyDiff->h }}h {{ $earlyDiff->i }}m
                </p>
            @else
                @php $lateDiff = $deadline->diff($submittedAt); @endphp

                <p style="color:#f97316;font-size:13px;margin-top:5px;">
                    ⚠️ Late by {{ $lateDiff->d }}d {{ $lateDiff->h }}h {{ $lateDiff->i }}m
                </p>
            @endif

            <!-- ✅ FIXED FORM -->
            <form method="POST" action="{{ route('teacher.submission.grade', $s->id) }}" style="margin-top:10px;">
                @csrf

                <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">

                    <input type="number" name="marks"
                           value="{{ $s->marks }}"
                           placeholder="Marks"
                           style="width:80px;padding:6px;border-radius:6px;border:1px solid #cbd5e1;">

                    <textarea name="feedback"
                              placeholder="Feedback"
                              style="flex:1;padding:6px;border-radius:6px;border:1px solid #cbd5e1;">{{ $s->feedback }}</textarea>

                    <button type="submit"
                            style="background:#10b981;color:white;padding:6px 12px;border:none;border-radius:6px;">
                        💾 Save
                    </button>

                </div>
            </form>

        </div>

        @empty
            <p style="color:#94a3b8;">No submissions yet</p>
        @endforelse

    </div>

    @endforeach

</div>
<!-- ================= LIVE CLASSES ================= -->
<div class="section">
    <div class="top">
        <h3>🔴 Live Classes</h3>

        <a href="{{ route('teacher.live.create', $course->id) }}" class="btn">
            + Add
        </a>
    </div>

    @forelse($course->liveClasses as $l)

    <div class="card">

        <!-- TITLE + DELETE -->
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <strong>👉 {{ $l->title }}</strong>

            <!-- DELETE -->
            <form method="POST"
                  action="{{ route('teacher.live.delete', $l->id) }}"
                  onsubmit="return confirm('Delete this live class?')">

                @csrf
                @method('DELETE')

                <button style="background:#ef4444;color:white;padding:4px 10px;border:none;border-radius:6px;">
                    🗑
                </button>
            </form>
        </div>

        <small>{{ $l->date }}</small><br>

        @if($l->link)
            <a href="{{ $l->link }}" target="_blank" class="link">
                🔗 Join Class
            </a>
        @endif

    </div>

    @empty
        <p class="empty">No live classes</p>
    @endforelse
</div>

<!-- ================= RECORDED ================= -->
<div class="section">
    <div class="top">
        <h3>🎥 Recorded Classes</h3>

        <a href="{{ route('teacher.recorded.create', $course->id) }}" class="btn">
            + Add
        </a>
    </div>

    @forelse($course->recordedClasses as $r)

    <div class="card">

        <!-- TITLE + DELETE -->
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <strong>👉 {{ $r->title }}</strong>

            <!-- DELETE -->
            <form method="POST"
                  action="{{ route('teacher.recorded.delete', $r->id) }}"
                  onsubmit="return confirm('Delete this video?')">

                @csrf
                @method('DELETE')

                <button style="background:#ef4444;color:white;padding:4px 10px;border:none;border-radius:6px;">
                    🗑
                </button>
            </form>
        </div>

        @if($r->video_url)
            <a href="{{ $r->video_url }}" target="_blank" class="link">
                ▶ Watch Video
            </a>
        @endif

    </div>

    @empty
        <p class="empty">No recorded classes</p>
    @endforelse
</div>

@endsection