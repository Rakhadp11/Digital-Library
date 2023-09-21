<?php

namespace App\Http\Controllers\Web;

use App\Data\CategoryData;
use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        // $this->middleware('auth', ['except' => 'index', 'create']);
    }

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        }

        $categoryData = CategoryData::from($request->all());

        if (isset($imageName)) {
            $categoryData->image = $imageName;
        }

        $this->categoryService->storeCategory($categoryData);

        return redirect('/admin/category')->with('success', 'Category Added Successfully');
    }

    public function edit($id)
    {
        return view('category.editor', [
            'category' => $this->categoryService->editCategory($id),
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        }

        $categoryData = CategoryData::from($request->all());

        if ($imageName) {
            $categoryData->image = $imageName;
        }

        $this->categoryService->updateCategory($categoryData, $id);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        $this->categoryService->destroyCategory($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfuly'
        ]);
    }
}
