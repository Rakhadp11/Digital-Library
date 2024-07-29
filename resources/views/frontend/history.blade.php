@extends('frontend.layout.app')

@section('title', 'Riwayat')

@push('css')
    <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .content h1 {
                margin-bottom: 5px;
            }

            .content p {
                margin-bottom: 20px;
                color: #666;
            }

            .content {
                padding: 20px;
                text-align: center;
                width: 100%;
            }

            .container-riwayat {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }

            .book-list {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .book-card {
                display: flex;
                justify-content: space-between;
                width: 90%; 
                max-width: 700px; 
                border: 2px solid #ffeb3b;
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); 
            }

            .book-card.green-border {
                border-color: #88ff00;
            }

            .book-card img {
                height: 170px; 
                margin-right: 20px;
            }

            .book-details, .user-details {
                text-align: left;
            }

            .book-details p, .user-details p {
                margin: 5px 0;
            }

            .book-status {
                display: flex;
                align-items: center;
            }

            .book-status img {
                height: 20px;
                margin-left: 10px;
            }

            @media (max-width: 768px) {
                .book-card {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }

                .book-details, .user-details {
                    text-align: center;
                }

                .book-card img {
                    height: auto; 
                }
            }

    </style>
@endpush

@section('content')
<div class="container-riwayat">
    <h1>Riwayat Bacaan Buku</h1>
    @if($borrowings->isNotEmpty())
        @foreach ($borrowings as $borrowing)
            <div class="book-card {{ $borrowing->returned_at ? 'green-border' : '' }}">
                <img src="{{ asset('storage/' . $borrowing->book->cover_image) }}" alt="Book">
                <div class="book-details">
                    <p><strong>Judul Buku:</strong> {{ $borrowing->book->title ?? 'Tidak ada judul' }}</p>
                    <p><strong>Kategori:</strong> {{ $borrowing->book->category ?? 'Tidak ada kategori' }}</p>
                    <p><strong>Pengarang:</strong> {{ $borrowing->book->author ?? 'Tidak ada pengarang' }}</p>
                    <p><strong>Penerbit:</strong> {{ $borrowing->book->publisher ?? 'Tidak ada penerbit' }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $borrowing->book->year ?? 'Tidak ada tahun terbit' }}</p>
                </div>
                <div class="user-details">
                    <p><strong>Nama:</strong> {{ $borrowing->user->name ?? 'Tidak ada nama' }}</p>
                    <p><strong>No Telp:</strong> {{ $member->phone ?? 'Tidak ada no telp' }}</p>
                    <p><strong>Alamat:</strong> {{ $member->address ?? 'Tidak ada alamat' }}</p>
                    <p><strong>Tanggal:</strong> {{ $borrowing->borrowed_at ? $borrowing->borrowed_at : 'Tidak ada tanggal' }}</p>
                    <p class="book-status">
                        <strong>Status:</strong>
                        {{ $borrowing->approved ? 'Sudah diapprove' : 'Belum diapprove' }}
                        <i class="fa-regular fa-{{ $borrowing->approved ? 'circle-check' : 'clock fa-beat' }}" style="color: {{ $borrowing->approved ? '#63E6BE' : '#FFD43B' }};"></i>
                    </p>                    
                </div>
            </div>
        @endforeach
    @else
        <p>Tidak ada riwayat bacaan buku.</p>
    @endif
</div>
@endsection

@push('scripts')
    
@endpush