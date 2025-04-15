<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-center fw-bold text-primary mb-4">Discussion</h2>

                <!-- Add Comment Form -->
                @auth
                @if (Auth::user()->is_banned == 0)


                <div class="card shadow-sm mb-4 rounded-4 border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Leave a Comment</h5>

                        @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li><i class="bi bi-exclamation-circle me-2"></i>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('comment.create', request()->route('story_id')) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="comment" class="form-control border" rows="3" placeholder="Share your thoughts..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-send me-2"></i>Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="card shadow-sm mb-4 rounded-4 border-0">
                    <div class="card-body p-4 text-center">
                        <div class="alert alert-danger border-0 mb-0">
                            <i class="bi bi-ban fs-3 d-block mb-2"></i>
                            <h5 class="fw-bold">Account Suspended</h5>
                            <p class="mb-0">Your account has been suspended and you cannot post comments at this time. Please contact the site administrator for more information.</p>
                        </div>
                    </div>
                </div>
                @endif
                @else
                <div class="card shadow-sm mb-4 rounded-4 border-0 text-center p-4">
                    <p class="mb-2">
                        <i class="bi bi-lock fs-3 text-muted d-block mb-2"></i>
                        You must <a href="{{ route('login', ['redirect' => request()->fullUrl()]) }}" class="text-primary fw-semibold">log in</a> to join the conversation.
                    </p>
                </div>
                @endauth

                <!-- Comments Section -->
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">{{ $comments->count() }} {{ Str::plural('Comment', $comments->count()) }}</h5>

                        @if ($comments->count() > 0)
                        @foreach ($comments as $comment)
                        <div class="comment-item border-bottom py-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:38px;height:38px;">
                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $comment->user->name }}</h6>
                                        <p class="text-muted small mb-0">
                                            @if ($comment->updated_at && $comment->updated_at != $comment->created_at)
                                            <span class="fst-italic">Edited {{ $comment->updated_at->diffForHumans() }}</span>
                                            @else
                                            {{ $comment->created_at->diffForHumans() }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if ((Auth::check() && $comment->user_id == Auth::id()) || (Auth::check() && Auth::user()->role == 0))
                                <div class="action-buttons">
                                    @if (Auth::check() && $comment->user_id == Auth::id())
                                    <a href="{{ route('comment.edit', $comment->id) }}" class="btn btn-sm btn-light me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @endif

                                    <form action="{{ Auth::user()->role == 0 ? url('comment/' . $comment->id) : route('comment.delete', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this comment?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>

                            <div class="comment-body mt-2">
                                <p class="mb-0">{{ $comment->body }}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-chat-left-text text-muted fs-1 mb-3"></i>
                            <p class="text-muted">No comments yet. Be the first to share your thoughts!</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>