@extends('frontend.layout.app')

@section('title', 'Result Quiz')

@push('css')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .result-content {
            text-align: center;
            padding: 50px 0;
        }
        .result-card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            transition: transform 0.3s;
        }
        .result-card:hover {
            transform: scale(1.05);
        }
        .result-footer {
            margin-top: 20px;
        }
        .timer {
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }
        .timer i {
            margin-left: 5px;
        }
        .progress-bar {
            background-color: #28a745;
        }
        .result-content img {
            width: 250px;
            height: auto;
        }
        .result-card p {
            font-size: 1.5em;
        }
    </style>
@endpush

@section('content')
    <div class="container result-content">
        <h2>Result Quiz</h2>
        <div class="card result-card">
            <div class="card-body">
                <img src="{{ asset('images/gift.png') }}" alt="Gift" width="100">
                <div class="my-4">
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $score }}%;" aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100">{{ $score }}%</div>
                    </div>
                </div>
                <p>PERCENTAGE SCORE: <strong>{{ $score }}%</strong></p>
                <p>CORRECT PREDICTIONS: <strong>{{ $correctAnswers }}</strong></p>
            </div>
        </div>
        <div class="result-footer">
            <a href="{{ route('list-quiz') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
