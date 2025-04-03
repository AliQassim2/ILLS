<x-layout>
    <section>
        <h1 class="text-center mt-5">Hello, {{ $user->name }}</h1>
        <h2 class="fs-4 mt-4">Read these suggested stories:</h2>

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
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0 text-secondary">
                                        <i class="bi bi-hand-thumbs-up-fill text-success fs-5"></i>
                                        <span class="fw-bold">{{ $story->story_like->where('like', 1)->count() }}</span> Likes

                                        <i class="bi bi-hand-thumbs-down-fill text-danger fs-5 ms-3"></i>
                                        <span class="fw-bold">{{ $story->story_like->where('like', -1)->count() }}</span> Dislikes
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <p class="mb-0 text-secondary">
                                        <i class="bi bi-eye-fill text-dark fs-5"></i>
                                        <span class="fw-bold">{{ $story->views }}</span> Views
                                    </p>
                                    <p class="mb-0 text-secondary">
                                        <i class="bi bi-chat-left-text text-primary fs-5"></i>
                                        <span class="fw-bold">{{ $story->story_Comment->count() }}</span> Comments
                                    </p>
                                </div>
                            </div>

                            <!-- Read More Button -->
                            <a href="/stories/{{ $story->id }}" class="btn btn-primary mt-3 w-100">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <script>document.title = "Home";</script>
</x-layout>

