@extends('dashboard.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="mb-0">Create New Story</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.stories.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control @error('Author') is-invalid @enderror" id="author" name="Author" value="{{ old('Author') }}" require>
                                @error('Author')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2" required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Content *</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="10" required>{{ old('body') }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="difficulty" class="form-label">Difficulty Level</label>
                                <select class="form-select @error('Difficulty') is-invalid @enderror" id="difficulty" name="Difficulty">
                                    <option value="1" {{ old('Difficulty') == 1 ? 'selected' : '' }}>Easy</option>
                                    <option value="2" {{ old('Difficulty') == 2 ? 'selected' : '' }}>Medium</option>
                                    <option value="3" {{ old('Difficulty') == 3 ? 'selected' : '' }}>Hard</option>
                                </select>
                                @error('Difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                                    <label class="form-check-label" for="is_active">
                                        Publish immediately
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Create Story</button>
                            <a href="{{ route('dashboard.stories') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any text editors or additional functionality here
        // For example, if you want to use TinyMCE or CKEditor for the body field
    });
</script>
@endpush
@endsection
