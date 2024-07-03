<?php 

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\HeroFeatureDataTable;
use App\Exports\HeroFeatureExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroFeatureRequest;
use App\Models\HeroFeature;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HeroFeatureController extends Controller
{
    public function index(HeroFeatureDataTable $dataTable)
    {
        return $dataTable->render('backend.hero-feature.index');
    }

    public function create()
    {
        return view('backend.hero-feature.create');
    }

    public function store(HeroFeatureRequest $request)
    {
        $heroFeatureData = $request->all();

        HeroFeature::create($heroFeatureData);

        return redirect('/admin/hero-feature')->with('success', 'Hero Feature Added Successfully');
    }

    public function edit($id)
    {
        $heroFeature = HeroFeature::findOrFail($id);
        return view('backend.hero-feature.editor', compact('heroFeature'));
    }

    public function update(HeroFeatureRequest $request, $id)
    {
        $heroFeatureData = $request->all();

        $heroFeature = HeroFeature::findOrFail($id);
        $heroFeature->update($heroFeatureData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        HeroFeature::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new HeroFeatureExport, 'HeroFeature.xlsx');
    }
}
