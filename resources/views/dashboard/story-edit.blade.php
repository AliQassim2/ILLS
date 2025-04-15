@extends('dashboard.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="mb-0">Edit Story</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.stories.update', $story->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                    value="{{ old('title', $story->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control @error('Author') is-invalid @enderror" id="author" name="Author"
                                    value="{{ old('Author', $story->Author) }}" required>
                                @error('Author')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="2" required>{{ old('description', $story->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Content *</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body"
                                rows="10" required>{{ old('body', $story->body) }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="difficulty" class="form-label">Difficulty Level</label>
                                <select class="form-select @error('Difficulty') is-invalid @enderror" id="difficulty" name="Difficulty">
                                    <option value="1" {{ old('Difficulty', $story->Difficulty) == 1 ? 'selected' : '' }}>Easy</option>
                                    <option value="2" {{ old('Difficulty', $story->Difficulty) == 2 ? 'selected' : '' }}>Medium</option>
                                    <option value="3" {{ old('Difficulty', $story->Difficulty) == 3 ? 'selected' : '' }}>Hard</option>
                                </select>
                                @error('Difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Edit Story</button>
                            <a href="{{ route('dashboard.stories') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
