<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\MemberDataTable;
use App\Exports\MemberExport;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function index(MemberDataTable $dataTable)
    {
        return $dataTable->render('backend.member.index');
    }

    public function destroy($id)
    {
        Member::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new MemberExport, 'Member.xlsx');
    }
}
