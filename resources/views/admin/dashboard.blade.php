@extends('layouts.app')

@section('content')

<style>
    .dashboard-title {
        margin-bottom: 20px;
    }

    .cards {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        min-width: 200px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .card h3 {
        margin: 0;
        font-size: 18px;
        color: #64748b;
    }

    .card p {
        font-size: 28px;
        font-weight: bold;
        margin-top: 10px;
        color: #0f172a;
    }

    /* Color accents */
    .card.users { border-left: 5px solid #3b82f6; }
    .card.teachers { border-left: 5px solid #10b981; }
    .card.students { border-left: 5px solid #f59e0b; }
    .card.courses { border-left: 5px solid #ef4444; }

    /* Hover glow */
    .card::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.05);
        top: 0;
        left: 0;
        opacity: 0;
        transition: 0.3s;
    }

    .card:hover::after {
        opacity: 1;
    }
</style>

<h1 class="dashboard-title">🚀 Admin Dashboard</h1>

<div class="cards">

    <div class="card users">
        <h3>👥 Total Users</h3>
        <p>{{ $totalUsers }}</p>
    </div>

    <div class="card teachers">
        <h3>👨‍🏫 Teachers</h3>
        <p>{{ $totalTeachers }}</p>
    </div>

    <div class="card students">
        <h3>🎓 Students</h3>
        <p>{{ $totalStudents }}</p>
    </div>

    <div class="card courses">
        <h3>📚 Courses</h3>
        <p>{{ $totalCourses }}</p>
    </div>

</div>

@endsection