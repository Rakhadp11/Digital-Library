<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\BookDataTable;
use App\Exports\BookExport;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class BookController extends Controller
{
    public function index(BookDataTable $dataTable)
    {
        return $dataTable->render('backend.book.index');
    }

    public function create()
    {
        return view('backend.book.create');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('backend.book.editor', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'nullable',
            'pages' => 'nullable',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048000',
            'pdf_file' => 'file|mimes:pdf|max:1000000',
        ]);

        $coverImagePath = $request->file('cover_image') ? $request->file('cover_image')->store('covers', 'public') : null;
        $pdfFilePath = $request->file('pdf_file') ? $request->file('pdf_file')->store('pdfs', 'public') : null;

        Book::create([
            'title' => $request->title,
            'category' => $request->category,
            'cover_image' => $coverImagePath,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'pages' => $request->pages,
            'description' => $request->description,
            'pdf_file' => $pdfFilePath,
        ]);

        return redirect()->route('book')->with('success', 'Book created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'nullable',
            'pages' => 'nullable',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048000',
            'pdf_file' => 'file|mimes:pdf|max:1000000',
        ]);

        $book = Book::findOrFail($id);

        $coverImagePath = $book->cover_image;
        $pdfFilePath = $book->pdf_file;

        if ($request->file('cover_image')) {
            if ($coverImagePath) {
                Storage::disk('public')->delete($coverImagePath);
            }
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        if ($request->file('pdf_file')) {
            if ($pdfFilePath) {
                Storage::disk('public')->delete($pdfFilePath);
            }
            $pdfFilePath = $request->file('pdf_file')->store('pdfs', 'public');
        }

        $book->update([
            'title' => $request->title,
            'category' => $request->category,
            'cover_image' => $coverImagePath,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'pages' => $request->pages,
            'description' => $request->description,
            'pdf_file' => $pdfFilePath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully',
        ]);
    }

    public function destroy($id)
    {
        Book::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function toggleAvailability(Request $request)
    {
        $book = Book::find($request->id);
        if ($book) {
            $book->is_available = !$book->is_available;
            $book->save();

            return response()->json([
                'status' => 'success',
                'is_available' => $book->is_available
            ]);
        }

        return response()->json(['status' => 'error'], 404);
    }

    public function export()
    {
        return Excel::download(new BookExport, 'Data Buku.xlsx');
    }
}
