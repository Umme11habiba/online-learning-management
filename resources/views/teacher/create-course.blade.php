@extends('layouts.app')

@section('content')

<style>
    .form-box {
        background:white;
        padding:25px;
        border-radius:12px;
        max-width:500px;
        box-shadow:0 5px 15px rgba(0,0,0,0.1);
    }

    input, textarea {
        width:100%;
        padding:10px;
        margin-bottom:15px;
        border:1px solid #ddd;
        border-radius:6px;
    }

    button {
        background:#0ea5e9;
        color:white;
        padding:10px;
        border:none;
        border-radius:6px;
        width:100%;
    }

    button:hover {
        background:#0284c7;
    }
</style>

<h2>📚 Create Course</h2>

<div class="form-box">

<form method="POST" action="{{ route('teacher.course.store') }}">
    @csrf

    <input type="text" name="title" placeholder="Course Title" required>

    <textarea name="description" placeholder="Course Description" ></textarea>

    <button type="submit">Create Course</button>
</form>

</div>

@endsection