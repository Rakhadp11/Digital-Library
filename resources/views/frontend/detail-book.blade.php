@extends('frontend.layout.app')

@section('title', 'Detail Buku')

@section('content')
    <div class="container">
        <div class="info-box info">
            <p><strong><i class="fa-solid fa-circle-info"></i> Informasi</strong></p>
            <p>Terdapat Data Buku yang tidak tersedia secara online dalam format PDF</p>
        </div>

        <div class="card">
            <div class="image-container-book">
                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-image.png') }}" alt=" Book Cover">
            </div>

            <div class="book-info">
                <div>
                    <label class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" value="{{ $book->title }}" disabled>
                </div>
                <div>
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" id="kategori" class="form-control" value="{{ $book->category }}" disabled>
                </div>
                <div>
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" id="pengarang" class="form-control" value="{{ $book->author }}" disabled>
                </div>
                <div>
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" id="penerbit" class="form-control" value="{{ $book->publisher }}" disabled>
                </div>
                <div>
                    <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                    <input type="text" id="tahunTerbit" class="form-control" value="{{ $book->year }}" disabled>
                </div>
                <div>
                    <label for="jumlahHalaman" class="form-label">Jumlah Halaman</label>
                    <input type="text" id="jumlahHalaman" class="form-control" value="{{ $book->pages }}" disabled>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsiBuku" class="form-label">Deskripsi Buku</label>
                <textarea id="deskripsiBuku" class="form-control" rows="3" disabled>{{ $book->description }}</textarea>
            </div>

            <div class="pdf-icon">
                <img src="{{ asset('images/pdf.png') }}" alt="PDF Icon">
                @if($book->pdf_file)
                    <a href="{{ asset('storage/' . $book->pdf_file) }}" class="btn btn-danger">Baca Buku</a>
                @else
                    <a href="#" class="btn btn-danger disabled">Buku tidak tersedia dalam format PDF</a>
                @endif
            </div>

            <div class="actions">
                @if($isMember)
                @if($book->is_available)
                    <a href="{{ route('borrow.form', ['book_id' => $book->id]) }}" class="btn btn-success">Pinjam</a>
                @else
                    <a href="#" class="btn btn-danger disabled">Tidak Tersedia</a>
                @endif
            @else
                <p class="text-danger">Anda harus terdaftar sebagai member untuk meminjam buku ini.</p>
            @endif
            
            </div>
            
        </div>
    </div>
@endsection

@push('css')
    <style>
        .container-book {
            max-width: 900px;
            margin-top: 50px;
            background-color: #f8f9fa;
        }
        .info-box {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .info-box.danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .info-box.info {
            background-color: #e7f3ff;
            color: #0c5460;
            border-color: #b8daff;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .image-container-book {
            display: flex;
            justify-content: center; 
            align-items: center; 
            padding: 15px;
        }

        .image-container-book img {
            width: 300px;
            height: auto;
            border-radius: 10px;
        }
        .form-control[disabled], .form-control[readonly] {
            background-color: #fff;
        }
        .book-info {
            display: flex;
            flex-wrap: wrap;
        }
        .book-info > div {
            flex: 1 1 45%;
            margin-bottom: 20px;
        }
        .pdf-icon {
            display: flex;
            align-items:flex-start;
            justify-content:start;
            flex-direction: column;
        }
        .pdf-icon img {
            margin-left: 1.5em;
        }
        .pdf-icon img {
            width: 50px;
            margin-bottom: 10px;
        }
        .actions {
            display: flex;
            align-items:flex-end;
            justify-content:end;
            margin-top: 5em;
        }
    </style>
@endpush