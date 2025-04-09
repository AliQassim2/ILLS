<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <head>
        <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    </head>
    <div class="container d-flex h mt-4">
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

                <!-- Quiz or Score Display -->
                <div class="text-center font-weight-bold mb-3">
                    @auth
                        @if ($userScore !== null)
                            <h3 class="text-success">You already took the quiz.</h3>
                            <h4 class="text-primary">Your score: {{ $userScore }}</h4>
                        @else
                            <button class="start-btn btn">Start Quiz</button>
                        @endif
                    @else
                        <h3 class="text-danger">Please log in to take the quiz.</h3>
                        <button class="start-btn btn" disabled>Start Quiz</button>
                    @endauth
                </div>


                <div class="arremn">
                    <div class="question-container hide" class="hide">
                        <div class="question fs-2 ">Question</div>
                        <div class="answer-btns">
                        </div>
                    </div>
                    <div class="controls d-flex justify-content-center align-items-center">

                        <button class="next-btn btn hide">Next</button>
                        <h1 class="score"></h1>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Likes & Comments Section -->
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Likes -->
                    <p class="mb-0 text-secondary">
                        @auth
                            <input type="hidden" id="story_id" value="{{ $story->id }}">

                            <!-- Like Button -->
                            <button class="like-btn btn border-0 me-2" data-like="1">
                                <i class="fa-regular fa-thumbs-up fa-xl text-success"></i>
                                <span
                                    class="likes-count fw-semibold">{{ $story->story_like->where('like', 1)->count() }}</span>
                            </button>

                            <!-- Dislike Button -->
                            <button class="dislike-btn btn border-0" data-like="-1">
                                <i class="fa-regular fa-thumbs-down fa-xl text-danger"></i>
                                <span
                                    class="dislikes-count fw-semibold">{{ $story->story_like->where('like', -1)->count() }}</span>
                            </button>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const likeBtn = document.querySelector('.like-btn');
            const dislikeBtn = document.querySelector('.dislike-btn');
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

                        // Reset both icons
                        likeBtn.querySelector('i').className = 'bi bi-hand-thumbs-up';
                        dislikeBtn.querySelector('i').className = 'bi bi-hand-thumbs-down';

                        // Toggle active icon
                        if (likeValue === 1 && data.likes > 0) {
                            likeBtn.querySelector('i').classList.add('bi-hand-thumbs-up-fill');
                        } else if (likeValue === -1 && data.dislikes > 0) {
                            dislikeBtn.querySelector('i').classList.add('bi-hand-thumbs-down-fill');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            likeBtn.addEventListener('click', () => toggleLikeDislike(likeBtn, 1));
            dislikeBtn.addEventListener('click', () => toggleLikeDislike(dislikeBtn, -1));
        });
    </script>

    <script>
        document.title = "Story";
        // DOM elements
        const text = document.querySelector('.story-content');
        const startBtn = document.querySelector('.start-btn');
        const controls = document.querySelector('.controls');
        const nextBtn = document.querySelector('.next-btn');
        const questionContainer = document.querySelector('.question-container');
        const questionTitle = document.querySelector('.question');
        const answerButtons = document.querySelector('.answer-btns');
        const scoreHeader = document.querySelector('.score');

        let showScoreBtn = document.createElement("button");
        let shuffledQuestions, currentIndex, score;

        startBtn.addEventListener('click', startQuiz);
        nextBtn.addEventListener('click', () => {
            currentIndex++;
            nextQuestion();
        });

        function startQuiz() {
            text.style.filter = "blur(4px)";
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
        }

        function resetState() {
            nextBtn.classList.add('hide');
            answerButtons.innerHTML = ''; // clears all buttons
        }

        function displayQuestion(question) {
            questionTitle.innerText = question.question;
            question.answers.sort(() => Math.random() - 0.5).forEach(answer => {
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

            if (correct) score += 10;

            Array.from(answerButtons.children).forEach(button =>
                setStatusClass(button, button.dataset.correct === 'true')
            );

            if (shuffledQuestions.length > currentIndex + 1) {
                nextBtn.classList.remove('hide');
            } else {
                showScoreBtn.innerText = "Show Score";
                showScoreBtn.classList.add('show');
                controls.appendChild(showScoreBtn);
                showScoreBtn.addEventListener('click', showFinalScore);
            }
        }

        function setStatusClass(button, isCorrect) {
            button.classList.add(isCorrect ? 'correct' : 'wrong');
            button.disabled = true;
        }

        function showFinalScore() {
            text.style.filter = "blur(0)";
            showScoreBtn.classList.add('hide');
            questionContainer.classList.add('hide');

            const result = score >= shuffledQuestions.length / 2 ? "PASS" : "FAILED";
            scoreHeader.innerText = `${result}, your score is ${score}`;

            // Send score to Laravel
            fetch("{{ route('save-score') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        score: score,
                        story_id: {{ $story->id }} // Make sure $story is passed to the Blade view
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



        // Static questions for now (will be replaced by Laravel data)
        const questionsList = [
            @foreach ($qustions as $question)
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
                        },
                    ]
                },
            @endforeach

        ];
    </script>

</x-layout>
