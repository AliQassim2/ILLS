@extends('dashboard.layout')

@section('content')
<h3>User Management</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

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
            <td>
                @if ($user->role == 2)
                Publisher
                @else
                User
                @endif
            </td>
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
    {{ $users->links() }}
</div>
@endsection