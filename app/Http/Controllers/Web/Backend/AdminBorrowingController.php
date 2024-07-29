<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\BorrowingDataTable;
use App\Exports\BorrowingExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Maatwebsite\Excel\Facades\Excel;

class AdminBorrowingController extends Controller
{
    public function index(BorrowingDataTable $dataTable)
    {
        return $dataTable->render('backend.borrowing.index');
    }

    public function approve($id)
    {
        try {
            $borrowing = Borrowing::findOrFail($id);

            $borrowing->approved = true;
            $borrowing->save();

            $borrowing->book->is_available = false;
            $borrowing->book->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Peminjaman tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyetujui peminjaman.'], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $borrowing = Borrowing::findOrFail($id);
            $borrowing->delete();

            return response()->json(['success' => true, 'message' => 'Borrowing successfully deleted.']);
        } catch (\Exception $e) {
            \Log::error('Error deleting borrowing: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting borrowing.'], 500);
        }
    }

    public function export()
    {
        return Excel::download(new BorrowingExport, 'Data Peminjaman Buku.xlsx');
    }
}
