<?php

namespace App\Http\Controllers\Web\Backend;

use App\DataTables\QuestionDataTable;
use App\Exports\QuestionExport;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function index(QuestionDataTable $dataTable)
    {
        return $dataTable->render('backend.question.index');
    }

    public function create()
    {
        $quizzes = Quiz::all();
        return view('backend.question.create', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'options' => 'required|array|min:4|max:4',
            'options.*' => 'required|string',
            'correct_answer' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public', $imageName);
        }

        $questionData = $request->except(['_token', '_method', 'image']);
        $questionData['options'] = $request->input('options'); 

        if (isset($imageName)) {
            $questionData['image'] = $imageName;
        }

        Question::create($questionData);

        return redirect()->route('question')->with('success', 'Question added successfully');
    }


    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quiz::all();

        return view('backend.question.editor', compact('question', 'quizzes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'options' => 'required|array|min:4|max:4',
            'options.*' => 'required|string',
            'correct_answer' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $question = Question::findOrFail($id);

        $imageName = $question->image;

        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('storage/' . $imageName))) {
                unlink(public_path('storage/' . $imageName));
            }

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public', $imageName);
        }

        $questionData = $request->except('image');
        $questionData['image'] = $imageName;

        $questionData['options'] = $request->input('options');

        $question->update($questionData);

        return redirect()->route('question')->with('success', 'Question updated successfully');
    }


    public function destroy($id)
    {
        Question::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully'
        ]);
    }

    public function export()
    {
        return Excel::download(new QuestionExport, 'Question Quiz.xlsx');
    }
}
