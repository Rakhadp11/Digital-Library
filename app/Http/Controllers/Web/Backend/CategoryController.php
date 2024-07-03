<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\CategoryDataTable;
use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.category.index');
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $categoryData = $request->all();
        if (isset($imageName)) {
            $categoryData['image'] = $imageName;
        }

        Category::create($categoryData);

        return redirect('/admin/category')->with('success', 'Category Added Successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.editor', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $categoryData = $request->all();
        if ($imageName) {
            $categoryData['image'] = $imageName;
        }

        $category = Category::findOrFail($id);
        $category->update($categoryData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new CategoryExport, 'Category.xlsx');
    }
}

