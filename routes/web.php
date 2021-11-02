<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDash\UserController;
use App\Http\Controllers\AdminDash\CategoryController;
use App\Http\Controllers\AdminDash\SubCategoryController;
use App\Http\Controllers\AdminDash\SliderController;
use App\Http\Controllers\AdminDash\CityController;
use App\Http\Controllers\AdminDash\AreaController;
use App\Http\Controllers\AdminDash\PolicePrivacyController;
use App\Http\Controllers\AdminDash\UsageAgreementController;
use App\Http\Controllers\AdminDash\PlacesController;
use App\Http\Controllers\AdminDash\NotifyController;
use App\Http\Controllers\AdminDash\SupervisorController;

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

Route::get("admin", function () {
    return redirect('admin/login');
});
Route::prefix('admin')->group(function () {


    Auth::routes();

    // // // the extraction of Auth::routes();
    // Authentication Routes...
    // Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    // Route::post('login', [LoginController::class,'login']);
    // Route::post('logout', [LoginController::class,'logout'])->name('logout');

    // Registration Routes...
    // Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
    // Route::post('register', [RegisterController::class,'register']);

    // Password Reset Routes...
    // Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm']);
    // Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail']);
    // Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm']);
    // Route::post('password/reset', [ResetPasswordController::class,'reset']);
    // // // // // // // // // // // // // // 
    Route::post('logout', [LoginController::class, 'logout_web'])->name('logout');
    Route::post('login', [LoginController::class, 'postLogin']);





    Route::get("/privacy", function () {
        return view('privacy');
    });


    Route::middleware('auth:web')->group(function () {

        Route::get("/home", function () {
            return view('home');
        });


        Route::middleware('role:1')->group(function () {
            //user Page

            Route::get('/users', [UserController::class, 'user_page']);
            Route::get('/users', [UserController::class, 'show_users']);
            Route::get('/delete_user', [UserController::class, 'delete_user']);

            //category page ::

            Route::get('/category', [CategoryController::class, 'show_categoryPage']);
            Route::get('/category', [CategoryController::class, 'show_category_data']);
            Route::get('/delete_category', [CategoryController::class, 'delete_category']);
            Route::get('/categorynew', [CategoryController::class, 'show_addPage']);
            Route::post('/add_category', [CategoryController::class, 'add_category']);
            Route::get('/editcategory', [CategoryController::class, 'edit_page']);
            Route::get('/editcategory', [CategoryController::class, 'catgeory_ById']);
            Route::post('/update_category', [CategoryController::class, 'update_category']);



            //subcategory page ::

            Route::get('/subcategory', [SubCategoryController::class, 'show_subcategoryPage']);
            Route::get('/subcategory', [SubCategoryController::class, 'show_subcategory_data']);
            Route::get('/delete_subcategory', [SubCategoryController::class, 'delete_subcategory']);
            Route::get('/subcategorynew', [SubCategoryController::class, 'show_addPage']);
            Route::post('/add_subcategory', [SubCategoryController::class, 'add_subcategory']);
            Route::get('/editSubcategory', [SubCategoryController::class, 'edit_page']);
            Route::get('/editSubcategory', [SubCategoryController::class, 'subcatgeory_ById']);
            Route::post('/update_subcategory', [SubCategoryController::class, 'update_subcategory']);


            //Slider page ::

            Route::get('/slider', [SliderController::class, 'slider_page']);
            Route::get('/slider', [SliderController::class, 'slider_data']);
            Route::get('/delete_image', [SliderController::class, 'delete_image']);
            Route::get('/newImage', [SliderController::class, 'add_page']);
            Route::post('/add_image', [SliderController::class, 'add_image']);

            //Slider page ::

            Route::get('/city', [CityController::class, 'show_cityPage']);
            Route::get('/city', [CityController::class, 'show_city_data']);
            Route::get('/delete_city', [CityController::class, 'delete_city']);
            Route::get('/newCity', [CityController::class, 'show_addPage']);
            Route::post('/add_city', [CityController::class, 'add_city']);
            Route::get('/editCity', [CityController::class, 'edit_page']);
            Route::get('/editCity', [CityController::class, 'city_ById']);
            Route::post('/update_city', [CityController::class, 'update_city']);

            //area page ::
            Route::get('/area', [AreaController::class, 'show_areaPage']);
            Route::get('/area', [AreaController::class, 'show_area_data']);
            Route::get('/delete_area', [AreaController::class, 'delete_area']);
            Route::get('/newArea', [AreaController::class, 'show_addPage']);
            Route::post('/Add_area', [AreaController::class, 'Add_area']);
            Route::get('/editArea', [AreaController::class, 'edit_page']);
            Route::get('/editArea', [AreaController::class, 'area_ById']);
            Route::post('/update_area', [AreaController::class, 'update_area']);

            //policy privacy ::
            Route::get('/policy', [PolicePrivacyController::class, 'show_policyPage']);
            Route::get('/policy', [PolicePrivacyController::class, 'show_policy_data']);
            Route::get('/delete_policy', [PolicePrivacyController::class, 'delete_policy']);
            Route::get('/editPolicy', [PolicePrivacyController::class, 'edit_page']);
            Route::get('/editPolicy', [PolicePrivacyController::class, 'policy_ById']);
            Route::post('/update_policy', [PolicePrivacyController::class, 'update_policy']);
            Route::get('/newPolicy', [PolicePrivacyController::class, 'show_addPage']);
            Route::post('/add_policy', [PolicePrivacyController::class, 'add_policy']);

            //policy privacy ::
            Route::get('/agreement', [UsageAgreementController::class, 'show_agreementPage']);
            Route::get('/agreement', [UsageAgreementController::class, 'show_agreement_data']);
            Route::get('/delete_agreement', [UsageAgreementController::class, 'delete_agreement']);
            Route::get('/editAgreement', [UsageAgreementController::class, 'edit_page']);
            Route::get('/editAgreement', [UsageAgreementController::class, 'agreement_ById']);
            Route::post('/update_agreement', [UsageAgreementController::class, 'update_agreement']);
            Route::get('/newAgreement', [UsageAgreementController::class, 'show_addPage']);
            Route::post('/add_agreement', [UsageAgreementController::class, 'add_agreement']);


            //places ::
            Route::get('/places', [PlacesController::class, 'show_placePage']);
            Route::get('/places', [PlacesController::class, 'show_place_data']);
            Route::get('/newPlace', [PlacesController::class, 'show_addPage']);
            Route::post('/add_place', [PlacesController::class, 'add_place']);
            Route::get('/placeDetails', [PlacesController::class, 'show_placeDetails']);
            Route::post('/places_status', [PlacesController::class, 'updateStatus']);
            Route::delete('/places_delete/{id}', [PlacesController::class, 'destroy']);

            //supervisors
            Route::get('/supervisors', [SupervisorController::class, 'index']);
            Route::get('/supervisors_create', [SupervisorController::class, 'create']);
            Route::get('/supervisors_show/{id}', [SupervisorController::class, 'show']);
            Route::post('/supervisors_status', [SupervisorController::class, 'updateStatus']);
            Route::post('/supervisors_store', [SupervisorController::class, 'store']);

            //notification ::

            Route::get('/notify', [NotifyController::class, 'show_notifyPage']);
            Route::post('/notify_user', [NotifyController::class, 'notify_user']);
            Route::post('/notify_alluser', [NotifyController::class, 'notify_alluser']);
        });

        Route::middleware('role:3')->group(function () {
            Route::get('/addPlaceAndUser', [PlacesController::class, 'add_place_and_user']);
            Route::post('/savePlaceAndUser', [PlacesController::class, 'save_place_and_user']);
        });

        Route::get('/myformAjax/{id}', [PlacesController::class, 'myformAjax']);
        Route::get('/AreaData_byCityId/{id}', [PlacesController::class, 'AreaData_byCityId']);

    });
});