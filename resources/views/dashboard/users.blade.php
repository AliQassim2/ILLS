@extends('dashboard.layout')

@section('content')
<h3>User Management</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Filter/Search UI -->
<div class="row align-items-center mb-3">
    <div class="col-md-4">
        <h5 class="mb-0">All Users</h5>
    </div>
    <div class="col-md-8">
        <form method="GET" class="row g-2">
            <!-- Role Filter -->
            <div class="col-sm-3">
                <select name="role" class="form-select" onchange="this.form.submit()">
                    <option value="all">All Roles</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="publisher" {{ request('role') == 'publisher' ? 'selected' : '' }}>Publisher</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="verify" class="form-select" onchange="this.form.submit()">
                    <option value="all">All</option>
                    <option value="Verified" {{ request('verify') == 'Verified' ? 'selected' : '' }}>Verified</option>
                    <option value="Unverified" {{ request('verify') == 'Unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>

            <!-- Ban Status Filter -->
            <div class="col-sm-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="all">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                    <option value="full_banned" {{ request('status') == 'full_banned' ? 'selected' : '' }}>Full Ban</option>
                </select>
            </div>

            <!-- Search -->
            <div class="col-sm-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or email">
            </div>

            <div class="col-sm-2 d-grid">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fas fa-filter"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- User Table -->
<table class="table table-bordered mt-4">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Verification</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role == 2 ? 'Publisher' : 'User' }}</td>
            <td>
                @if ($user->is_banned == 1)
                <span class="badge bg-danger">Banned</span>
                @elseif ($user->is_banned == 2)
                <span class="badge bg-danger">Full Ban</span>
                @else
                <span class="badge bg-success">Active</span>
                @endif
            </td>
            <td>
                @if ($user->email_verified_at)
                <span class="badge bg-success">Verified</span>
                @else
                <span class="badge bg-warning">Unverified</span>
                @endif
            </td>
            <td>
                <!-- Role Change Button -->
                @if ($user->role != 2)
                <form action="{{ route('dashboard.users.upgrade', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-warning">Make Publisher</button>
                </form>
                @else
                <form action="{{ route('dashboard.users.downgrade', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-secondary">Make User</button>
                </form>
                @endif

                <!-- Regular Ban/Unban Button -->
                <form action="{{ route('dashboard.users.ban', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm {{ $user->is_banned == 1 ? 'btn-success' : 'btn-danger' }}"
                        onclick="return confirm('Are you sure you want to {{ $user->is_banned == 1 ? 'unban' : 'ban' }} this user?')">
                        {{ $user->is_banned == 1 ? 'Unban' : 'Ban' }}
                    </button>
                </form>

                <!-- Full Ban/Unban Button -->
                <form action="{{ route('dashboard.users.fullban', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm {{ $user->is_banned == 2 ? 'btn-success' : 'btn-danger' }}"
                        onclick="return confirm('Are you sure you want to {{ $user->is_banned == 2 ? 'remove full ban' : 'apply full ban' }} for this user?')">
                        {{ $user->is_banned == 2 ? 'Remove Full Ban' : 'Full Ban' }}
                    </button>
                </form>

                <!-- Delete User Button -->
                <form action="{{ route('dashboard.users.delete', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    {{ $users->withQueryString()->links() }}
</div>
@endsection
