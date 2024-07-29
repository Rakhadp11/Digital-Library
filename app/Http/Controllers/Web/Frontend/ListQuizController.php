<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListQuizController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->input('category', null);

        $categories = Quiz::select('category')
            ->distinct()
            ->get()
            ->pluck('category');

        $quizzes = Quiz::query()
            ->when($selectedCategory, function ($query, $selectedCategory) {
                return $query->where('category', $selectedCategory);
            })
            ->orderBy('category') 
            ->get();
        return view('frontend.list-quiz', compact('quizzes', 'categories', 'selectedCategory'));
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('frontend.quiz', compact('quiz'));
    }

    public function result(Request $request, $id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            abort(404, 'Quiz not found');
        }

        $answers = $request->input('answers');
        $correctAnswers = 0;
        $totalQuestions = count($quiz->questions);

        // Hitung jawaban yang benar
        foreach ($quiz->questions as $index => $question) {
            if ($question->correct_answer == $answers[$index]) {
                $correctAnswers++;
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'Hasil Kuis',
            'data' => 'Anda telah menyelesaikan kuis "' . $quiz->title . '" dengan skor ' . round($score, 2) . '%',
            'read' => false,
        ]);

        return view('frontend.result-quiz', compact('quiz', 'score', 'correctAnswers', 'totalQuestions'));
    }
}
