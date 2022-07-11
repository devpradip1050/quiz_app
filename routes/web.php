<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('hello', function(){
    return view('admin.layout.main');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();





// User Route

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/exam', [App\Http\Controllers\QuizController::class, 'selectExam'])->name('user.select.exam');
    Route::get('/start_exam/{exam_category}', [App\Http\Controllers\QuizController::class, 'startExam']);
    Route::get('/load_timer', [App\Http\Controllers\QuizController::class, 'loadTimer']);
    Route::get('/load_total_que', [App\Http\Controllers\QuizController::class, 'loadTotalQuestion']);
    Route::get('/load_questions/{questionno}', [App\Http\Controllers\QuizController::class, 'loadQuestions']);
    Route::get('/save_ans_ses/{radiovalue}/{questionno}', [App\Http\Controllers\QuizController::class, 'saveAnswer']);
    
    Route::get('/result', [App\Http\Controllers\QuizController::class, 'result']);

    
    Route::post('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'userLogout'])->name('user.logout');
});




// Admin route

Route::group(['prefix'=>'admin'], function(){
    Route::group(['middleware'=>'admin.guest'], function(){
        Route::view('/login','admin.login')->name('admin.login');
        Route::post('/login',[App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
    });
    Route::group(['middleware'=>'admin.auth'], function(){
        Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

        //Student Route
        Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('admin.index');
        Route::get('/add_student', [App\Http\Controllers\StudentController::class, 'create'])->name('admin.add.student');
        Route::post('/add_student', [App\Http\Controllers\StudentController::class, 'store'])->name('admin.store.student');
        Route::get('/delete_student/{id}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('admin.student.delete');
        Route::get('/edit_student/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('admin.student.edit');
        Route::post('/edit_student/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('admin.update.student');


        // Exam Route
        Route::get('/exam', [App\Http\Controllers\ExamController::class, 'index'])->name('exam.index');
        Route::get('/add_exam', [App\Http\Controllers\ExamController::class, 'create'])->name('admin.add.exam');
        Route::post('/add_exam', [App\Http\Controllers\ExamController::class, 'store'])->name('admin.store.exam');
        Route::get('/delete_exam/{id}', [App\Http\Controllers\ExamController::class, 'destroy'])->name('admin.exam.delete');
        Route::get('/edit_exam/{id}', [App\Http\Controllers\ExamController::class, 'edit'])->name('admin.exam.edit');
        Route::post('/edit_exam/{id}', [App\Http\Controllers\ExamController::class, 'update'])->name('admin.exam.update');

        // Question Route
        Route::get('/question', [App\Http\Controllers\QuestionController::class, 'index'])->name('question.index');
        Route::get('/add_question', [App\Http\Controllers\QuestionController::class, 'create'])->name('admin.question.add');
        Route::post('/question_store', [App\Http\Controllers\QuestionController::class, 'store'])->name('admin.question.store');
        Route::get('/question_delete/{id}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('admin.question.delete');
        Route::get('/question_edit/{id}', [App\Http\Controllers\QuestionController::class, 'edit'])->name('admin.question.edit');
        Route::post('/question_edit/{id}', [App\Http\Controllers\QuestionController::class, 'update'])->name('admin.question.update');
        
        //Result Route
        Route::get('/result_management', [App\Http\Controllers\DashboardController::class, 'result'])->name('result.index');
        
    });
});
