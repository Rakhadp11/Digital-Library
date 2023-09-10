@extends('layout.app')

@section('title', 'Craeate Category')

@section('content')
<div class="container ">
    <div class="row justify-content-center my-4">
        <div class="col-8">
            <a href="{{ route('category') }}"  class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <div class="card-header text-center">Form Create Category</div>
            <div class="card-header">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" placeholder="Enter name" id="name-val" name="name" onkeyup="validateName()" class="form-control @error('name') is-invalid @enderror" autofocus value="{{ old('name') }}">
                    <span id="name-error"></span>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea onkeyup="validateDescription()" placeholder="Enter description" id="description-val" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    <span id="description-error"></span>
                    @error('description')
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
                    <input type="file" id="image" name="image" class="form-control  mt-2 @error('image') is-invalid @enderror" aria-label="6" file example  onchange="previewImage()"> 
                    <div class="invalid-feedback">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>

                <div class="text-right">
                    <hr>
                    <button onclick="return validateForm()" class="btn btn-success mt-lg-3">Create</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
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
    let nameError = document.getElementById('name-error');
    let descriptionError = document.getElementById('description-error');
    let submitError = document.getElementById('submit-error');


    function validateName() {
        let name = document.getElementById('name-val').value;

        if (name.length == 0) {
            nameError.innerHTML = 'name is required';
            return false;
        }
        if(!name.match(/^[A-Za-z]*/)){
            nameError.innerHTML = 'type name';
            return false;
        }
        nameError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }

    function validateDescription() {
        let description = document.getElementById('description-val').value;
        let required = 15;
        let left = required - description.length;

        if (left > 0) {
            descriptionError.innerHTML = left + ' more characters required';
            return false;
        }
        descriptionError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }


    function validateForm() {
        if(!validateName() || !validateDescription()) {
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

{{-- <script src="js\pages\category\category-editor.js"></script> --}}
{{-- <script>
    $(document).ready(function () {
        Category.setTypeForm('{{ 'update' : 'store' }}');
        Category.init();
    });
</script> --}}
@endsection