@extends('dashboard.layout')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">Create New Question for: {{ $story->title }}</h4>

            <form action="{{ route('dashboard.stories.questions.store', $story->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <input type="text" class="form-control" id="question" name="question" required>
                </div>

                <div class="mb-3">
                    <label for="correct_answer" class="form-label">Correct Answer</label>
                    <input type="text" class="form-control" id="correct_answer" name="correct_answer" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Other Answers</label>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="answer1" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="answer2" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="answer3" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard.stories.questions.index', $story->id) }}"
                        class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection