<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\QuizDataTable;
use App\Exports\QuizExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuizController extends Controller
{
    public function index(QuizDataTable $dataTable)
    {
        return $dataTable->render('backend.quiz.index');
    }

    public function create()
    {
        return view('backend.quiz.create');
    }

    public function store(QuizRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $quizData = $request->all();
        if (isset($imageName)) {
            $quizData['image'] = $imageName;
        }

        Quiz::create($quizData);

        return redirect('/admin/quiz')->with('success', 'Quiz Added Successfully');
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('backend.quiz.editor', compact('quiz'));
    }

    public function update(QuizRequest $request, $id)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage'), $imageName);
        }

        $quizData = $request->all();
        if ($imageName) {
            $quizData['image'] = $imageName;
        }

        $quiz = Quiz::findOrFail($id);
        $quiz->update($quizData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Successfully'
        ]);
    }

    public function destroy($id)
    {
        Quiz::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new QuizExport, 'Quiz.xlsx');
    }
}
