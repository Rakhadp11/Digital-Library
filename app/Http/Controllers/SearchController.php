<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Notification;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $results = Book::where('title', 'like', "%$query%")
            ->orWhere('author', 'like', "%$query%")
            ->orWhere('publisher', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhereYear('year', '=', $query)
            ->get();

        $notifications = Notification::where('read', false)->get();

        return view('frontend.search-result', compact('results', 'query', 'notifications'));
    }
}
