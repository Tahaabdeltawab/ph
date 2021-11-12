<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


Route::get("admin", function () {
    return redirect('admin/login');
});

Route::prefix('admin')->group(function () {

    Auth::routes();
    Route::post('logout', [LoginController::class, 'logout_web'])->name('logout');
    Route::post('login', [LoginController::class, 'postLogin']);

    Route::middleware('auth:web')->group(function () {
        Route::get("/home", function () { return view('home');});
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
        Route::resource('tests', App\Http\Controllers\TestsController::class);
        Route::resource('roles', App\Http\Controllers\RolesController::class);
        Route::post('roles_mass_destroy', [App\Http\Controllers\RolesController::class, 'massDestroy'])->name('roles.mass_destroy');
        Route::resource('users', App\Http\Controllers\UsersController::class);
        Route::post('users_mass_destroy', [App\Http\Controllers\UsersController::class, 'massDestroy'])->name('users.mass_destroy');
        Route::resource('user_actions', App\Http\Controllers\UserActionsController::class);
        Route::resource('topics', App\Http\Controllers\TopicsController::class);
        Route::post('topics_mass_destroy', [App\Http\Controllers\TopicsController::class, 'massDestroy'])->name('topics.mass_destroy');
        Route::resource('chapters', App\Http\Controllers\ChaptersController::class);
        Route::post('chapters_mass_destroy', [App\Http\Controllers\ChaptersController::class, 'massDestroy'])->name('chapters.mass_destroy');
        Route::resource('questions', App\Http\Controllers\QuestionsController::class);
        Route::post('questions_mass_destroy', [App\Http\Controllers\QuestionsController::class, 'massDestroy'])->name('questions.mass_destroy');
        Route::resource('questions_options', App\Http\Controllers\QuestionsOptionsController::class);
        Route::post('questions_options_mass_destroy', [App\Http\Controllers\QuestionsOptionsController::class, 'massDestroy'])->name('questions_options.mass_destroy');
        Route::resource('results', App\Http\Controllers\ResultsController::class);
        Route::post('results_mass_destroy', [App\Http\Controllers\ResultsController::class, 'massDestroy'])->name('results.mass_destroy');
    });
});
