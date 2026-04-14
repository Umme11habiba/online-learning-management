<!DOCTYPE html>
<html>
<head>
    <title>LMS System</title>

    <style>
        * {
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background:#f8fafc;
        }

        /* Navbar */
        .navbar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:15px 40px;
            background:white;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
            position:sticky;
            top:0;
            z-index:100;
        }

        .navbar h2 {
            color:#6366f1;
        }

        .navbar a {
            text-decoration:none;
            margin-left:20px;
            color:#334155;
            font-weight:500;
            transition:0.3s;
        }

        .navbar a:hover {
            color:#6366f1;
        }

        .btn-primary {
            background:#6366f1;
            color:white !important;
            padding:8px 14px;
            border-radius:6px;
        }

        /* Hero */
        .hero {
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:80px 60px;
            background:linear-gradient(135deg, #6366f1, #0ea5e9);
            color:white;
        }

        .hero-text {
            max-width:500px;
        }

        .hero h1 {
            font-size:42px;
            margin-bottom:15px;
        }

        .hero p {
            font-size:18px;
            margin-bottom:20px;
        }

        .btn {
            display:inline-block;
            padding:12px 20px;
            background:white;
            color:#6366f1;
            border-radius:8px;
            text-decoration:none;
            font-weight:bold;
            transition:0.3s;
        }

        .btn:hover {
            background:#e0e7ff;
        }

        .hero img {
            width:350px;
        }

        /* Features */
        .features {
            padding:60px 20px;
            text-align:center;
        }

        .features h2 {
            margin-bottom:30px;
            color:#1e293b;
        }

        .feature-grid {
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            gap:20px;
        }

        .feature-box {
            width:260px;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
            transition:0.3s;
        }

        .feature-box:hover {
            transform:translateY(-8px);
        }

        .feature-box h3 {
            margin-bottom:10px;
            color:#6366f1;
        }

        /* CTA Section */
        .cta {
            background:#6366f1;
            color:white;
            text-align:center;
            padding:50px 20px;
        }

        .cta a {
            background:white;
            color:#6366f1;
            padding:10px 18px;
            border-radius:6px;
            text-decoration:none;
            margin-top:15px;
            display:inline-block;
        }

        /* Footer */
        .footer {
            background:#0f172a;
            color:white;
            text-align:center;
            padding:20px;
        }

        /* Responsive */
        @media(max-width:768px){
            .hero {
                flex-direction:column;
                text-align:center;
            }

            .hero img {
                margin-top:20px;
                width:250px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <h2>🎓 online learning System</h2>

    <div>
        <a href="/login">Login</a>
        <a href="/register" class="btn-primary">Register</a>
    </div>
</div>

<!-- Hero -->
<div class="hero">

    <div class="hero-text">
        <h1>Learn Smarter with online learning System 🚀</h1>
        <p>Manage courses, assignments, live classes and track progress easily in one platform.</p>

        <a href="/register" class="btn">Get Started</a>
    </div>

    <!-- Optional Image -->
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png">
</div>

<!-- Features -->
<div class="features">
    <h2>✨ Powerful Features</h2>

    <div class="feature-grid">

        <div class="feature-box">
            <h3>📚 Courses</h3>
            <p>Create and manage courses easily</p>
        </div>

        <div class="feature-box">
            <h3>🎥 Live Classes</h3>
            <p>Join and schedule live sessions</p>
        </div>

        <div class="feature-box">
            <h3>📝 Assignments</h3>
            <p>Submit and track assignments</p>
        </div>

        

    </div>
</div>


<!-- Footer -->
<div class="footer">
    <p>© {{ date('Y') }} LMS System | All Rights Reserved</p>
</div>

</body>
</html>