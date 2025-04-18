<x-layout>
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-4">Explore Stories</h2>

        <div class="row g-4 mb-5">
            <!-- Search and Filter Section -->
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <!-- Search Form -->
                            <div class="col-md-7">
                                <form method="get">
                                    <div class="input-group">
                                        <input
                                            type="search"
                                            name="search"
                                            id="searchInput"
                                            class="form-control form-control-lg border-end-0"
                                            placeholder="Search stories..."
                                            value="{{ request('search') }}"
                                            autocomplete="off"
                                            aria-label="Search input">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-search me-1"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Sort Dropdown -->
                            <div class="col-md-5">
                                <form method="get">
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-sort-amount-down-alt"></i>
                                        </span>
                                        <select name="status" class="form-select form-select-lg" onchange="this.form.submit()" aria-label="Sort options">
                                            <option hidden>Sort stories by</option>
                                            <option value="Rating" {{ request('status') == 'Rating' ? 'selected' : '' }}>Highest Rating</option>
                                            <option value="Most Viewed" {{ request('status') == 'Most Viewed' ? 'selected' : '' }}>Most Viewed</option>
                                            <option value="Newest" {{ request('status') == 'Newest' ? 'selected' : '' }}>Newest First</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stories Grid -->
        <div class="row g-4">
            @forelse ($stories as $story)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 story-card">
                    <!-- Completion Badge (Top Right) -->
                    @if (auth()->check() && \App\Models\result::where('user_id', auth()->id())->where('stories_id', $story->id)->exists())
                    <div class="completion-badge-container">
                        <div class="completion-badge" data-bs-toggle="tooltip" data-bs-placement="top" title="You've completed this story">
                            <i class="bi bi-check-circle-fill"></i>
                            @php
                            $userResult = \App\Models\result::where('user_id', auth()->id())->where('stories_id', $story->id)->first();
                            $score = $userResult ? $userResult->score : 0;
                            @endphp
                            <span class="completion-score">{{ $score }}%</span>
                        </div>
                    </div>
                    @endif

                    <div class="card-body d-flex flex-column p-4">
                        <!-- Difficulty Badge -->
                        <div class="mb-2">
                            @if ($story->Difficulty == 1)
                            <span class="badge bg-success rounded-pill px-3 py-2">Easy</span>
                            @elseif ($story->Difficulty == 2)
                            <span class="badge bg-warning rounded-pill px-3 py-2">Medium</span>
                            @elseif ($story->Difficulty == 3)
                            <span class="badge bg-danger rounded-pill px-3 py-2">Hard</span>
                            @else
                            <span class="badge bg-secondary rounded-pill px-3 py-2">Unknown</span>
                            @endif
                        </div>

                        <!-- Story Title -->
                        <h4 class="card-title fw-bold text-dark mb-2">{{ $story->title }}</h4>

                        <!-- Story Description -->
                        <p class="card-text text-muted mb-3">{{ Str::limit($story->description, 100) }}</p>

                        <!-- Author Info -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar-circle bg-primary text-white me-2">
                                <span>{{ substr($story->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="mb-0 small text-muted">Published by</p>
                                <p class="fw-bold mb-0">{{ $story->user->name }}</p>
                            </div>
                        </div>

                        <!-- Author Name -->
                        @if($story->Author)
                        <div class="mb-3">
                            <p class="mb-0 small text-muted">Story by</p>
                            <p class="fw-bold">{{ $story->Author }}</p>
                        </div>
                        @endif

                        <!-- Stats Row -->
                        <div class="story-stats mt-auto">
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-eye-fill text-primary me-2"></i>
                                        <span class="fw-bold">{{ number_format($story->views) }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-chat-left-text text-success me-2"></i>
                                        <span class="fw-bold">{{ $story->story_Comment->count() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Likes/Dislikes -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3 d-flex align-items-center">
                                    <i class="bi bi-hand-thumbs-up-fill text-success me-1"></i>
                                    <span class="fw-bold">{{ $story->story_like->where('like', '1')->count() }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-hand-thumbs-down-fill text-danger me-1"></i>
                                    <span class="fw-bold">{{ $story->story_like->where('like', '-1')->count() }}</span>
                                </div>
                            </div>

                            <!-- Read More Button -->
                            <a href="/stories/{{ $story->id }}" class="btn btn-primary w-100">
                                <i class="bi bi-book me-2"></i> Read Story
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-book fs-1 text-muted mb-3 d-block"></i>
                    <h4>No stories found</h4>
                    <p class="text-muted">Try adjusting your search or filter criteria</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $stories->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- CSS for Improved Design -->
    <style>
        :root {
            --primary-color: #5D8B75;
            --primary-light: #B6D2C1;
            --primary-dark: #3A5A4A;
            --success-color: #198754;
        }

        .card-body {
            background-color: transparent !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .story-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .story-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .story-stats {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding-top: 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(182, 210, 193, 0.25);
        }

        /* Pagination styling */
        .pagination {
            gap: 5px;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Completion badge container */
        .completion-badge-container {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }

        /* Completion badge styling */
        .completion-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            background-color: rgba(25, 135, 84, 0.15);
            border: 1px solid var(--success-color);
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.2);
        }

        .completion-badge i {
            color: var(--success-color);
            font-size: 18px;
        }

        .completion-score {
            font-weight: bold;
            color: var(--success-color);
            font-size: 14px;
        }
    </style>

    <script>
        document.title = "Explore Stories | Reading Platform";

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</x-layout>