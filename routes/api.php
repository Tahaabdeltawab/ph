<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\FeedbacksController;
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
    Route::put('users/update_profile', [App\Http\Controllers\Api\UsersController::class, 'updateProfile'])->name('users.update_profile');
    Route::put('users/update_password', [App\Http\Controllers\Api\UsersController::class, 'updatePassword'])->name('users.update_password');
});
// AUTHENTICATION



Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware([/* 'role:admin' */])->group(function () {
            Route::resource('users', App\Http\Controllers\Api\UsersController::class);
            // roles & permissions            
            Route::resource('roles', App\Http\Controllers\Api\RolesController::class);
            Route::resource('permissions', App\Http\Controllers\Api\PermissionsController::class);
            // study
            Route::resource('universities', App\Http\Controllers\Api\UniversitiesController::class);
            Route::resource('faculties', App\Http\Controllers\Api\FacultiesController::class);
            Route::resource('years', App\Http\Controllers\Api\YearsController::class);
            Route::resource('topics', App\Http\Controllers\Api\TopicsController::class);
            Route::resource('roles', App\Http\Controllers\Api\RolesController::class);
            Route::resource('user_actions', App\Http\Controllers\Api\UserActionsController::class);
            Route::resource('chapters', App\Http\Controllers\Api\ChaptersController::class);
            Route::resource('definitions', App\Http\Controllers\Api\DefinitionsController::class);
            Route::resource('terms', App\Http\Controllers\Api\TermsController::class);
            Route::resource('tags', App\Http\Controllers\Api\TagsController::class);
            // admin notifications
            Route::resource('notifications', App\Http\Controllers\Api\NotificationsController::class);

        });

        // Used in Practice
        Route::get('topics', [App\Http\Controllers\Api\TopicsController::class, 'index']);
        Route::get('chapters', [App\Http\Controllers\Api\ChaptersController::class, 'index']);
        Route::get('definitions', [App\Http\Controllers\Api\DefinitionsController::class, 'index']);
    });

    Route::post('change_definition_level', [App\Http\Controllers\Api\DefinitionsController::class, 'change_definition_level']);
    Route::post('toggle_fav', [App\Http\Controllers\Api\DefinitionsController::class, 'toggle_fav']);
    Route::post('save_mcq_results', [App\Http\Controllers\Api\DefinitionsController::class, 'save_mcq_results']);
    Route::get('mcq_results', [App\Http\Controllers\Api\DefinitionsController::class, 'mcq_results']);
    Route::delete('mcq_results/{id}', [App\Http\Controllers\Api\DefinitionsController::class, 'destroy_mcq_results']);
    // chapter share
    Route::post('chapters/share', [App\Http\Controllers\Api\ChaptersController::class, 'share']);
    Route::get('chapters/{id}/allowed_users', [App\Http\Controllers\Api\ChaptersController::class, 'get_allowed_users']);
    Route::get('get_available_topics', [App\Http\Controllers\Api\ChaptersController::class, 'get_available_topics']);
    Route::get('topics/{id}/available_chapters', [App\Http\Controllers\Api\ChaptersController::class, 'get_available_chapters']);
    Route::get('users/options', [App\Http\Controllers\Api\UsersController::class, 'get_users_options']);
   
    //user notifications
    Route::get('notifications', [App\Http\Controllers\Api\NotificationsController::class, 'get_notifications']);
    Route::get('notifications/unseen_count', [App\Http\Controllers\Api\NotificationsController::class, 'unseen_count']);
    Route::get('notifications/markAsRead/{notification}', [App\Http\Controllers\Api\NotificationsController::class, 'markAsRead']);
    Route::get('notifications/markAsUnread/{notification}', [App\Http\Controllers\Api\NotificationsController::class, 'markAsUnread']);

    Route::resource('feedbacks', FeedbacksController::class);
});


// Routes does not need authentication as they are used in registration 
Route::prefix('admin')->group(function () {
    Route::get('universities', [App\Http\Controllers\Api\UniversitiesController::class, 'index']);
    Route::get('faculties', [App\Http\Controllers\Api\FacultiesController::class, 'index']);
    Route::get('years', [App\Http\Controllers\Api\YearsController::class, 'index']);
});
