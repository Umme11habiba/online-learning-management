<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | LMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .login-title {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
            color: #4f46e5;
        }

        .form-control, .form-select {
            height: 45px;
            border-radius: 8px;
        }

        .btn-login {
            background: #4f46e5;
            border: none;
            height: 45px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #4338ca;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="login-card">

    <h3 class="login-title">🔐 LMS Login</h3>

    <!-- Success -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Error -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label>Select Role</label>
            <select name="role" class="form-select" required>
                <option value="">Choose role</option>
                <option value="admin">👑 Admin</option>
                <option value="teacher">👨‍🏫 Teacher</option>
                <option value="student">🎓 Student</option>
            </select>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-login w-100">
            🚀 Login
        </button>
    </form>

    <div class="register-link">
        Don't have account? 
        <a href="{{ route('register') }}">Create account</a>
    </div>

</div>

</body>
</html>