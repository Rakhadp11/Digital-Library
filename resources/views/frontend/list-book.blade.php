@extends('frontend.layout.app')

@section('title', 'Edit Member')

@push('css')
<style>
    .book-card {
        margin-bottom: 20px;
    }
    .card {
        height: 100%; /* Membuat tinggi card seragam */
        display: flex;
        flex-direction: column;
    }

    .card-img-top {
        width: 100%;
        height: 350px; /* Menetapkan tinggi tetap untuk gambar */
        object-fit: contain; /* Gambar tidak akan terpotong dan akan menyesuaikan dalam ruang yang tersedia */
    }
    .card-title {
        font-size: 18px;
        font-weight: bold;
    }
    .card-text {
        font-size: 14px;
    }
    .btn-custom {
        background-color: #ffcc00;
        color: #000;
    }
    .category-section {
        margin: 20px 0;
    }
    .category-section button {
        margin-right: 10px;
    }
    .filter {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }
    @media (max-width: 720px) {
        .filter {
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="row my-4">
        <div class="col text-center">
            <h1>Repository Buku</h1>
        </div>
    </div>
    <div class="row">
        <div class="col filter">
            <button class="btn btn-secondary" onclick="sortBooks('newest')">Newest</button>
            <button class="btn btn-secondary" onclick="sortBooks('a-z')">A-Z</button>
            <button class="btn btn-secondary" id="categoryFilterBtn" data-toggle="collapse" data-target="#categorySection" aria-expanded="false" aria-controls="categorySection">Filter</button>
        </div>
    </div>
    <div class="row category-section collapse" id="categorySection">
        <div class="col text-center">
            <button class="btn btn-outline-secondary" onclick="filterBooks('all')">All</button>
            <button class="btn btn-outline-secondary" onclick="filterBooks('novel')">Novel</button>
            <button class="btn btn-outline-secondary" onclick="filterBooks('fiksi')">Fiksi</button>
            <button class="btn btn-outline-secondary" onclick="filterBooks('non-fiksi')">Non Fiksi</button>
            <button class="btn btn-outline-secondary" onclick="filterBooks('edukasi')">Edukasi</button>
            <button class="btn btn-outline-secondary" onclick="filterBooks('komik')">Komik</button>
            <button class="btn btn-outline-secondary" onclick="filterBooks('sejarah')">Sejarah</button>
        </div>
    </div>
    <div class="row" id="booksContainer">
        @foreach($books as $book)
        <div class="col-md-3 book-card" data-category="{{ strtolower($book->category) }}">
            <div class="card">
                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-image.png') }}" class="card-img-top" alt="{{ $book->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ $book->category }}</p>
                    <a href="{{ route('book.show', $book) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    function sortBooks(method) {
        let booksContainer = document.getElementById('booksContainer');
        let books = Array.from(booksContainer.getElementsByClassName('book-card'));

        if (method === 'a-z') {
            books.sort((a, b) => {
                let titleA = a.getElementsByClassName('card-title')[0].innerText.toUpperCase();
                let titleB = b.getElementsByClassName('card-title')[0].innerText.toUpperCase();
                return (titleA < titleB) ? -1 : (titleA > titleB) ? 1 : 0;
            });
        } else if (method === 'newest') {
            books.sort((a, b) => b.dataset.index - a.dataset.index);
        }

        books.forEach(book => booksContainer.appendChild(book));
    }

    function filterBooks(category) {
        let booksContainer = document.getElementById('booksContainer');
        let books = booksContainer.getElementsByClassName('book-card');

        for (let i = 0; i < books.length; i++) {
            let book = books[i];
            if (category === 'all' || book.getAttribute('data-category') === category) {
                book.style.display = 'block';
            } else {
                book.style.display = 'none';
            }
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush
