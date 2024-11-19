@php
    $noFooter = true;
@endphp

@extends('frontend.layout.app')

@section('title', 'Quiz')

@push('css')
    <style>
        body {
            background-image: url('/images/bag-quiz.jpg');
            background-size: cover; /* Menyesuaikan gambar agar memenuhi layar */
            background-position: center; /* Menempatkan gambar di tengah */
            background-repeat: no-repeat; 
            font-family: Arial, sans-serif;
        }
        .quiz-content {
            text-align: center;
            padding: 50px 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 120px auto;
            position: relative;
        }
        .question {
            margin-bottom: 30px;
        }
        .question img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
        .options {
            display: grid;
            gap: 10px;
            justify-content: center;
        }
        .form-check-label {
            cursor: pointer;
        }
        #feedback {
            margin-top: 20px;
            display: none;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 150px;
            font-size: 16px;
            padding: 10px;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-group {
            margin-top: 20px;
            text-align: center;
        }
        .timer {
            position: absolute;
            top: 90px;
            right: 20px;
            font-size: 30px;
            color: #1d1d1d;
        }
        .btn-prev {
            float: left;
        }
        .btn-next {
            float: right;
        }
    </style>
@endpush

@section('content')
<div class="timer" id="timer"><i class="fa-regular fa-clock"></i> 10:00</div>
    <div class="container quiz-content">
        <h5 class="mb-4">{{ $quiz->title }}</h5>
        <form id="quizForm" method="POST" action="{{ route('quiz.result', $quiz->id) }}">
            @csrf
            @foreach ($quiz->questions as $index => $question)
                <div class="question mb-4" id="question{{ $index + 1 }}" style="{{ $index > 0 ? 'display: none;' : '' }}">
                    <h5>{{ $question->question_text }}</h5>
                    @if ($question->image)
                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" width="200">
                    @endif
                    <div class="options">
                        @foreach ($question->options as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $index }}]" id="option{{ $loop->index }}" value="{{ $option }}">
                                <label class="form-check-label" for="option{{ $loop->index }}">
                                    {{ $option }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div id="feedback" class="alert alert-success mt-3" role="alert" style="display: none;">
                Your answer is correct!
            </div>
        </form>
    </div>
    <div class="container text-center mt-3">
        <button class="btn btn-primary mx-1 btn-prev" id="prevBtn" disabled><i class="fa-regular fa-circle-left"></i> Previous</button>
        <button class="btn btn-primary mx-1 btn-next" id="nextBtn">Next <i class="fa-regular fa-circle-right"></i></button>
        <button type="submit" form="quizForm" class="btn btn-primary mx-1 btn-next" id="submitBtn" style="display: none;">Submit</button>
    </div>
@endsection

@push('scripts')
<script>
    let timeLimit = 600; 
    let timer = document.getElementById('timer');

    function startTimer(duration, display) {
        let timer = duration, minutes, seconds;
        let interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(interval);
                display.textContent = "00:00";
                alert("Time's up! The quiz will now end.");
                window.location.href = "/list-quiz"; 
            }
        }, 1000);
    }

    startTimer(timeLimit, timer);

    let currentQuestion = 1;
    const totalQuestions = {{ count($quiz->questions) }}; 

    document.getElementById('nextBtn').addEventListener('click', function(event) {
        event.preventDefault();
        if (currentQuestion < totalQuestions) {
            currentQuestion++;
            showQuestion(currentQuestion);
            updateButtons();
        }
    });

    document.getElementById('prevBtn').addEventListener('click', function(event) {
        event.preventDefault();
        if (currentQuestion > 1) {
            currentQuestion--;
            showQuestion(currentQuestion);
            updateButtons();
        }
    });

    function showQuestion(questionNumber) {
        document.querySelectorAll('.question').forEach(function(question) {
            question.style.display = 'none';
        });
        document.getElementById('question' + questionNumber).style.display = 'block';
    }

    function updateButtons() {
        if (currentQuestion === 1) {
            document.getElementById('prevBtn').disabled = true;
        } else {
            document.getElementById('prevBtn').disabled = false;
        }
        if (currentQuestion === totalQuestions) {
            document.getElementById('nextBtn').style.display = 'none'; 
            document.getElementById('submitBtn').style.display = 'inline-block'; 
        } else {
            document.getElementById('nextBtn').style.display = 'inline-block'; 
            document.getElementById('submitBtn').style.display = 'none'; 
        }
    }

    function showSubmitButton() {
        document.getElementById('nextBtn').style.display = 'none'; 
        document.getElementById('submitBtn').style.display = 'inline-block'; 
    }
</script>
@endpush
