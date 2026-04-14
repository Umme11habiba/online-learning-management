@extends('layouts.app')

@section('content')

<style>
    .header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .header h2 {
        color:#0f172a;
    }

    .add-btn {
        background:#3b82f6;
        color:white;
        padding:8px 14px;
        border-radius:8px;
        text-decoration:none;
        font-size:14px;
        transition:0.3s;
    }

    .add-btn:hover {
        background:#2563eb;
    }

    .table-container {
        background:white;
        border-radius:14px;
        padding:15px;
        box-shadow:0 8px 20px rgba(0,0,0,0.08);
    }

    table {
        width:100%;
        border-collapse:collapse;
    }

    th {
        background:#f1f5f9;
        color:#334155;
        text-align:left;
        padding:12px;
        font-size:14px;
    }

    td {
        padding:12px;
        border-bottom:1px solid #e2e8f0;
    }

    tr:hover {
        background:#f8fafc;
    }

    .role {
        padding:4px 10px;
        border-radius:6px;
        font-size:12px;
        font-weight:600;
    }

    .admin {
        background:#fee2e2;
        color:#b91c1c;
    }

    .teacher {
        background:#dbeafe;
        color:#1d4ed8;
    }

    .student {
        background:#dcfce7;
        color:#166534;
    }

    .delete-btn {
        background:#ef4444;
        color:white;
        padding:6px 10px;
        border:none;
        border-radius:6px;
        cursor:pointer;
        transition:0.3s;
    }

    .delete-btn:hover {
        background:#dc2626;
    }

    .empty {
        text-align:center;
        padding:20px;
        color:#94a3b8;
    }
</style>

<!-- 🔷 HEADER -->
<div class="header">
    <h2>👥 All Users</h2>

    <a href="{{ route('admin.users.create') }}" class="add-btn">
        + Add User
    </a>
</div>

<!-- 📊 TABLE -->
<div class="table-container">

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

        @forelse($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <!-- ROLE BADGE -->
            <td>
                <span class="role {{ $user->role }}">
                    {{ ucfirst($user->role) }}
                </span>
            </td>

            <!-- DELETE -->
            <td>
                <form method="POST"
                      action="{{ route('admin.users.delete', $user->id) }}"
                      onsubmit="return confirm('Delete this user?')">

                    @csrf
                    @method('DELETE')

                    <button class="delete-btn">
                        🗑 Delete
                    </button>
                </form>
            </td>
        </tr>

        @empty
            <tr>
                <td colspan="4" class="empty">
                    No users found
                </td>
            </tr>
        @endforelse

    </table>

</div>

@endsection