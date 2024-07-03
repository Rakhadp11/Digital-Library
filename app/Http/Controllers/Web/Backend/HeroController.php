<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\HeroDataTable;
use App\Exports\HeroExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroRequest;
use App\Models\Hero;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HeroController extends Controller
{
    public function index(HeroDataTable $dataTable)
    {
        return $dataTable->render('backend.hero.index');
    }

    public function create()
    {
        return view('backend.hero.create');
    }

    public function store(HeroRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $heroData = $request->all();
        if (isset($imageName)) {
            $heroData['image'] = $imageName;
        }

        Hero::create($heroData);

        return redirect('/admin/hero')->with('success', 'Hero Added Successfully');
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        return view('backend.hero.editor', compact('hero'));
    }

    public function update(HeroRequest $request, $id)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $heroData = $request->all();
        if ($imageName) {
            $heroData['image'] = $imageName;
        }

        $hero = Hero::findOrFail($id);
        $hero->update($heroData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        Hero::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new HeroExport, 'Hero.xlsx');
    }
}
