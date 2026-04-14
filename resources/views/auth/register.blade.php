<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | LMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            padding: 30px;
        }

        .title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            color: #4e73df;
        }

        .form-control, .form-select {
            border-radius: 8px;
            height: 45px;
        }

        .btn-register {
            background: #4e73df;
            border: none;
            height: 45px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-register:hover {
            background: #2e59d9;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="col-md-4">
    <div class="card">

        <h3 class="title">📝 Create Account</h3>

        <!-- Error Message -->
        @if(session('success'))
            <div class="alert alert-danger">
                {{ session('success') }}
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label class="form-label">Select Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Choose role</option>
                    <option value="admin">👑 Admin</option>
                    <option value="teacher">👨‍🏫 Teacher</option>
                    <option value="student">🎓 Student</option>
                </select>
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-register w-100">
                🚀 Register
            </button>

        </form>

        <div class="login-link">
            Already have account? 
            <a href="{{ route('login') }}">Login</a>
        </div>

    </div>
</div>

</body>
</html>