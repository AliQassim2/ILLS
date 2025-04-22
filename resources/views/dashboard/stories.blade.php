@php
$difficultyLevels = [
1 => 'Easy',
2 => 'Medium',
3 => 'Hard',
];
@endphp

@extends('dashboard.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Story Management</h2>
        <a href="{{ route('dashboard.stories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Story
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5 class="mb-0">All Stories</h5>
                </div>
                <div class="d-flex col-md-8 justify-content-between">

                    <form action="">
                        <div class="">
                            <select name="status" class="form-select" onchange="this.form.submit()" aria-label="Sort options">
                                <option value="all">All Status</option>
                                <option value="active" {{ request('status')=='active'? 'selected':'' }}>Active</option>
                                <option value="inactive" {{ request('status')=='inactive'? 'selected':'' }}>Inactive</option>
                            </select>
                        </div>
                    </form>
                    <form action="">
                        <div class="">
                            <select name="suggested" class="form-select" onchange="this.form.submit()" aria-label="Sort suggested">
                                <option value="all">All suggested</option>
                                <option value="Featured" {{ request('suggested')=='Featured'? 'selected':'' }}>Featured</option>
                                <option value="Regular" {{ request('suggested')=='Regular'? 'selected':'' }}>Regular</option>
                            </select>
                        </div>
                    </form>
                    <form method="GET" action="{{ route('dashboard.stories') }}" class="row g-2">
                        <div class="col-sm-8">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title or author">
                        </div>
                        <div class="col-sm-1 d-grid">
                            <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-filter">Search</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            @if (Auth::user()->role == 0)
                            <th>Publisher</th>
                            @endif
                            <th class="text-center">Status</th>
                            <th class="text-center">Suggested</th>
                            <th class="text-center">Views</th>
                            <th>Created At</th>
                            <th>Difficulty</th>
                            <th class="text-center">Actions</th>
                            <th>Questions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stories as $story)
                        <tr>
                            <td class="fw-medium">{{ $story->title }}</td>
                            @if (Auth::user()->role == 0)
                            <td>{{ $story->user->name }}</td>
                            @endif
                            <td>{{ $story->Author }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-{{ $story->is_active ? 'success' : 'danger' }}">
                                    {{ $story->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-{{ $story->suggested ? 'info' : 'secondary' }}">
                                    {{ $story->suggested ? 'Featured' : 'Regular' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <i class="fas fa-eye text-muted me-1"></i>{{ number_format($story->views) }}
                            </td>
                            <td>{{ $story->created_at->format('M d, Y') }}</td>
                            <td>{{ $difficultyLevels[$story->Difficulty] }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('dashboard.stories.edit', $story->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <!-- Toggle Status Form -->
                                    <form action="{{ route('dashboard.stories.toggle-status', $story->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $story->is_active ? 'btn-outline-secondary' : 'btn-outline-success' }}"
                                            onclick="return confirm('Are you sure you want to {{ $story->is_active ? 'disable' : 'enable' }} this story?')">
                                            <i class="fas fa-{{ $story->is_active ? 'eye-slash' : 'eye' }} me-1"></i>
                                            {{ $story->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>

                                    @if (Auth::user()->role == 0)
                                    <!-- Suggested/Featured Form -->
                                    <form action="{{ route('dashboard.stories.suggested', $story->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $story->suggested ? 'btn-outline-warning' : 'btn-outline-info' }}"
                                            onclick="return confirm('Are you sure you want to {{ $story->suggested ? 'unfeature' : 'feature' }} this story?')">
                                            <i class="fas fa-{{ $story->suggested ? 'star-half-alt' : 'star' }} me-1"></i>
                                            {{ $story->suggested ? 'Unfeature' : 'Feature' }}
                                        </button>
                                    </form>
                                    @endif
                                    <!-- Reset Score Form -->
                                    <form action="{{ route('dashboard.stories.reset-score', $story->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-warning"
                                            onclick="return confirm('Are you sure you want to reset all scores? This will permanently delete all user progress for this story!')">
                                            <i class="fas fa-redo-alt me-1"></i> Reset Score
                                        </button>
                                    </form>
                                    @if (Auth::user()->role == 0)
                                    <!-- Delete Form -->
                                    <form action="{{ route('dashboard.stories.delete', $story->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('WARNING: Are you sure you want to delete this story? ALL related data will be permanently removed!')">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.stories.questions.index', $story->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-question-circle">View Questions</i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-book fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-2">No stories found</p>
                                    <a href="{{ route('dashboard.stories.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus me-1"></i> Add New Story
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-center">
                {{ $stories->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.delete-confirm').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this story? This action cannot be undone.')) {
                    btn.closest('form').submit();
                }
            });
        });

        document.querySelectorAll('.reset-score-confirm').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                if (confirm('Are you sure you want to reset all scores for this story? This will set all user progress and scores to zero.')) {
                    btn.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection
