@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        font-family: Arial;
    }

    .form-wrapper {
        display:flex;
        justify-content:center;
        align-items:center;
        height:85vh;
    }

    .form-card {
        width:400px;
        padding:30px;
        border-radius:16px;
        background:rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        box-shadow:0 10px 30px rgba(0,0,0,0.2);
        color:white;
        animation:fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {opacity:0; transform:translateY(20px);}
        to {opacity:1; transform:translateY(0);}
    }

    .form-card h2 {
        text-align:center;
        margin-bottom:20px;
    }

    .form-group {
        margin-bottom:15px;
    }

    label {
        font-size:14px;
        margin-bottom:5px;
        display:block;
    }

    input, select {
        width:100%;
        padding:10px;
        border-radius:8px;
        border:none;
        outline:none;
        margin-top:5px;
        background:rgba(255,255,255,0.9);
        color:#0f172a;
        transition:0.3s;
    }

    input:focus, select:focus {
        box-shadow:0 0 8px rgba(255,255,255,0.8);
    }

    .btn {
        width:100%;
        padding:10px;
        border:none;
        border-radius:8px;
        background:#10b981;
        color:white;
        font-size:15px;
        cursor:pointer;
        transition:0.3s;
    }

    .btn:hover {
        background:#059669;
        transform:scale(1.03);
    }

    .back {
        display:block;
        text-align:center;
        margin-top:12px;
        color:white;
        text-decoration:none;
        font-size:14px;
        opacity:0.8;
    }

    .back:hover {
        opacity:1;
    }

    .icon {
        text-align:center;
        font-size:30px;
        margin-bottom:10px;
    }
</style>

<div class="form-wrapper">

    <div class="form-card">

        <div class="icon">👤</div>

        <h2>Create User</h2>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">👑 Admin</option>
                    <option value="teacher">👨‍🏫 Teacher</option>
                    <option value="student">🎓 Student</option>
                </select>
            </div>

            <button type="submit" class="btn">
                🚀 Create User
            </button>

        </form>

        <a href="{{ route('admin.users') }}" class="back">
            ← Back to Users
        </a>

    </div>

</div>

@endsection