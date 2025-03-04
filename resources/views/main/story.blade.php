<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm p-4 rounded-4 border-0 bg-light" style="max-width: 600px;">
                <!-- Story Title -->
                <h1 class="fw-bold text-primary text-center mb-3">{{ $story->title }}</h1>

                <!-- Author Information -->
                <p class="text-secondary text-center">
                    <i class="bi bi-person-circle fs-5 text-muted"></i>
                    <span class="fw-semibold">By {{ $story->user->name }}</span>
                </p>

                <hr class="my-3">

                <!-- Story Content -->
                <div class="story-content fs-5 lh-lg text-start">
                    <p class="lead text-dark">{{ $story->body }}</p>
                </div>

                <hr class="my-3">

                <!-- Quiz Button -->
                <div class="text-center mb-3">
                    <a href="/qize" class="btn btn-primary px-4">Go to Quiz</a>
                </div>

                <hr class="my-3">

                <!-- Likes & Comments Section -->
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Likes -->
                    <p class="mb-0 text-secondary">
                        @auth
                        <button class="like-btn " data-liked="1">
                            👍 <span class="likes-count">{{ $story->story_like->where('like', 1)->count() }}</span>
                        </button>
                        <button class="dislike-btn" data-liked="0">
                            👎 <span class="dislikes-count">{{ $story->story_like->where('like', -1)->count() }}</span>
                        </button>
                        @else
                        <i class="bi bi-hand-thumbs-up-fill text-success fs-5"></i>
                        <span class="fw-bold">{{ $story->story_like->where('like', '1')->count() }}</span> Likes

                        <i class="bi bi-hand-thumbs-down-fill text-danger fs-5 ms-3"></i>
                        <span class="fw-bold">{{ $story->story_like->where('like', '-1')->count() }}</span> Dislikes
                        @endauth
                    </p>


                    <!-- Comments Button -->
                    <a href="/story/{{ $story->id }}" class="btn btn-outline-primary">
                        <i class="bi bi-chat-dots-fill"></i> {{ $story->story_Comment->count() }} Comments
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".like-btn, .dislike-btn").click(function() {
                var story = $(this).closest(".story");
                var storyId = story.data("stories-id"); // Ensure this exists
                var likeValue = $(this).data("like"); // Ensure this is -1, 0, or 1

                $.ajax({
                    url: "/like", // Ensure this matches your route
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    data: {
                        stories_id: storyId,
                        like: likeValue
                    },
                    success: function(response) {
                        story.find(".likes-count").text(response.likes);
                        story.find(".dislikes-count").text(response.dislikes);
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr.responseJSON);
                    }
                });
            });
        });
    </script>



</x-layout>