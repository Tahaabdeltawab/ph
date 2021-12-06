<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Resources\UserResource;

// AUTHENTICATION
Route::group(['middleware' => 'guest'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
Route::get('oauth/{driver}/deletion_callback', [OAuthController::class, 'handleDeletionCallback'])->name('oauth.deletion_callback');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', function (Request $request) {return new UserResource($request->user());});
    Route::post('logout', [LoginController::class, 'logout']);
    Route::put('users/update_profile', [App\Http\Controllers\API\UsersController::class, 'updateProfile'])->name('users.update_profile');
    Route::put('users/update_password', [App\Http\Controllers\API\UsersController::class, 'updatePassword'])->name('users.update_password');
});
// AUTHENTICATION



Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware(['role:admin'])->group(function () {
            Route::resource('users', App\Http\Controllers\API\UsersController::class);
            Route::post('users_mass_destroy', [App\Http\Controllers\API\UsersController::class, 'massDestroy'])->name('users.mass_destroy');
            Route::resource('universities', App\Http\Controllers\API\UniversitiesController::class);
            Route::post('universities_mass_destroy', [App\Http\Controllers\API\UniversitiesController::class, 'massDestroy'])->name('universities.mass_destroy');
            Route::resource('faculties', App\Http\Controllers\API\FacultiesController::class);
            Route::post('faculties_mass_destroy', [App\Http\Controllers\API\FacultiesController::class, 'massDestroy'])->name('faculties.mass_destroy');
            Route::resource('years', App\Http\Controllers\API\YearsController::class);
            Route::post('years_mass_destroy', [App\Http\Controllers\API\YearsController::class, 'massDestroy'])->name('years.mass_destroy');
            Route::resource('topics', App\Http\Controllers\API\TopicsController::class);
            Route::post('topics_mass_destroy', [App\Http\Controllers\API\TopicsController::class, 'massDestroy'])->name('topics.mass_destroy');
            Route::resource('tests', App\Http\Controllers\API\TestsController::class);
            Route::resource('roles', App\Http\Controllers\API\RolesController::class);
            Route::post('roles_mass_destroy', [App\Http\Controllers\API\RolesController::class, 'massDestroy'])->name('roles.mass_destroy');
            Route::resource('user_actions', App\Http\Controllers\API\UserActionsController::class);
            Route::resource('chapters', App\Http\Controllers\API\ChaptersController::class);
            Route::post('chapters_mass_destroy', [App\Http\Controllers\API\ChaptersController::class, 'massDestroy'])->name('chapters.mass_destroy');
            Route::resource('definitions', App\Http\Controllers\API\DefinitionsController::class);
            Route::post('definitions_mass_destroy', [App\Http\Controllers\API\DefinitionsController::class, 'massDestroy'])->name('definitions.mass_destroy');
            Route::resource('terms', App\Http\Controllers\API\TermsController::class);
            Route::post('terms_mass_destroy', [App\Http\Controllers\API\TermsController::class, 'massDestroy'])->name('terms.mass_destroy');
            Route::resource('results', App\Http\Controllers\API\ResultsController::class);
            Route::post('results_mass_destroy', [App\Http\Controllers\API\ResultsController::class, 'massDestroy'])->name('results.mass_destroy');
        });

        // Used in Practice
        Route::get('topics', [App\Http\Controllers\API\TopicsController::class, 'index']);
        Route::get('chapters', [App\Http\Controllers\API\ChaptersController::class, 'index']);
        Route::get('definitions', [App\Http\Controllers\API\DefinitionsController::class, 'index']);
    });

    Route::post('change_definition_level', [App\Http\Controllers\API\DefinitionsController::class, 'change_definition_level']);
    Route::post('toggle_fav', [App\Http\Controllers\API\DefinitionsController::class, 'toggle_fav']);
    Route::post('save_mcq_results', [App\Http\Controllers\API\DefinitionsController::class, 'save_mcq_results']);
    Route::get('mcq_results', [App\Http\Controllers\API\DefinitionsController::class, 'mcq_results']);
    Route::delete('mcq_results/{id}', [App\Http\Controllers\API\DefinitionsController::class, 'destroy_mcq_results']);
});


// Routes does not need authentication as they are used in registration 
Route::prefix('admin')->group(function () {
    Route::get('universities', [App\Http\Controllers\API\UniversitiesController::class, 'index']);
    Route::get('faculties', [App\Http\Controllers\API\FacultiesController::class, 'index']);
    Route::get('years', [App\Http\Controllers\API\YearsController::class, 'index']);
});
