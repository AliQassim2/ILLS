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
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">All Stories</h5>
                </div>
                <div class="col-md-6">
                    <!-- You could add search/filter functionality here -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Publisher</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Suggested</th>
                            <th class="text-center">Views</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                            <th>Questions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stories as $story)
                        <tr>
                            <td class="fw-medium">{{ $story->title }}</td>
                            <td>{{ $story->user->name }}</td>
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
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-eye text-muted me-1"></i>
                                    <span>{{ number_format($story->views) }}</span>
                                </div>
                            </td>
                            <td>{{ $story->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('dashboard.stories.edit', $story->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('dashboard.stories.toggle-status', $story->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $story->is_active ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                            <i class="fas fa-{{ $story->is_active ? 'eye-slash' : 'eye' }} me-1"></i>
                                            {{ $story->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                    @if (Auth::user()->role == 0)
                                    <form action="{{ route('dashboard.stories.suggested', $story->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $story->suggested ? 'btn-outline-warning' : 'btn-outline-info' }}">
                                            <i class="fas fa-{{ $story->suggested ? 'star-half-alt' : 'star' }} me-1"></i>
                                            {{ $story->suggested ? 'Unfeature' : 'Feature' }}
                                        </button>
                                    </form>

                                    <!-- Direct delete form with confirmation in JS -->
                                    <form action="{{ route('dashboard.stories.delete', $story->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger delete-confirm">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.stories.questions.index', $story->id) }}"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-question-circle me-1"></i> View Questions
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-book fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-2">No stories found</p>
                                    <a href="{{ route('dashboard.stories.create') }}" class="btn btn-sm btn-primary mt-2">
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
                {{ $stories->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Direct event listener for delete buttons
        const deleteButtons = document.querySelectorAll('.delete-confirm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Stop the default form submission

                if (confirm('Are you sure you want to delete this story? This action cannot be undone.')) {
                    // If confirmed, submit the form
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endpush
@endsection
