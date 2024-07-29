<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Notification;
use App\Models\ReturnBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class BorrowingController extends Controller
{
    public function showForm($book_id)
    {
        $user = Auth::user();
        $member = $user->member;
        $book = Book::findOrFail($book_id);

        return view('frontend.form-pinjam', compact('user', 'member', 'book'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'book_id' => 'required|exists:books,id',
                'borrowed_at' => 'required|date|after_or_equal:today',
                'returned_at' => 'required|date|after:borrowed_at',
            ]);

            $validatedData['user_id'] = Auth::id();

            $borrowing = Borrowing::create($validatedData);

            $book = Book::find($validatedData['book_id']);
            $book->is_available = false;
            $book->save();

            Notification::create([
                'user_id' => Auth::id(),
                'type' => 'Peminjaman Buku',
                'data' => 'Anda telah meminjam buku "' . $book->title . '"',
                'read' => false,
            ]);

            $redirectUrl = URL::route('list-book');

            return response()->json([
                'success' => true,
                'message' => 'Peminjaman berhasil disimpan!',
                'redirect_url' => $redirectUrl
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error in store method: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.'
            ], 500);
        }
    }

    public function history()
    {
        $user = auth()->user();
        $member = $user->member;

        $borrowings = Borrowing::with('user', 'book')
            ->where('user_id', $user->id)
            ->get();

        return view('frontend.history', compact('borrowings','user', 'member'));
    }

    public function index()
    {
        return view('frontend.return');
    }

    public function data()
    {
        $userId = Auth::id();
        $borrowings = Borrowing::with('user', 'book')
            ->where('user_id', $userId)
            ->get();

        return DataTables::of($borrowings)
            ->editColumn('book.cover_image', function ($data) {
                return '<img src="' . asset('storage/' . $data->book->cover_image) . '" alt="Image" width="100">';
            })
            ->addColumn('status', function ($row) {
                return $row->approved ? 'Sudah Disetujui' : 'Belum Disetujui';
            })
            ->addColumn('action', function ($row) {
                $btn = '<button class="btn btn-info ml-2" onclick="showDetails(' . $row->id . ')" ';

                if (!$row->approved) {
                    $btn .= 'disabled';
                }

                $btn .= '>Rincian</button>';

                if (!$row->returned_at) {
                    $btn .= '<button class="btn btn-success ml-2" onclick="returnBook(' . $row->id . ')">Kembalikan</button>';
                }

                return $btn;
            })
            ->rawColumns(['book.cover_image', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $borrowing = Borrowing::with('user', 'book')->findOrFail($id);
        return response()->json($borrowing);
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        ReturnBook::create([
            'book_id' => $borrowing->book_id,
            'user_id' => $borrowing->user_id,
            'borrowed_at' => $borrowing->borrowed_at,
            'returned_at' => now(),
        ]);

        $borrowing->returned_at = now();
        $borrowing->save();

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'Pengembalian Buku',
            'data' => 'Anda telah mengembalikan buku "' . $borrowing->book->title . '" dengan sukses.',
            'read' => false,
        ]);

        $borrowing->book->is_available = true;
        $borrowing->book->save();
        $borrowing->delete();

        return response()->json(['success' => true]);
    }
}
