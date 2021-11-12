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


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
});

Route::group(['middleware' => 'guest:api'], function () {
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




Route::group([
    // 'middleware' => 'auth:api', // commented because these checks happens inside the controller method
], function() {
    Route::get('show_user_ByID' , [AuthController::class , 'show_user_ByID']);
    Route::get('Auth_logout' , [AuthController::class , 'Auth_logout']);
    Route::post('update_profile' , [AuthController::class , 'update_profile']);
});





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

// Route::post("registration", [AuthController::class ,"registration"]);
// Route::post('app_login' , [AuthController::class , 'app_login']);
// Route::post('social_login' , [AuthController::class , 'social_login']);

// Route::post('change_password' , [AuthController::class , 'change_password']);




Route::group([
    'middleware' => 'auth:api', 
], function() {

});


Route::get('conversations' , [ChatController::class , 'conversations']);
Route::get('start-conversation/{user_id}' , [ChatController::class , 'startConversation']);
Route::get('accept-conversation/{conversation_id}' , [ChatController::class , 'acceptConversation']);
Route::post('chat/message/send' , [ChatController::class , 'sendMessage']);
Route::get('get-conversation-messages/{conversation_id}' , [ChatController::class , 'getConversationMessages']);



// student


Route::prefix('admin')->group(function () {

    // Auth::routes();
    // Route::post('logout', [LoginController::class, 'logout_web'])->name('logout');
    // Route::post('login', [LoginController::class, 'postLogin']);

    Route::middleware('auth')->group(function () {
        Route::get('/home', [App\Http\Controllers\API\HomeController::class, 'index']);
        Route::resource('tests', App\Http\Controllers\API\TestsController::class);
        Route::resource('roles', App\Http\Controllers\API\RolesController::class);
        Route::post('roles_mass_destroy', [App\Http\Controllers\API\RolesController::class, 'massDestroy'])->name('roles.mass_destroy');
        Route::resource('users', App\Http\Controllers\API\UsersController::class);
        Route::post('users_mass_destroy', [App\Http\Controllers\API\UsersController::class, 'massDestroy'])->name('users.mass_destroy');
        Route::resource('user_actions', App\Http\Controllers\API\UserActionsController::class);
        Route::resource('topics', App\Http\Controllers\API\TopicsController::class);
        Route::post('topics_mass_destroy', [App\Http\Controllers\API\TopicsController::class, 'massDestroy'])->name('topics.mass_destroy');
        Route::resource('chapters', App\Http\Controllers\API\ChaptersController::class);
        Route::post('chapters_mass_destroy', [App\Http\Controllers\API\ChaptersController::class, 'massDestroy'])->name('chapters.mass_destroy');
        Route::resource('questions', App\Http\Controllers\API\QuestionsController::class);
        Route::post('questions_mass_destroy', [App\Http\Controllers\API\QuestionsController::class, 'massDestroy'])->name('questions.mass_destroy');
        Route::resource('questions_options', App\Http\Controllers\API\QuestionsOptionsController::class);
        Route::post('questions_options_mass_destroy', [App\Http\Controllers\API\QuestionsOptionsController::class, 'massDestroy'])->name('questions_options.mass_destroy');
        Route::resource('results', App\Http\Controllers\API\ResultsController::class);
        Route::post('results_mass_destroy', [App\Http\Controllers\API\ResultsController::class, 'massDestroy'])->name('results.mass_destroy');
    });
});
