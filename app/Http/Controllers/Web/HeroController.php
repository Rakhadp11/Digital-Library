<?php

namespace App\Http\Controllers\Web;

use App\Data\HeroData;
use App\DataTables\HeroDataTable;
use App\Exports\HeroExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroRequest;
use App\Services\HeroService;
use Maatwebsite\Excel\Facades\Excel;

class HeroController extends Controller
{
    protected $HeroService;

    public function __construct(HeroService $HeroService)
    {
        $this->HeroService = $HeroService;
        // $this->middleware('auth', ['except' => 'index', 'create']);
    }

    public function index(HeroDataTable $dataTable)
    {
        return $dataTable->render('hero.index');
    }

    public function create()
    {
        return view('hero.create');
    }

    public function store(HeroRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $HeroData = HeroData::from($request->all());

        if (isset($imageName)) {
            $HeroData->image = $imageName;
        }

        $this->HeroService->storeHero($HeroData);

        return redirect('/admin/hero')->with('success', 'Hero Added Successfully');
    }

    public function edit($id)
    {
        return view('hero.editor', [
            'hero' => $this->HeroService->editHero($id),
        ]);
    }

    public function update(HeroRequest $request, $id)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $HeroData = HeroData::from($request->all());

        if ($imageName) {
            $HeroData->image = $imageName;
        }

        $this->HeroService->updateHero($HeroData, $id);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        $this->HeroService->destroyHero($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfuly'
        ]);
    }
    public function export()
    {
        return Excel::download(new HeroExport, 'Hero.xlsx');
    }
}
