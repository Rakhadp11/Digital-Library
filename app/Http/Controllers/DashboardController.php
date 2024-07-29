<?php

namespace App\Http\Controllers;

use App\DataTables\BorrowingDataTable;
use App\DataTables\MemberDataTable;
use App\DataTables\ReturnBookDataTable;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use App\Models\ReturnBook;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalBorrowed = Borrowing::count();
        $totalReturned = ReturnBook::count();
        $totalMembers = Member::count();

        return view('backend.layout.app', compact('totalBorrowed', 'totalReturned', 'totalMembers'));
    }

    public function getDashboardData()
    {
        $borrowedMonthlyData = \DB::table('borrowings')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $borrowedLabels = $borrowedMonthlyData->pluck('month')->map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 1));
        })->toArray();

        $borrowedValues = $borrowedMonthlyData->pluck('count')->toArray();

        $returnedMonthlyData = \DB::table('return_books') 
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $returnedLabels = $returnedMonthlyData->pluck('month')->map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 1));
        })->toArray();

        $returnedValues = $returnedMonthlyData->pluck('count')->toArray();

        $membersMonthlyData = \DB::table('members') 
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $membersLabels = $membersMonthlyData->pluck('month')->map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 1));
        })->toArray();

        $membersValues = $membersMonthlyData->pluck('count')->toArray();

        return response()->json([
            'borrowedLabels' => $borrowedLabels,
            'borrowedValues' => $borrowedValues,
            'returnedLabels' => $returnedLabels,
            'returnedValues' => $returnedValues,
            'membersLabels' => $membersLabels,
            'membersValues' => $membersValues,
        ]);
    }
}
