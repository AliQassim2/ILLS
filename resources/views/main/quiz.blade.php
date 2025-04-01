<x-layout>
    <div class="container mt-5">
        <div class="card shadow-lg p-4 rounded-4">
            <h2 class="fw-bold text-center text-primary">{{ $story->title }} - Quiz</h2>

            <p class="text-muted text-center">
                <i class="bi bi-person-circle text-secondary"></i>
                <span class="fw-semibold">By {{ $story->user->name }}</span>
            </p>

            <hr>

            <!-- Questions Loop -->
            @foreach ($story->questions as $question) {{-- ✅ FIXED --}}
            @php
            $answers = [$question->correct_answer, $question->answer1, $question->answer2, $question->answer3];
            shuffle($answers); // Randomizes answer order
            @endphp

            <div class="mb-4">
                <h5 class="fw-bold">{{ $loop->iteration }}. {{ $question->question }}</h5>

                <form action="quiz/{{$story->id}}" method="POST">
                    @csrf
                    <div class="list-group">
                        @foreach ($answers as $answer)
                        <label class="list-group-item">
                            <input type="radio" name="answer" value="{{ $answer }}" required>
                            {{ $answer }}
                        </label>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit Answer</button>
                </form>


            </div>
            <hr>
            @endforeach
        </div>
    </div>
</x-layout>
