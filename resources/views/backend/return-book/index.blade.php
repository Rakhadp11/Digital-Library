@extends('backend.layout.app')

@section('title', 'Return Book')

@push('css')
@endpush

@section('content')
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header text-center">Return Book Table</div>
            <div class="card-body">
                <div class="text-left mb-2">
                    <a href="{{ route('returnbook.export') }}" class="btn btn-success"><i class="fa-solid fa-file-export"></i> Export</a>
                </div>
                {{ $dataTable->table() }}
            </div>
        </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
