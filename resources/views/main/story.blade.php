<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <head>
        <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    </head>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Story Card -->
                <div class="card shadow border-0 rounded-4 mb-4">
                    <!-- Story Header -->
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary rounded-pill px-3 py-2">Story</span>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-eye-fill text-muted me-1"></i>
                                <span class="text-muted">{{ $story->views }} views</span>
                            </div>
                        </div>
                        <h1 class="fw-bold text-dark mb-3">{{ $story->title }}</h1>

                        <!-- Author Information -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-circle bg-primary text-white me-3">
                                <span>{{ substr($story->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="mb-0 small text-muted">Published by</p>
                                <p class="mb-0 fw-bold">{{ $story->user->name }}</p>
                            </div>
                        </div>

                        @if ($story->Author)
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-circle bg-secondary text-white me-3">
                                    <i class="bi bi-pen"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small text-muted">Written by</p>
                                    <p class="mb-0 fw-bold">{{ $story->Author }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <hr class="my-0 mx-4">

                    <!-- Story Content -->
                    <div class="card-body p-4">
                        <div class="story-content fs-5 lh-lg text-start mb-4">
                            <p class="text-dark">{{ $story->body }}</p>
                        </div>

                        <!-- Engagement Section -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <!-- Likes -->
                            <div class="d-flex align-items-center">
                                @if (Auth::check() && auth()->user()->is_banned == false)
                                    <input type="hidden" id="story_id" value="{{ $story->id }}">

                                    <!-- Like Button -->
                                    <button class="like-btn btn btn-light rounded-circle p-2 me-1" data-like="1">
                                        <i
                                            class="fa-{{ $story->story_like->where('user_id', auth()->id())->where('like', 1)->count() > 0? 'solid': 'regular' }} fa-thumbs-up fa-lg text-success"></i>
                                    </button>
                                    <span
                                        class="likes-count fw-semibold me-3">{{ $story->story_like->where('like', 1)->count() }}</span>

                                    <!-- Dislike Button -->
                                    <button class="dislike-btn btn btn-light rounded-circle p-2 me-1" data-like="-1">
                                        <i
                                            class="fa-{{ $story->story_like->where('user_id', auth()->id())->where('like', -1)->count() > 0? 'solid': 'regular' }} fa-thumbs-down fa-lg text-danger"></i>
                                    </button>
                                    <span
                                        class="dislikes-count fw-semibold">{{ $story->story_like->where('like', -1)->count() }}</span>
                                @else
                                    <!-- Non-interactive likes for guests -->
                                    <div class="d-flex align-items-center me-3">
                                        <i class="fa-regular fa-thumbs-up fa-lg text-success me-1"></i>
                                        <span
                                            class="likes-count fw-semibold">{{ $story->story_like->where('like', 1)->count() }}</span>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-thumbs-down fa-lg text-danger me-1"></i>
                                        <span
                                            class="dislikes-count fw-semibold">{{ $story->story_like->where('like', -1)->count() }}</span>
                                    </div>
                                @endauth
                        </div>

                        <!-- Comments Button -->
                        <a href="{{ route('comment.index', $story->id) }}"
                            class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-chat-dots-fill me-1"></i> {{ $story->story_Comment->count() }} Comments
                        </a>
                    </div>
                </div>
            </div>
            @if (count($questions) != 0)

                <!-- Quiz Card -->
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                        <h3 class="fw-bold text-dark mb-2">Knowledge Check</h3>
                        <p class="text-muted">Test your understanding of the story with this quick quiz</p>
                    </div>

                    <div class="card-body p-4">
                        <!-- Quiz Status -->
                        <div class="text-center mb-4">
                            @auth
                                @if ($userScore !== null)
                                    <div class="quiz-result p-4 bg-light rounded-4">
                                        <i class="bi bi-award text-primary fs-1 mb-3 d-block"></i>
                                        <h4 class="fw-bold">Quiz Completed</h4>
                                        <p class="mb-1">Your score</p>
                                        <h2 class="text-primary mb-0">{{ $userScore }} <small>points</small></h2>
                                    </div>
                                @else
                                    <button class="start-btn btn btn-primary btn-lg px-4 py-2 rounded-pill">
                                        <i class="bi bi-pencil-square me-2"></i> Start Quiz
                                    </button>
                                @endif
                            @else
                                <div class="p-4 bg-light rounded-4">
                                    <i class="bi bi-lock text-secondary fs-1 mb-3 d-block"></i>
                                    <h4 class="fw-bold">Quiz Locked</h4>
                                    <p class="text-muted mb-3">Sign in to unlock this quiz and track your progress</p>
                                    <a href="/login" class="btn btn-primary rounded-pill px-4">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                                    </a>
                                </div>
                            @endauth
                        </div>

                        <!-- Quiz Container -->
                        <div class="arremn">
                            <div class="question-container hide rounded-4 bg-light p-4">
                                <div class="question-header d-flex justify-content-between mb-3">
                                    <span class="badge bg-primary rounded-pill px-3 py-2 question-number">Question
                                        1</span>
                                    <span class="badge bg-secondary rounded-pill px-3 py-2 question-progress">1 of
                                        5</span>
                                </div>

                                <div class="question fs-4 fw-bold mb-4">Question</div>

                                <div class="answer-btns d-grid gap-3">
                                    <!-- Answer buttons will be inserted here -->
                                </div>
                            </div>

                            <div class="controls d-flex justify-content-center align-items-center mt-4">
                                <button class="next-btn btn btn-primary rounded-pill px-4 py-2 hide">
                                    Next Question <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                                <div class="score-display text-center p-4 hide">
                                    <h1 class="score mb-3"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #5D8B75;
        --primary-light: #B6D2C1;
        --primary-dark: #3A5A4A;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --light-color: #f8f9fa;
    }

    /* Typography improvements */
    body {
        line-height: 1.6;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .bg-primary {
        background-color: var(--primary-color) !important;
    }

    /* Avatar circle */
    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
    }

    /* Quiz styling */
    .question-container {
        transition: all 0.3s ease;
    }

    .answer-btns button {
        background-color: white;
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.2s ease;
    }

    .answer-btns button:hover:not([disabled]) {
        background-color: var(--light-color);
        transform: translateY(-2px);
    }

    .answer-btns button.correct {
        background-color: var(--success-color);
        color: white;
    }

    .answer-btns button.wrong {
        background-color: var(--danger-color);
        color: white;
    }

    .hide {
        display: none;
    }

    /* Animate blur */
    .story-content.blurred {
        filter: blur(4px);
        transition: filter 0.5s ease;
    }
</style>
<script>
    // Like/Dislike functionality
    document.addEventListener("DOMContentLoaded", function() {
        const likeBtn = document.querySelector('.like-btn');
        const dislikeBtn = document.querySelector('.dislike-btn');

        if (likeBtn && dislikeBtn) {
            const storyId = document.querySelector('#story_id').value;

            function toggleLikeDislike(button, likeValue) {
                fetch(`/like/${storyId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            like: likeValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update counts
                        document.querySelector('.likes-count').textContent = data.likes;
                        document.querySelector('.dislikes-count').textContent = data.dislikes;



                        // Set the active icon to solid
                        if (data.user_like === 1) {
                            likeBtn.querySelector('i').className =
                                'fa-solid fa-thumbs-up fa-lg text-success';
                        } else if (data.user_like === -1) {
                            dislikeBtn.querySelector('i').className =
                                'fa-solid fa-thumbs-down fa-lg text-danger';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            likeBtn.addEventListener('click', () => toggleLikeDislike(likeBtn, 1));
            dislikeBtn.addEventListener('click', () => toggleLikeDislike(dislikeBtn, -1));
        }
    });
</script>
@if (!$questions->isEmpty())
    <script>
        document.title = "{{ $story->title }} | Reading Platform";

        // DOM elements
        const text = document.querySelector('.story-content');
        const startBtn = document.querySelector('.start-btn');
        const controls = document.querySelector('.controls');
        const nextBtn = document.querySelector('.next-btn');
        const questionContainer = document.querySelector('.question-container');
        const questionTitle = document.querySelector('.question');
        const answerButtons = document.querySelector('.answer-btns');
        const scoreHeader = document.querySelector('.score');
        const scoreDisplay = document.querySelector('.score-display');
        const questionNumber = document.querySelector('.question-number');
        const questionProgress = document.querySelector('.question-progress');

        let shuffledQuestions, currentIndex, score;

        if (startBtn) {
            startBtn.addEventListener('click', startQuiz);
        }

        nextBtn.addEventListener('click', () => {
            currentIndex++;
            nextQuestion();
        });

        function startQuiz() {
            text.classList.add('blurred');
            startBtn.classList.add('hide');
            questionContainer.classList.remove('hide');
            shuffledQuestions = questionsList.sort(() => Math.random() - 0.5);
            currentIndex = 0;
            score = 0;
            nextQuestion();
        }

        function nextQuestion() {
            resetState();
            displayQuestion(shuffledQuestions[currentIndex]);

            // Update question numbers
            questionNumber.textContent = `Question ${currentIndex + 1}`;
            questionProgress.textContent = `${currentIndex + 1} of ${shuffledQuestions.length}`;
        }

        function resetState() {
            nextBtn.classList.add('hide');
            answerButtons.innerHTML = ''; // clears all buttons
        }

        function displayQuestion(question) {
            questionTitle.innerText = question.question;

            let answers = [...question.answers];
            answers.sort(() => Math.random() - 0.5);

            answers.forEach(answer => {
                const button = document.createElement('button');
                button.innerText = answer.text;
                button.classList.add('btn');
                if (answer.correct) button.dataset.correct = true;
                button.addEventListener('click', selectAnswer);
                answerButtons.appendChild(button);
            });
        }

        function selectAnswer(e) {
            const selected = e.target;
            const correct = selected.dataset.correct === 'true';

            if (correct) {
                let result = 10 * {{ $story->Difficulty }}; // Use json_encode to safely pass the variable
                score += result;
            }


            Array.from(answerButtons.children).forEach(button =>
                setStatusClass(button, button.dataset.correct === 'true')
            );

            if (shuffledQuestions.length > currentIndex + 1) {
                nextBtn.classList.remove('hide');
            } else {
                showFinalScore();
            }
        }

        function setStatusClass(button, isCorrect) {
            button.classList.add(isCorrect ? 'correct' : 'wrong');
            button.disabled = true;
        }

        function showFinalScore() {
            text.classList.remove('blurred');
            questionContainer.classList.add('hide');
            nextBtn.classList.add('hide');
            scoreDisplay.classList.remove('hide');

            const result = score >= (shuffledQuestions.length * 10) / 2 ? "PASSED" : "FAILED";
            scoreHeader.innerHTML =
                `<div class="mb-2"><span class="badge bg-${score >= (shuffledQuestions.length * 10) / 2 ? 'success' : 'danger'} p-2 fs-6">${result}</span></div><div>Your score: <span class="text-primary">${score}</span> points</div>`;

            // Send score to Laravel
            fetch("{{ route('save-score') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        score: score,
                        story_id: {{ $story->id }}
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Score saved:', data);
                })
                .catch(error => {
                    console.error('Error saving score:', error);
                });
        }



        // Questions list from Laravel
        const questionsList = [
            @foreach ($questions as $question)
                {
                    question: '{{ $question->question }}',
                    answers: [{
                            text: "{{ $question->answer1 }}",
                            correct: false
                        },
                        {
                            text: "{{ $question->answer2 }}",
                            correct: false
                        },
                        {
                            text: "{{ $question->answer3 }}",
                            correct: false
                        },
                        {
                            text: "{{ $question->correct_answer }}",
                            correct: true
                        }
                    ]
                },
            @endforeach
        ];
    </script>
@endif

</x-layout>
