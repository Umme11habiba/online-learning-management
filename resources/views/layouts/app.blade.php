<!DOCTYPE html>
<html>
<head>
    <title>LMS Panel</title>

    <style>
        * {
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            display:flex;
            background:#f1f5f9;
        }

        /* Sidebar */
        .sidebar {
            width:240px;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color:white;
            height:100vh;
            padding:20px;
            position:fixed;
            transition:0.3s;
        }

        .sidebar h2 {
            text-align:center;
            margin-bottom:30px;
            color:#38bdf8;
        }

        .sidebar a {
            display:block;
            color:#cbd5f5;
            margin:10px 0;
            text-decoration:none;
            padding:10px;
            border-radius:8px;
            transition:0.3s;
        }

        .sidebar a:hover {
            background:#334155;
            color:white;
            transform:translateX(5px);
        }

        .logout-btn {
            margin-top:20px;
            width:100%;
            padding:10px;
            background:#ef4444;
            color:white;
            border:none;
            cursor:pointer;
            border-radius:8px;
            transition:0.3s;
        }

        .logout-btn:hover {
            background:#dc2626;
        }

        /* Main */
        .main {
            margin-left:240px;
            flex:1;
            padding:20px;
        }

        /* Topbar */
        .topbar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:white;
            padding:15px 20px;
            border-radius:12px;
            margin-bottom:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
        }

        .topbar h3 {
            color:#1e293b;
        }

        .role-badge {
            background:#6366f1;
            color:white;
            padding:5px 10px;
            border-radius:6px;
            font-size:12px;
        }

        /* Cards */
        .card {
            background:white;
            padding:20px;
            border-radius:12px;
            margin:10px;
            display:inline-block;
            width:200px;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
            transition:0.3s;
        }

        .card:hover {
            transform:translateY(-5px);
        }

        /* Table */
        table {
            width:100%;
            background:white;
            border-collapse:collapse;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
        }

        th {
            background:#0f172a;
            color:white;
        }

        th, td {
            padding:12px;
        }

        tr:hover {
            background:#f1f5f9;
        }

        /* Success Message */
        .success-msg {
            background:#10b981;
            color:white;
            padding:12px;
            border-radius:10px;
            margin-bottom:15px;
            animation:fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {opacity:0; transform:translateY(-10px);}
            to {opacity:1; transform:translateY(0);}
        }

        /* Toggle Button */
        .toggle-btn {
            display:none;
            position:absolute;
            top:15px;
            left:15px;
            background:#6366f1;
            color:white;
            border:none;
            padding:8px 10px;
            border-radius:6px;
            cursor:pointer;
        }

        /* Mobile */
        @media(max-width:768px){
            .sidebar {
                transform:translateX(-100%);
                position:absolute;
            }

            .sidebar.active {
                transform:translateX(0);
            }

            .main {
                margin-left:0;
            }

            .toggle-btn {
                display:block;
            }
        }
    </style>

</head>
<body>

@php
    $role = auth()->user()->role;
@endphp

<!-- Toggle Button -->
<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">

    <h2>{{ ucfirst($role) }}</h2>

    {{-- ADMIN --}}
    @if($role == 'admin')
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.users') }}">👥 Users</a>
        <a href="{{ route('admin.courses') }}">📚 Courses</a>
    @endif

    {{-- TEACHER --}}
    @if($role == 'teacher')
        <a href="/teacher/dashboard">📊 Dashboard</a>
    @endif

    {{-- STUDENT --}}
    @if($role == 'student')
        <a href="/student/dashboard">📊 Dashboard</a>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">🚪 Logout</button>
    </form>

</div>

<!-- Main -->
<div class="main">

    <!-- Topbar -->
    <div class="topbar">
        <h3>Welcome, {{ auth()->user()->name }}</h3>
        <span class="role-badge">{{ ucfirst($role) }}</span>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div id="successMsg" class="success-msg">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('successMsg').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <!-- Content -->
    @yield('content')

</div>

<script>
    function toggleSidebar(){
        document.getElementById('sidebar').classList.toggle('active');
    }
</script>

</body>
</html>