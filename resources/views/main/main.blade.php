@guest
<x-layout>
    <section class="d-flex justify-content-center flex-md-row flex-column-reverse align-items-center">
                <div >
                    <img class="img-fluid hero-image girl" src="imges/guy.png" alt="student">
                </div>
                <div class="col-lg-6 order-lg-1 intro-container">
                    <div class="intro d-flex flex-column justify-content-center align-items-center">
                        <img src="imges/istockphoto-1369748264-612x612 1.png" alt="s" class="light">
                        <h1 class="fs-1 mb-4">Do You Want To Improve <br>
                            Your Second Language?</h1>
                        <p class="lead text-center mb-4">Join our community of language learners and enhance your skills through interactive stories.</p>
                        <a href="login" class="cta-button">Register Now!</a>
                    </div>
                </div>

    </section>
    <script>
        document.title = "Home | Language Learning Platform";
    </script>
</x-layout>
@endguest

@auth
<x-layout>
    <section class="py-5">
        <div class="container">
            <!-- Welcome Banner -->
            <div class="welcome-banner mb-5">
                <div class=" user-wel bg-light px-4 py-3 d-flex flex-md-row flex-column align-items-center justify-content-center shadow">
                    <div class="col-md-8">
                        <h1 class="fs-2 mb-2">Welcome back, <span class="fw-bold text-accent">{{ Auth::user()->name }}</span>!</h1>
                        <p class="lead mb-0 text-center">Continue your language learning journey with these featured stories.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="/stories" class="btn">Browse All Stories</a>
                    </div>
                </div>
            </div>

            <!-- Featured Stories Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fs-3 fw-bold">
                    <i class="bi bi-stars me-2"></i>Featured Stories
                </h2>
            </div>

            <!-- Stories Grid -->
            <div class="row g-4">
                @forelse ($stories as $story)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="story-card h-100">
                        <!-- Card Header with Difficulty Badge -->
                        <div class="card-header position-relative">
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="difficulty-badge difficulty-{{ $story->Difficulty }}">
                                    {{ $story->Difficulty == 1 ? 'Beginner' : ($story->Difficulty == 2 ? 'Intermediate' : 'Advanced') }}
                                </span>
                            </div>
                            <div class="card-icon">
                                <i class="bi bi-book"></i>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <!-- Story Title -->
                            <h5 class="card-title fw-bold mb-2">{{ $story->title }}</h5>

                            <!-- Story Description (truncated) -->
                            <p class="card-text mb-3">{{ \Illuminate\Support\Str::limit($story->description, 80) }}</p>

                            <!-- Author -->
                            <p class="author-info mb-3">
                                <i class="bi bi-person-circle me-1"></i>
                                By <span class="fw-bold">{{ $story->user->name }}</span>
                            </p>

                            <!-- Story Statistics -->
                            <div class="story-stats mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="stat-item">
                                        <i class="bi bi-hand-thumbs-up-fill"></i>
                                        <span class="fw-bold">{{ $story->story_like->where('like', 1)->count() }}</span>
                                    </div>
                                    <div class="stat-item">
                                        <i class="bi bi-eye-fill me-1"></i>
                                        <span>{{ $story->views }}</span>
                                    </div>
                                    <div class="stat-item">
                                        <i class="bi bi-chat-left-text me-1"></i>
                                        <span>{{ $story->story_Comment->count() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Read More Button -->
                            <a href="/stories/{{ $story->id }}" class="btn mt-3 w-100">
                                <i class="bi bi-book-half me-1"></i> Read Now
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <h3 class="mt-3 mb-2">No Featured Stories Available</h3>
                        <p class="text-muted">Check back soon or explore our complete collection of stories.</p>
                        <a href="/stories" class="btn mt-2">Browse All Stories</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $stories->links() }}
            </div>

            <!-- Quick Stats Section -->
            <div class="row  g-4 ml-2">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex align-items-center justify-content-md-center justify-content-start my-2">
                            <div class="stats-icon bg-mint">
                                <i class="shadow-sm icon-main bi bi-book"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ \App\Models\stories::where('is_active', true)->count() }} Total Stories</h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 justify-content-center">
                    <div class="stats-card">
                        <div class="d-flex align-items-center justify-content-md-center justify-content-start my-2">
                            <div class="stats-icon bg-green">
                                <i class="shadow-sm icon-main  bi bi-people"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ \App\Models\User::where('role', 1)->count() }} Community Members</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex align-items-center jjustify-content-md-center justify-content-start my-2">
                            <div class="stats-icon bg-light-green">
                                <i class="shadow-sm small-shadow icon-main  bi bi-journal-check"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ $reading }} Stories You've Read</h5>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.title = "Home | Language Learning Platform";
    </script>
</x-layout>
@endauth
