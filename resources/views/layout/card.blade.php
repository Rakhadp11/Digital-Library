@extends('layouts.app')

@push('css')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .dashboard {
        display: flex;
        justify-content: space-around;
        margin: 20px;
    }
    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        width: 250px;
        margin: 10px;
    }
    .card h3 {
        margin: 0;
        font-size: 2.5em;
    }
    .card p {
        margin: 10px 0 0;
        font-size: 1.2em;
        color: #666;
    }
    .card.more-info {
        color: #007bff;
        text-decoration: none;
        font-size: 1em;
        display: block;
        margin-top: 10px;
    }
    .card.borrow {
        background-color: #00c0ef;
        color: #fff;
    }
    .card.return {
        background-color: #00a65a;
        color: #fff;
    }
</style>
@endpush

@section('title', 'Dashboard')

@section('content')
<div class="dashboard">
    <div class="card borrow">
        <h3>{{ $borrowCount }}</h3>
        <p>Books Borrowed</p>
        <a href="#" class="more-info">More info</a>
    </div>
    <div class="card return">
        <h3>{{ $returnCount }}</h3>
        <p>Books Returned</p>
        <a href="#" class="more-info">More info</a>
    </div>
</div>
@endsection
