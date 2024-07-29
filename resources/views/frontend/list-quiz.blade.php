@extends('frontend.layout.app')

@section('title', 'Quiz')

@push('css')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffeb3b;
        }
        .quiz-section {
            text-align: center;
            padding: 50px 0;
        }
        .quiz-card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .quiz-card:hover {
            transform: scale(1.05);
        }
        .quiz-card img {
            width: 200px;
            height: auto;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container quiz-section">
        <h1>Quiz Section</h1>

        <!-- Category Dropdown -->
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="quizzes" class="row">
            @foreach($quizzes as $quiz)
                <div class="col-md-4 quiz-card" data-category="{{ $quiz->category }}">
                    <div class="card quiz-card">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $quiz->image) }}" alt="Quiz Image" class="img-fluid">
                            <h5 class="card-title">{{ $quiz->title }}</h5>
                            <p class="card-text">{{ $quiz->description }}</p>
                            <p class="card-text">{{ $quiz->category }}</p>
                            <a href="{{ route('frontend.quiz.show', $quiz->id) }}" class="btn btn-primary">Start</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');

            categorySelect.addEventListener('change', function() {
                const category = this.value;
                window.location.href = `{{ route('list-quiz') }}?category=${category}`;
            });
        });
    </script>
@endpush
