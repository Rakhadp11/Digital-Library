<div class="modal-content">
    <form id="formAction" action="{{ route('question.update', $question->id) }}" method="post" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
    <div class="modal-header">
    <h5 class="modal-title" id="largeModalLabel">Edit Question</h5>
    <a href="{{ route('question') }}"><i class="fa-solid fa-xmark fa-fade"></i></a>
    </div>
    <div class="modal-body">

        <div class="mb-3">
            <label for="quiz_id" class="form-label">Quiz</label>
            <select id="quiz_id" name="quiz_id" class="form-control @error('quiz_id') is-invalid @enderror" required>
                <option value="">Select Quiz</option>
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ isset($question) && $question->quiz_id == $quiz->id ? 'selected' : '' }}>
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
            <textarea id="question_text" name="question_text" class="form-control @error('question_text') is-invalid @enderror" required>{{ old('question_text', $question->question_text) }}</textarea>
            @error('question_text')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        @foreach($question->options as $index => $option)
        <div class="mb-3">
            <label for="option{{ $index+1 }}" class="form-label">Option {{ $index+1 }}</label>
            <input type="text" id="option{{ $index+1 }}" name="options[]" class="form-control @error('options.*') is-invalid @enderror" value="{{ old('options.' . $index, $option) }}" required>
            @error('options.*')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        @endforeach

        <div class="mb-3">
            <label for="correct_answer" class="form-label">Correct Answer</label>
            <input type="text" id="correct_answer" name="correct_answer" class="form-control @error('correct_answer') is-invalid @enderror" value="{{ old('correct_answer', $question->correct_answer) }}" required>
            @error('correct_answer')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image">Image</label>
            <div class="col-sm-3">
                <img src="{{ asset('storage/' . $question->image) }}" alt="Image" width="100" class="img-thumbnail img-preview">
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
            <button class="btn btn-success mt-lg-3">Edit</button>
        </div>
</form>
</div>

<style>
    .mb-3 span {
        position: relative;
        margin: 10px 0 0 0;
        font-size: 15px;
        color: red;
    }
    .con-span span {
        font-size: 15px;
        margin-top: 10px;
        color: red;
    }
    .mb-3 span i{
        color: rgb(51, 247, 51);
    }
</style>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const sampulLabel = document.querySelector('.custom-file-label')
        const imgPreview = document.querySelector('.img-preview');


        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(image.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
    
</script>