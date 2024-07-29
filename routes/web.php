<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedAdminSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberStatusController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SendEmail;
use App\Http\Controllers\SomeController;
use App\Http\Controllers\Web\Backend\AdminBorrowingController;
use App\Http\Controllers\Web\Backend\BookController;
use App\Http\Controllers\Web\Backend\CategoryController;
use App\Http\Controllers\Web\Backend\ExploreFeatureController;
use App\Http\Controllers\Web\Frontend\IndexController;
use App\Http\Controllers\Web\Backend\HeroController;
use App\Http\Controllers\Web\Backend\HeroFeatureController;
use App\Http\Controllers\Web\Backend\MemberController as BackendMemberController;
use App\Http\Controllers\Web\Backend\QuestionController;
use App\Http\Controllers\Web\Backend\QuizController;
use App\Http\Controllers\Web\Backend\ReturnBookController;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Frontend\BorrowingController;
use App\Http\Controllers\Web\Frontend\ListBookController;
use App\Http\Controllers\Web\Frontend\ListQuizController;
use Illuminate\Support\Facades\Route;

Route::get('/some-path', [SomeController::class, 'show'])->name('some.route');
Route::post('/store-data', [SomeController::class, 'store'])->name('store.data');

Route::middleware(['auth', 'role:0'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('frontend.index');
    Route::get('/list-book', [ListBookController::class, 'index'])->name('list-book');
    Route::get('book/{book}', [ListBookController::class, 'show'])->name('book.show');
    Route::get('/borrow-form/{book_id}', [BorrowingController::class, 'showForm'])->name('borrow.form');
    Route::post('/borrow', [BorrowingController::class, 'store'])->name('borrow.store');
    Route::get('/history', [BorrowingController::class, 'history'])->name('history');

    Route::get('/return', [BorrowingController::class, 'index'])->name('return.index');
    Route::get('/borrow/data', [BorrowingController::class, 'data'])->name('borrow.data');
    Route::get('/borrow/{id}', [BorrowingController::class, 'show'])->name('borrow.show');
    Route::post('/borrow/return/{id}', [BorrowingController::class, 'returnBook'])->name('borrow.return');

    Route::get('/list-quiz', [ListQuizController::class, 'index'])->name('list-quiz');
    Route::get('/quiz/{id}', [ListQuizController::class, 'show'])->name('frontend.quiz.show');
    Route::post('/quiz/{id}/result', [ListQuizController::class, 'result'])->name('quiz.result');

    Route::get('/member/{user}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::put('/member/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::post('/member/add', [MemberController::class, 'store'])->name('member.store');

    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/check-member-status', [MemberStatusController::class, 'check'])->name('check.member.status');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthenticatedAdminSessionController::class, 'create'])->name('admin.login');
    Route::post('/login', [AuthenticatedAdminSessionController::class, 'store'])->name('admin.login-store');
    Route::get('/register', [RegisteredAdminController::class, 'create'])->name('admin.register');
    Route::post('/register', [RegisteredAdminController::class, 'store'])->name('admin.register-store');
    Route::post('/logout', [AuthenticatedAdminSessionController::class, 'destroy'])->name('admin.logout');

    Route::middleware(['backend', 'auth', 'role:1'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['verified'])->name('dashboard');
        Route::get('/dashboard-data', [DashboardController::class, 'getDashboardData']);

        Route::get('/user', [UserController::class, 'index'])->name('user.admin');
        Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

        Route::get('/member', [BackendMemberController::class, 'index'])->name('member.admin');
        Route::delete('/member/delete/{id}', [BackendMemberController::class, 'destroy'])->name('member.delete');

        Route::get('/hero', [HeroController::class, 'index'])->name('hero');
        Route::get('/hero/create', [HeroController::class, 'create'])->name('hero.create');
        Route::post('/hero/add', [HeroController::class, 'store'])->name('hero.store');
        Route::get('/hero/edit/{id}', [HeroController::class, 'edit'])->name('hero.edit');
        Route::put('/hero/update/{id}', [HeroController::class, 'update'])->name('hero.update');
        Route::delete('/hero/delete/{id}', [HeroController::class, 'destroy'])->name('hero.delete');

        Route::get('/hero-feature', [HeroFeatureController::class, 'index'])->name('hero-feature');
        Route::get('/hero-feature/create', [HeroFeatureController::class, 'create'])->name('hero-feature.create');
        Route::post('/hero-feature/add', [HeroFeatureController::class, 'store'])->name('hero-feature.store');
        Route::get('/hero-feature/edit/{id}', [HeroFeatureController::class, 'edit'])->name('hero-feature.edit');
        Route::put('/hero-feature/update/{id}', [HeroFeatureController::class, 'update'])->name('hero-feature.update');
        Route::delete('/hero-feature/delete/{id}', [HeroFeatureController::class, 'destroy'])->name('hero-feature.delete');

        Route::get('/explore-feature', [ExploreFeatureController::class, 'index'])->name('explore-feature');
        Route::get('/explore-feature/create', [ExploreFeatureController::class, 'create'])->name('explore-feature.create');
        Route::post('/explore-feature/add', [ExploreFeatureController::class, 'store'])->name('explore-feature.store');
        Route::get('/explore-feature/edit/{id}', [ExploreFeatureController::class, 'edit'])->name('explore-feature.edit');
        Route::put('/explore-feature/update/{id}', [ExploreFeatureController::class, 'update'])->name('explore-feature.update');
        Route::delete('/explore-feature/delete/{id}', [ExploreFeatureController::class, 'destroy'])->name('explore-feature.delete');

        Route::get('/book', [BookController::class, 'index'])->name('book');
        Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/book/add', [BookController::class, 'store'])->name('book.store');
        Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
        Route::put('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/book/delete/{id}', [BookController::class, 'destroy'])->name('book.delete');
        Route::post('/books/toggle-availability', [BookController::class, 'toggleAvailability'])->name('books.toggleAvailability');
        Route::get('/borrow', [AdminBorrowingController::class, 'index'])->name('borrow.index');
        Route::post('/borrow/approve/{id}', [AdminBorrowingController::class, 'approve'])->name('admin.borrow.approve');
        Route::get('/borrow/create', [AdminBorrowingController::class, 'create'])->name('borrow.create');
        Route::delete('/borrow/delete/{id}', [AdminBorrowingController::class, 'destroy'])->name('borrow.delete');

        Route::get('/returnbook', [ReturnBookController::class, 'index'])->name('returnbook');
        Route::delete('returnbook/{id}', [ReturnBookController::class, 'destroy'])->name('returnbook.delete');

        Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.admin');
        Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
        Route::post('/quiz/add', [QuizController::class, 'store'])->name('quiz.store');
        Route::get('/quiz/edit/{id}', [QuizController::class, 'edit'])->name('quiz.edit');
        Route::put('/quiz/update/{id}', [QuizController::class, 'update'])->name('quiz.update');
        Route::delete('/quiz/delete/{id}', [QuizController::class, 'destroy'])->name('quiz.delete');

        Route::get('/question', [QuestionController::class, 'index'])->name('question');
        Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create');
        Route::post('/question/add', [QuestionController::class, 'store'])->name('question.store');
        Route::get('/question/edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
        Route::put('/question/update/{id}', [QuestionController::class, 'update'])->name('question.update');
        Route::delete('/question/delete/{id}', [QuestionController::class, 'destroy'])->name('question.delete');
    });
});

Route::get('export-categories', [CategoryController::class, 'export'])->name('categories.export');
Route::get('export-hero', [HeroController::class, 'export'])->name('hero.export');
Route::get('export-hero-feature', [HeroFeatureController::class, 'export'])->name('hero-feature.export');
Route::get('export-explore-feature', [ExploreFeatureController::class, 'export'])->name('explore-feature.export');
Route::get('export-book', [BookController::class, 'export'])->name('book.export');
Route::get('export-borrow-book', [AdminBorrowingController::class, 'export'])->name('borrow.export');
Route::get('export-return-book', [ReturnBookController::class, 'export'])->name('returnbook.export');
Route::get('export-member', [BackendMemberController::class, 'export'])->name('member.export');
Route::get('export-user', [UserController::class, 'export'])->name('user.export');
Route::get('export-quiz', [QuizController::class, 'export'])->name('quiz.export');
Route::get('export-question', [QuestionController::class, 'export'])->name('question.export');


Route::get('send-email', [SendEmail::class, 'index']);


require __DIR__ . '/auth.php';
