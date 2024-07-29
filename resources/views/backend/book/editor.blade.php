<div class="modal-content">
    <form id="formAction" action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('put')
    <div class="modal-header">
    <h5 class="modal-title" id="largeModalLabel">Edit Book</h5>
    <a href="{{ route('book') }}"><i class="fa-solid fa-xmark fa-fade"></i></a>
    </div>
    <div class="modal-body">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" placeholder="Enter title" id="title-val" name="title" onkeyup="validateTitle()" class="form-control @error('title') is-invalid @enderror" autofocus value="{{ old('title', $book->title) }}">
            <span id="title-error"></span>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" placeholder="Enter category" id="category-val" name="category" onkeyup="validateCategory()" class="form-control @error('category') is-invalid @enderror" autofocus value="{{ old('category', $book->category) }}">
            <span id="category-error"></span>
            @error('category')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" placeholder="Enter author" id="author-val" name="author" onkeyup="validateAuthor()" class="form-control @error('author') is-invalid @enderror" autofocus value="{{ old('author', $book->author) }}">
            <span id="author-error"></span>
            @error('author')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="publisher" class="form-label">Publisher</label>
            <input type="text" placeholder="Enter publisher" id="publisher-val" name="publisher" onkeyup="validatePublisher()" class="form-control @error('publisher') is-invalid @enderror" autofocus value="{{ old('publisher', $book->publisher) }}">
            <span id="publisher-error"></span>
            @error('publisher')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="year" class="form-label">Year Book</label>
            <input type="text" placeholder="Enter year" id="year-val" name="year" onkeyup="validateYear()" class="form-control @error('year') is-invalid @enderror" autofocus value="{{ old('year', $book->year) }}">
            <span id="year-error"></span>
            @error('year')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="pages" class="form-label">Book Page</label>
            <input type="text" placeholder="Enter pages" id="pages-val" name="pages" onkeyup="validatePages()" class="form-control @error('pages') is-invalid @enderror" autofocus value="{{ old('pages', $book->pages) }}">
            <span id="pages-error"></span>
            @error('pages')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea onkeyup="validateDescription()" placeholder="Enter description" id="description-val" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
            <span id="description-error"></span>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="cover_image">Cover Book</label>
            <div class="col-sm-3">
                <img src="/images/default-image.png" class="img-thumbnail img-preview">
            </div>
            <input type="file" id="cover_image" name="cover_image" class="form-control  mt-2 @error('cover_image') is-invalid @enderror" aria-label="6" file example  onchange="previewImage()" value="{{ old('cover_image', $book->cover_image) }}"> 
            <div class="invalid-feedback">
            @error('cover_image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            </div>
        </div>
        
        <div class="mb-3">
            <label for="pdf_file">Upload PDF File</label>
            <input type="file" id="pdf_file" name="pdf_file" class="form-control mt-2 @error('pdf_file') is-invalid @enderror" aria-label="Upload PDF" accept=".pdf" value="{{ old('pdf_file', $book->pdf_file) }}"> 
            <div class="invalid-feedback">
                @error('pdf_file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
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
    let categoryError = document.getElementById('category-error');
    let authorError = document.getElementById('author-error');
    let publisherError = document.getElementById('publisher-error');
    let yearError = document.getElementById('year-error');
    let pagesError = document.getElementById('pages-error');
    let descriptionError = document.getElementById('description-error');
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

    function validateCategory() {
        let category = document.getElementById('category-val').value;

        if (category.length == 0) {
            categoryError.innerHTML = 'category is required';
            return false;
        }
        if(!category.match(/^[A-Za-z]*/)){
            categoryError.innerHTML = 'type category';
            return false;
        }
        categoryError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }

    function validateAuthor() {
        let author = document.getElementById('author-val').value;

        if (author.length == 0) {
            authorError.innerHTML = 'author is required';
            return false;
        }
        if(!author.match(/^[A-Za-z]*/)){
            authorError.innerHTML = 'type author';
            return false;
        }
        authorError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }

    function validatePublisher() {
        let publisher = document.getElementById('publisher-val').value;

        if (publisher.length == 0) {
            publisherError.innerHTML = 'publisher is required';
            return false;
        }
        if(!publisher.match(/^[A-Za-z]*/)){
            publisherError.innerHTML = 'type publisher';
            return false;
        }
        publisherError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }

    function validateYear() {
        let year = document.getElementById('year-val').value;

        if (year.length == 0) {
            yearError.innerHTML = 'year is required';
            return false;
        }
        if(!year.match(/^[A-Za-z]*/)){
            yearError.innerHTML = 'type year';
            return false;
        }
        yearError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }

    function validatePages() {
        let pages = document.getElementById('pages-val').value;

        if (pages.length == 0) {
            pagesError.innerHTML = 'pages is required';
            return false;
        }
        if(!pages.match(/^[A-Za-z]*/)){
            pagesError.innerHTML = 'type pages';
            return false;
        }
        pagesError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }

    function validateDescription() {
        let description = document.getElementById('description-val').value;
        let required = 10;
        let left = required - description.length;

        if (left > 0) {
            descriptionError.innerHTML = left + ' more characters required';
            return false;
        }
        descriptionError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
        return true;
    }


    function validateForm() {
        if(!validateTitle() || !validateDescription() || !validateAuthor() || !validatePublisher() || !validateCategory() || !validateYear() || !validatePages()) {
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
        const image = document.querySelector('#cover_image');
        const sampulLabel = document.querySelector('.custom-file-label')
        const imgPreview = document.querySelector('.img-preview');


        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(image.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
    
</script>