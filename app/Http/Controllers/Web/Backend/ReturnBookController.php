<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\ReturnBookDataTable;
use App\Exports\ReturnBookExport;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ReturnBook;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReturnBookController extends Controller
{
    public function index(ReturnBookDataTable $dataTable)
    {
        return $dataTable->render('backend.return-book.index');
    }

    public function destroy($id)
    {
        try {
            $returnBook = ReturnBook::findOrFail($id);
            $book = $returnBook->borrowing->book;

            Notification::create([
                'user_id' => Auth::id(),
                'type' => 'Pengembalian Buku',
                'data' => 'Anda telah mengembalikan buku "' . $book->title . '"',
                'read' => false,
            ]);

            $returnBook->delete();

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus ReturnBook dengan ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    public function export()
    {
        return Excel::download(new ReturnBookExport, 'Data Pengembalian Buku.xlsx');
    }
}
