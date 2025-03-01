<x-layout>
    <div class="container mt-5">
        <h1 class="text-center fw-bold text-primary mb-4">Stories</h1>

        <div class="row">
            @foreach ($stories as $story)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 transition-hover">
                    <div class="card-body d-flex flex-column">
                        <!-- Story Title -->
                        <h5 class="card-title fw-bold text-dark">{{ $story->title }}</h5>

                        <!-- Author -->
                        <p class="text-muted mb-2">
                            <i class="bi bi-person-circle"></i>
                            By <span class="fw-bold">{{ $story->user->name }}</span>
                        </p>

                        <!-- Story Statistics -->
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <p class="mb-0 text-secondary">
                                <i class="bi bi-hand-thumbs-up-fill text-success fs-5"></i>
                                <span class="fw-bold">{{ $story->story_like->where('like', '1')->count() }}</span> Likes

                                <i class="bi bi-hand-thumbs-down-fill text-danger fs-5 ms-3"></i>
                                <span class="fw-bold">{{ $story->story_like->where('like', '-1')->count() }}</span> Dislikes
                            </p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0 text-secondary">
                                <i class="bi bi-eye-fill text-dark fs-5"></i>
                                <span class="fw-bold">{{ $story->views }}</span> Views
                            </p>
                            <p class="mb-0 text-secondary">
                                <i class="bi bi-chat-left-text text-primary fs-5"></i>
                                <span class="fw-bold">{{ $story->story_Comment->count() }}</span> Comments
                            </p>
                        </div>

                        <!-- Read More Button -->
                        <a href="/stories/{{ $story->id }}" class="btn btn-primary mt-3 w-100">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $stories->links() }}
        </div>
    </div>

    <!-- CSS for Hover Effect -->
    <style>
        .transition-hover {
            transition: transform 0.3s ease-in-out;
        }

        .transition-hover:hover {
            transform: scale(1.05);
        }
    </style>
</x-layout>
