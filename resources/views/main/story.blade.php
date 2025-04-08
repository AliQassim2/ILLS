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
                        <button class="start-btn btn">Start Quiz</button>
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
                            <input type="hidden" name="story_id" value="{{ $story->id }}" id="story_id">
                            <button class="like-btn" data-liked="1">
                                👍 <span class="likes-count">{{ $story->story_like->where('like', 1)->count() }}</span>
                            </button>
                            <button class="dislike-btn" data-liked="-1">
                                👎 <span class="dislikes-count">{{ $story->story_like->where('like', -1)->count() }}</span>
                            </button>
                        @else
                            <i class="bi bi-hand-thumbs-up-fill text-success fs-5"></i>
                            <span class="fw-bold">{{ $story->story_like->where('like', '1')->count() }}</span>
                            <span class="fw-bold">{{ $story->story_like->where('like', 1)->count() }}</span> Likes

                            <i class="bi bi-hand-thumbs-down-fill text-danger fs-5 ms-3"></i>
                            <span class="fw-bold">{{ $story->story_like->where('like', -1)->count() }}</span> Dislikes
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
