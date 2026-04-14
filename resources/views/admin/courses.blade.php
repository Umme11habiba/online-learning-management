@extends('layouts.app')

@section('content')

<style>
    h2 { margin-bottom: 15px; }

    .table-box {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
    }

    th {
        background: #0f172a;
        color: white;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    tr:hover { background: #f1f5f9; }

    .badge {
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        font-size: 12px;
    }

    .pending { background: #f59e0b; }
    .approved { background: #10b981; }
    .rejected { background: #ef4444; }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: white;
        font-size: 12px;
        margin-right: 5px;
    }

    .approve { background: #10b981; }
    .reject { background: #ef4444; }
    .delete { background: #dc2626; }

    .approve:hover { background: #059669; }
    .reject:hover { background: #b91c1c; }
    .delete:hover { background: darkred; }

    .alert {
        background: #10b981;
        color: white;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
</style>

<div class="table-box">

<h2>📚 All Courses</h2>



<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Teacher</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($courses as $course)
    <tr>
        <td>{{ $course->title }}</td>
        <td>{{ $course->description }}</td>
        <td>{{ $course->teacher->name ?? 'N/A' }}</td>

        <!-- Status -->
        <td>
            <span class="badge {{ $course->status }}">
                {{ ucfirst($course->status) }}
            </span>
        </td>

        <!-- Action -->
        <td style="display:flex; gap:5px;">

            @if($course->status == 'pending')

                <!-- ✅ Approve -->
                <form action="{{ route('admin.course.approve', $course->id) }}" method="POST">
                    @csrf
                    <button class="btn approve">Approve</button>
                </form>

                <!-- ❌ Reject (Auto Delete) -->
                <form action="{{ route('admin.course.reject', $course->id) }}" method="POST"
                      onsubmit="return confirm('Reject করলে course delete হবে! নিশ্চিত?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn reject">Reject</button>
                </form>

            @endif

            <!-- 🗑 Delete (Always available) -->
            <form action="{{ route('admin.course.delete', $course->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure to delete this course?')">
                @csrf
                @method('DELETE')
                <button class="btn delete">Delete</button>
            </form>

        </td>
    </tr>
    @endforeach

</table>

</div>

@endsection