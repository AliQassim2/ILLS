<x-layout>
    <div class="container mt-5">
        <h2 class="text-center fw-bold text-primary mb-4">Comments</h2>

        <!-- Add Comment Form -->
        @auth
        @foreach ($errors->all() as $error)
        <div>{{$error}}</div>
        @endforeach
        <div class="card shadow-sm p-4 mb-4 rounded-4">
            <h5 class="fw-semibold">Leave a Comment</h5>
            <form action="{{ url('story/' . request()->route('id')) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>
        @else
        <p class="text-center text-muted">
            You must <a href="{{ route('login', ['redirect' => request()->fullUrl()]) }}">log in</a> to post a comment.
        </p>
        @endauth

        <!-- Comments Section -->
        <div class="card shadow-lg p-4 rounded-4">
            @if ($comments->count() > 0)
            @foreach ($comments as $comment)
            <div class="d-flex align-items-start border-bottom py-3">
                <div>
                    <h6 class="mb-1 fw-semibold">{{ $comment->user->name }}</h6>
                    <p class="text-muted small">{{ $comment->created_at->diffForHumans() }}</p>
                    <p class="text-dark">{{ $comment->body }}</p>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-center text-muted">No comments yet. Be the first to comment!</p>
            @endif
        </div>
    </div>
</x-layout>