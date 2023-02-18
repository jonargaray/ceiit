<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\StripeController;


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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// SYSTEM ADMINISTRATOR
Route::group(['prefix' => 'system-admin', 'as' => 'system-admin.', 'middleware'=>'system-administrator'], function () {
    
    Route::group(['prefix' => 'dashboards', 'as' => 'dashboards.'], function () { 
        Route::get('/index', 'App\Http\Controllers\SystemAdminDashboardController@index')->name('index');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () { 
        Route::get('/index', 'App\Http\Controllers\UserController@index')->name('index');
        Route::get('/students', 'App\Http\Controllers\UserController@students')->name('students');
        Route::get('/profile/{id}', 'App\Http\Controllers\UserController@profile')->name('profile');
        Route::post('/update/{id}', 'App\Http\Controllers\UserController@update')->name('update');
        Route::get('/assessments/{user_id}', 'App\Http\Controllers\UserController@assessments')->name('assessments');
        Route::get('/assessment-details/{assessment_id}', 'App\Http\Controllers\UserController@assessmentDetails')->name('assessment-details');
    });
});


// OFFICER
Route::group(['prefix' => 'officer', 'as' => 'officer.', 'middleware'=>'officer'], function () {
    
    Route::group(['prefix' => 'dashboards', 'as' => 'dashboards.'], function () { 
        Route::get('/index', 'App\Http\Controllers\OfficerDashboardController@index')->name('index');
    });


    Route::group(['prefix' => 'languages', 'as' => 'languages.'], function () { 
        Route::get('/index', 'App\Http\Controllers\ProgLanguageController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\ProgLanguageController@create')->name('create');
    });

    Route::group(['prefix' => 'grading-systems', 'as' => 'grading-systems.'], function () { 
        Route::get('/index', 'App\Http\Controllers\GradingSystemController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\GradingSystemController@create')->name('create');
        Route::get('/edit/{id}', 'App\Http\Controllers\GradingSystemController@edit')->name('edit');
        Route::post('/store', 'App\Http\Controllers\GradingSystemController@store')->name('store');
        Route::post('/update/{id}', 'App\Http\Controllers\GradingSystemController@update')->name('update');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () { 
        Route::get('/students', 'App\Http\Controllers\UserController@students')->name('students');
        Route::get('/profile/{id}', 'App\Http\Controllers\UserController@profile')->name('profile');
        Route::get('/assessments/{user_id}', 'App\Http\Controllers\UserController@assessments')->name('assessments');
        Route::get('/assessment-details/{assessment_id}', 'App\Http\Controllers\UserController@assessmentDetails')->name('assessment-details');
    });

    Route::group(['prefix' => 'question-sets', 'as' => 'question-sets.'], function () { 
        Route::get('/index/{prog_language_id}/', 'App\Http\Controllers\QuestionSetController@index')->name('index');
        Route::get('/create/{prog_language_id}/', 'App\Http\Controllers\QuestionSetController@create')->name('create');
        Route::post('/store', 'App\Http\Controllers\QuestionSetController@store')->name('store');
        Route::post('/update/{id}', 'App\Http\Controllers\QuestionSetController@update')->name('update');
    });

    Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () { 
        Route::get('/index/{prog_language_id}/{question_set_id}', 'App\Http\Controllers\QuestionController@index')->name('index');
        Route::get('/exercise/{prog_language_id}', 'App\Http\Controllers\QuestionController@exercise')->name('exercise');
        Route::get('/edit/{question}', 'App\Http\Controllers\QuestionController@edit')->name('edit');
        Route::get('/create/{prog_language_id}/{question_set_id}', 'App\Http\Controllers\QuestionController@create')->name('create');
        Route::post('/store', 'App\Http\Controllers\QuestionController@store')->name('store');
        Route::post('/update/{question}', 'App\Http\Controllers\QuestionController@update')->name('update');
    });

    Route::group(['prefix' => 'topics', 'as' => 'topics.'], function () { 
        Route::get('/create/{prog_language_id}/', 'App\Http\Controllers\TopicController@create')->name('create');
        Route::post('/store', 'App\Http\Controllers\TopicController@store')->name('store');
        Route::get('/edit/{topic}', 'App\Http\Controllers\TopicController@edit')->name('edit');
        Route::post('/update/{topic}', 'App\Http\Controllers\TopicController@update')->name('update');
    });

    Route::group(['prefix' => 'exercises', 'as' => 'exercises.'], function () { 
        Route::get('/index/{prog_language_id}/{topic_id}', 'App\Http\Controllers\ExerciseController@index')->name('index');
        Route::get('/edit/{exercise}', 'App\Http\Controllers\ExerciseController@edit')->name('edit');
        Route::get('/create/{prog_language_id}/{topic_id}', 'App\Http\Controllers\ExerciseController@create')->name('create');
        Route::post('/generate', 'App\Http\Controllers\ExerciseController@generate')->name('generate');
        Route::post('/store', 'App\Http\Controllers\ExerciseController@store')->name('store');
        Route::post('/update/{id}', 'App\Http\Controllers\ExerciseController@update')->name('update');
    });

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () { 
        Route::get('/passed-failed/{remarks}', 'App\Http\Controllers\ReportController@passedFailed')->name('passed.failed');
        Route::get('/per-question', 'App\Http\Controllers\ReportController@perQuestion')->name('per-question');
    });

    Route::get('/AJAX/set/{proglang_id}', 'App\Http\Controllers\QuestionSetController@AJAX_select');
});


// STUDENT
Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware'=>'student'], function () {
    
    Route::group(['prefix' => 'dashboards', 'as' => 'dashboards.'], function () { 
        Route::get('/index', 'App\Http\Controllers\StudentDashboardController@index')->name('index');
    });
    
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () { 
        Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('profile');
        Route::post('/update-profile', 'App\Http\Controllers\UserController@updateProfile')->name('update.profile');
    });
    
    Route::group(['prefix' => 'assessments', 'as' => 'assessments.'], function () { 
        Route::get('/quiz', 'App\Http\Controllers\AssessmentController@quiz')->name('quiz');
        Route::get('/result/{assessment_id}', 'App\Http\Controllers\AssessmentController@result')->name('result');
        Route::get('/store-result/{assessment_id}/{c_q}/{p_q}/{c_e}/{p_e}/{c_c}/{p_c}/{remarks}', 'App\Http\Controllers\AssessmentController@storeResult')->name('store.result');
    });

    Route::group(['prefix' => 'quizzes', 'as' => 'quizzes.'], function () { 
        Route::post('/store', 'App\Http\Controllers\QuizController@store')->name('store');
    });

    Route::group(['prefix' => 'ass-exercises', 'as' => 'ass-exercises.'], function () { 
        Route::post('/store', 'App\Http\Controllers\AssExerciseController@store')->name('store');
    });

});


Route::fallback(function() {
    return '404 Not found';
});



