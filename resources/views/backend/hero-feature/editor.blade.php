<div class="modal-content">
    <form id="formAction" action="{{ route('hero-feature.update', $heroFeature->id) }}" method="post" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
    <div class="modal-header">
    <h5 class="modal-title" id="largeModalLabel">Edit Hero Feature</h5>
    {{-- <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
    <a href="{{ route('hero-feature') }}"><i class="fa-solid fa-xmark fa-fade"></i></a>
    </div>
    <div class="modal-body">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" placeholder="Enter title" id="title-val" name="title" onkeyup="validateTitle()" class="form-control @error('title') is-invalid @enderror" autofocus value="{{ old('title', $heroFeature->title) }}">
            <span id="title-error"></span>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="button" class="form-label">Button</label>
            <input type="text" placeholder="Enter button" id="button-val" name="button" onkeyup="validateButton()" class="form-control @error('button') is-invalid @enderror" autofocus value="{{ old('button', $heroFeature->button) }}">
            <span id="button-error"></span>
            @error('button')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="text-right">
            <hr>
            <button onclick="return validateForm()" class="btn btn-success mt-lg-3">Edit</button>
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
    let titleError = document.getElementById('title-error');
    let buttonError = document.getElementById('button-error');
    let submitError = document.getElementById('submit-error');


    function validateTitle() {
        let title = document.getElementById('title-val').value;

        if (title.length == 0) {
            titleError.innerHTML = 'title is required';
            return false;
        }
        if(!title.match(/^[A-Za-z]*/)){
            titleError.innerHTML = 'type title';
            return false;
        }
        titleError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }

    function validateButton() {
        let button = document.getElementById('button-val').value;

        if (button.length == 0) {
            buttonError.innerHTML = 'button is required';
            return false;
        }
        if(!button.match(/^[A-Za-z]*/)){
            buttonError.innerHTML = 'type button';
            return false;
        }
        buttonError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }


    function validateForm() {
        if(!validateTitle() ||  !validateButton()) {
            submitError.style.display = 'block';
            submitError.innerHTML = 'sorry its still an error, please meet the conditions';
            setTimeout(function(){
                submitError.style.display = 'none';
            }, 3000);
            return false;
        }
        return true;
    }
</script>
