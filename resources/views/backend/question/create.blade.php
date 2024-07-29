@extends('backend.layout.app')

@section('title', 'Create Question')

@section('content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-8">
            <a href="{{ route('question') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <div class="card-header text-center">Form Create Question</div>
            <div class="card-body">
                <form action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="quiz_id" class="form-label">Quiz ID</label>
                        <select id="quiz_id" name="quiz_id" class="form-control @error('quiz_id') is-invalid @enderror">
                            @foreach ($quizzes as $quiz)
                                <option value="{{ $quiz->id }}" {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}>
                                    {{ $quiz->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('quiz_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="question_text" class="form-label">Question Text</label>
                        <input type="text" id="question_text" name="question_text" class="form-control @error('question_text') is-invalid @enderror" value="{{ old('question_text') }}" required>
                        @error('question_text')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="options" class="form-label">Options</label>
                        @for ($i = 0; $i < 4; $i++)
                            <input type="text" id="options_{{ $i }}" name="options[]" class="form-control @error('options.*') is-invalid @enderror" value="{{ old('options.' . $i) }}" required>
                        @endfor
                        @error('options.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="correct_answer" class="form-label">Correct Answer</label>
                        <input type="text" id="correct_answer" name="correct_answer" class="form-control @error('correct_answer') is-invalid @enderror" value="{{ old('correct_answer') }}" required>
                        @error('correct_answer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image">Image</label>
                        <div class="col-sm-3">
                            <img src="/images/default-image.png" class="img-thumbnail img-preview">
                        </div>
                        <input type="file" id="image" name="image" class="form-control mt-2 @error('image') is-invalid @enderror" onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="text-right">
                        <hr>
                        <button type="submit" class="btn btn-success mt-lg-3">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .img-preview {
        max-width: 100%;
        height: auto;
    }
</style>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        const fileReader = new FileReader();
        fileReader.readAsDataURL(image.files[0]);

        fileReader.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
@endsection
