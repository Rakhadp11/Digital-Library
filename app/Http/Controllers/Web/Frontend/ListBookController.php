<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class ListBookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('frontend.list-book', [
            'books' =>  $books
        ]);
    }

    public function show(Book $book)
    {
        $isMember = Auth::check() ? Member::where('user_id', Auth::id())->exists() : false;
        return view('frontend.detail-book', compact('book', 'isMember'));
    }
}
