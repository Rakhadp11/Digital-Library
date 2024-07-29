<div class="modal-content">
    <form id="formAction" action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
    <div class="modal-header">
    <h5 class="modal-title" id="largeModalLabel">Edit List User</h5>
    <a href="{{ route('user.admin') }}"><i class="fa-solid fa-xmark fa-fade"></i></a>
    </div>
    <div class="modal-body">

        <div class="mb-3">
            <label for="name" class="form-label">name</label>
            <input type="text" placeholder="Enter name" id="name-val" name="name" onkeyup="validateName()" class="form-control @error('name') is-invalid @enderror" autofocus value="{{ old('name', $user->name) }}">
            <span id="title-error"></span>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" placeholder="Enter email" id="email-val" name="email" onkeyup="validateEmail()" class="form-control @error('email') is-invalid @enderror" autofocus value="{{ old('email', $user->email) }}">
            <span id="email-error"></span>
            @error('email')
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
    let emailError = document.getElementById('email-error');
    let submitError = document.getElementById('submit-error');


    function validateEmail() {
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

    function validateEmail() {
        let email = document.getElementById('email-val').value;

        if (email.length == 0) {
            emailError.innerHTML = 'email is required';
            return false;
        }
        if(!email.match(/^[A-Za-z]*/)){
            emailError.innerHTML = 'type email';
            return false;
        }
        emailError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }


    function validateForm() {
        if(!validateName() || !validateEmail()) {
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