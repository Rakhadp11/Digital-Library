<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\ExploreFeatureDataTable;
use App\Exports\ExploreFeatureExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExploreFeatureRequest;
use App\Models\ExploreFeature;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExploreFeatureController extends Controller
{
    public function index(ExploreFeatureDataTable $dataTable)
    {
        return $dataTable->render('backend.explore-feature.index');
    }

    public function create()
    {
        return view('backend.explore-feature.create');
    }

    public function store(ExploreFeatureRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $exploreFeatureData = $request->all();
        if (isset($imageName)) {
            $exploreFeatureData['image'] = $imageName;
        }

        ExploreFeature::create($exploreFeatureData);

        return redirect('/admin/explore-feature')->with('success', 'Explore Feature Added Successfully');
    }

    public function edit($id)
    {
        $exploreFeature = ExploreFeature::findOrFail($id);
        return view('backend.explore-feature.editor', compact('exploreFeature'));
    }

    public function update(ExploreFeatureRequest $request, $id)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $exploreFeatureData = $request->all();
        if ($imageName) {
            $exploreFeatureData['image'] = $imageName;
        }

        $exploreFeature = ExploreFeature::findOrFail($id);
        $exploreFeature->update($exploreFeatureData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        ExploreFeature::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new ExploreFeatureExport, 'ExploreFeature.xlsx');
    }
}

