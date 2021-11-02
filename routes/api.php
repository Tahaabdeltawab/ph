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
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\OffersController;
use App\Http\Controllers\Api\PlaceAboutUsController;
use App\Http\Controllers\Api\PrivacyPolicyController;
use App\Http\Controllers\Api\UsageAgreementController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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









Route::middleware('auth:api')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

Route::post("registration", [AuthController::class ,"registration"]);
Route::post('app_login' , [AuthController::class , 'app_login']);
Route::post('social_login' , [AuthController::class , 'social_login']);

Route::post('change_password' , [AuthController::class , 'change_password']);

Route::get('Home' , [HomeController::class , 'Home']);

Route::get('allCategory_places' , [PlaceController::class , 'allCategory_places']);


Route::group([
    'middleware' => 'auth:api', 
], function($router) {

    Route::get('show_user_ByID' , [AuthController::class , 'show_user_ByID']);
    Route::get('Auth_logout' , [AuthController::class , 'Auth_logout']);
    Route::post('update_profile' , [AuthController::class , 'update_profile']);
   
    Route::get('show_all_notification' , [NotificationController::class , 'show_all_notification']);

    Route::get('show_privacyPolicy' , [PrivacyPolicyController::class , 'show_privacyPolicy']);
    Route::get('show_usageAgreement' , [UsageAgreementController::class , 'show_usageAgreement']);

    //all subcategory::
    Route::get('show_all_subCategory' , [SubCategoryController::class , 'show_all_subCategory']);
    Route::get('show_places_BySubcatId' , [PlaceController::class , 'show_places_BySubcatId']);
    Route::get('show_place_details' , [PlaceController::class , 'show_place_details']);

    // city ::

    Route::get('show_all_city' , [CityController::class , 'show_all_city']);
    Route::get('show_Area_byCityId' , [AreaController::class , 'show_Area_byCityId']);
  
    Route::get('update_CityArea' , [AuthController::class , 'update_CityArea']);

    //favorite places :: 
    
    Route::get('add_favorite' , [FavoriteController::class , 'add_favorite']);
    Route::get('show_all_favorites' , [FavoriteController::class , 'show_all_favorites']);

    //user setting:: 

    Route::get('show_user_setting' , [SettingController::class , 'show_user_setting']);
    Route::post('update_setting' , [SettingController::class , 'update_setting']);

    // my place ::
   
    Route::post('update_myPlace' , [PlaceController::class , 'update_myPlace']);


});


Route::group([
    'middleware' => 'auth:api', 
    'prefix'  => "Product"
], function($router) {

    Route::post('update_product' , [ProductsController::class , 'update_product']);
    Route::post('add_product' , [ProductsController::class , 'add_product']);
    Route::get('delete_product' , [ProductsController::class , 'delete_product']);

});


Route::group([
    'middleware' => 'auth:api', 
    'prefix'  => "Service"
], function($router) {

    Route::post('update_services' , [ServicesController::class , 'update_services']);
    Route::post('add_services' , [ServicesController::class , 'add_services']);
    Route::get('delete_service' , [ServicesController::class , 'delete_service']);

});


Route::group([
    'middleware' => 'auth:api', 
    'prefix'  => "Offer"
], function($router) {

    Route::post('update_offers' , [OffersController::class , 'update_offers']);
    Route::post('add_offers' , [OffersController::class , 'add_offers']);
    Route::get('delete_Offer' , [OffersController::class , 'delete_Offer']);

});


Route::group([
    'middleware' => 'auth:api', 
    'prefix'  => "AboutUs"
], function($router) {

    Route::post('update_place_aboutUs' , [PlaceAboutUsController::class , 'update_place_aboutUs']);
    Route::post('add_place_aboutUS' , [PlaceAboutUsController::class , 'add_place_aboutUS']);
    Route::get('delete_aboutUS' , [PlaceAboutUsController::class , 'delete_aboutUS']);
    
});

Route::get('conversations' , [ChatController::class , 'conversations']);
Route::get('start-conversation/{user_id}' , [ChatController::class , 'startConversation']);
Route::get('accept-conversation/{conversation_id}' , [ChatController::class , 'acceptConversation']);
Route::post('chat/message/send' , [ChatController::class , 'sendMessage']);
Route::get('get-conversation-messages/{conversation_id}' , [ChatController::class , 'getConversationMessages']);