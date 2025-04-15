<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-body p-4">
                        <h2 class="text-primary fw-bold mb-4">Edit Your Comment</h2>

                        @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li><i class="bi bi-exclamation-circle me-2"></i>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="comment" class="form-label fw-semibold">Comment</label>
                                <textarea name="comment" id="comment" class="form-control border" rows="5" required>{{ $comment->body }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ url()->previous() }}" class="btn btn-light">
                                    <i class="bi bi-arrow-left me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check2 me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>

                        <!-- Comment Info -->
                        <div class="mt-4 pt-3 border-top">
                            <p class="text-muted small mb-0">
                                <i class="bi bi-info-circle me-1"></i>
                                Originally posted {{ $comment->created_at->diffForHumans() }}
                                @if($comment->updated_at && $comment->updated_at != $comment->created_at)
                                • Last edited {{ $comment->updated_at->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
