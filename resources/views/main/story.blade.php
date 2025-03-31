<x-layout>
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

                <!-- Quiz Button -->
                <div class="text-center ont-weight-bold mb-3">
                    <button class="start-btn btn">Start Quiz</button>
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
                        <button class="like-btn " data-liked="1">
                            👍 <span class="likes-count">{{ $story->story_like->where('like', 1)->count() }}</span>
                        </button>
                        <button class="dislike-btn" data-liked="0">
                            👎 <span class="dislikes-count">{{ $story->story_like->where('like', -1)->count() }}</span>
                        </button>
                        @else
                        <i class="bi bi-hand-thumbs-up-fill text-success fs-5"></i>
                        <span class="fw-bold">{{ $story->story_like->where('like', '1')->count() }}</span>

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
    <script>
        document.title = "Story";

        const text = document.querySelector('.story-content')
        const start_btn = document.querySelector('.start-btn')
        const controls = document.querySelector('.controls')
        const next_btn = document.querySelector('.next-btn')
        const questions = document.querySelector('.question-container')
        const questions_title = document.querySelector('.question')
        const answers = document.querySelector('.answer-btns')
        let shows = document.createElement("button")
        let scoreheader = document.querySelector('.score')

        let shufle, curent ,score


        start_btn.addEventListener('click',startQuiz)
        next_btn.addEventListener('click',()=>{
            curent++
            nextQuestion()
        })

        function startQuiz(){
            text.style.filter="blur(4px)"
            start_btn.classList.add('hide')
            questions.classList.remove('hide')
            shufle = questions_lists.sort( () => Math.random() - .5)
            curent=0
            score=0
            nextQuestion()
        }


        function nextQuestion(){
            reset()
            show(shufle[curent])
        }

        function reset(){
            next_btn.classList.add('hide')
            while(answers.firstChild){
                answers.removeChild(answers.firstChild)
            }
        }

        function show(q){
            questions_title.innerHTML= q.question
            q.answers.sort( () => Math.random() - .5).forEach(answer => {
                const btn = document.createElement('button')
                btn.innerHTML= answer.text
                btn.classList.add('btn')
                if(answer.correct){
                    btn.dataset.correct = answer.correct
                }
                btn.addEventListener('click',selectAnswer)
                answers.appendChild(btn)
            });

        }
        function selectAnswer(e){
            const selected = e.target
            const correct = selected.dataset.correct
            if(correct){
                score++
            }
            Array.from(answers.children).forEach((btn)=>{
                setStatusClass(btn,btn.dataset.correct)
            })
            if(shufle.length > curent+1){
                next_btn.classList.remove('hide')
            }else{

            shows.innerHTML = "Show Score"
            controls.appendChild(shows)
            shows.classList.add('show')
            shows.addEventListener('click',showScore)
            }

        }

        function setStatusClass(element, correct) {
            clearStatusClass(element)

            if (correct) {
            element.classList.add('correct')
            } else {
            element.classList.add('wrong')
            }
            element.disabled = true
        }

        function clearStatusClass(element) {
            element.classList.remove('correct')
            element.classList.remove('wrong')
        }

        function showScore(){
            text.style.filter="blur(0)"
            shows.classList.add('hide')
            questions.classList.add('hide')
            if(score >= questions_lists.length/2){
                scoreheader.innerHTML = `PASS , your score is ${score}`
            }
            else{
                scoreheader.innerHTML =`FAILED , your score is ${score}`
            }
        }


        const questions_lists = [
            {
                    question : 'what is the best language',
                    answers : [
                        {text: "CSS",  correct:false },
                        {text: "HTML", correct:true  },
                        {text: "JS",   correct:false },
                        {text: "PHP",  correct:false },
                    ],
            },
            {
                    question : 'do you like apples',
                    answers : [
                        {text: "no",  correct:false },
                        {text: "yes", correct:true  },
                    ],
            },
            {
                    question : '2+2 = ?',
                    answers : [
                        {text: "3",  correct:false },
                        {text: "20", correct:false  },
                        {text: "4",  correct:true  },
                    ],
            }
        ]

    </script>
</x-layout>
