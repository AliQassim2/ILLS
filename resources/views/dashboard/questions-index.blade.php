@extends('dashboard.layout')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">{{ $story->questions->count() }} Questions</h2>
        <div>
            <a href="{{ route('dashboard.stories.questions.create', $story->id) }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add New Question
            </a>
            <a href="{{ route('dashboard.stories') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Stories
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Question</th>
                            <th>Correct Answer</th>
                            <th>Other Choices</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($story->questions as $question)
                        <tr>
                            <td class="ps-4">{{ $question->question }}</td>
                            <td>
                                <span class="text-success">{{ $question->correct_answer }}</span>
                            </td>
                            <td>
                                <div class="text-muted">
                                    <div>{{ $question->answer1 }}</div>
                                    <div>{{ $question->answer2 }}</div>
                                    <div>{{ $question->answer3 }}</div>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('dashboard.questions.edit', $question->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit me-1">Edit</i>
                                </a>

                                <form action="{{ route('dashboard.questions.delete', $question->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger delete-btn">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                No questions found. Click "Add New Question" to create one.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete confirmation
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this question?')) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endpush
@endsection