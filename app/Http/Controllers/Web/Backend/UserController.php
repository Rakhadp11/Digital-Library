<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\UserDataTable;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('backend.user.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user.editor', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new UserExport, 'Data User.xlsx');
    }
}
