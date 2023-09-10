<div class="modal-content">
    <form id="formAction" action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
    <div class="modal-header">
    <h5 class="modal-title" id="largeModalLabel">Edit Category</h5>
    {{-- <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
    <a href="{{ route('category') }}"><i class="fa-solid fa-xmark fa-fade"></i></a>
    </div>
    <div class="modal-body">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" placeholder="Enter name" id="name-val" name="name" onkeyup="validateName()" class="form-control @error('name') is-invalid @enderror" autofocus value="{{ old('name', $category->name) }}">
            <span id="name-error"></span>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea onkeyup="validateDescription()" placeholder="Enter description" id="description-val" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
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
                <img src="{{ asset('images/' . $category->image) }}" alt="Image" width="100" class="img-thumbnail img-preview">
            </div>            
            <input type="file" id="image" name="image" class="form-control mt-2 @error('image') is-invalid @enderror" aria-label="6" file example onchange="previewImage()" value="{{ old('image', $category->image) }}">
            @error('image')
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