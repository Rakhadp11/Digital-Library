@extends('frontend.layout.app')

@section('content')
<div class="container">
    <h1>Hasil Pencarian</h1>

    @if($results->count() > 0)
        <div class="row">
            @foreach($results as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">

                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Penulis: {{ $book->author }}</p>
                            <p class="card-text">Penerbit: {{ $book->publisher }}</p>
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Tidak ada hasil yang ditemukan untuk "<strong>{{ $query }}</strong>".
        </div>
    @endif

    @if($notifications->count() > 0)
        <div class="mt-4">
            @foreach($notifications as $notification)
                <div class="alert alert-info">
                    <strong>{{ $notification->type }}</strong>: {{ $notification->data }}
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('css')
<style>
    .card-img-top {
        width: 150px;
        height: 250px;
    }

    .card {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>

@endpush
