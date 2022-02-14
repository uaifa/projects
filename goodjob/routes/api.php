<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\JobListController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\PaypalController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\SkillsController;
use App\Http\Controllers\Api\StaffMemberController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => '{locale?}',
    'locale' => '[a-zA-Z]{2}',
    'middleware' => 'setlocale',
], function () {

    Route::post('signup', [UserController::class, 'signup']);
    Route::post('soclial-login', [UserController::class, 'socialLogin']);
    Route::post('signin', [UserController::class, 'signin']);
    Route::post('forget-password', [UserController::class, 'forget_password']);
    Route::post('reset-forget-password', [UserController::class, 'reset_forget_password']);
    Route::get('logout', [UserController::class, 'logout']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('user-profile-image', [UserController::class, 'profile_image']);
        Route::post('reset-password', [UserController::class, 'reset_password']);
        Route::post('update-user-profile',[UserProfileController::class,'update_user_profile']);
        Route::get('teams', [TeamController::class, 'index']);
        Route::get('teams/{id}', [TeamController::class, 'show']);
        Route::get('packages', [PackageController::class, 'index']);
        Route::get('packages/{id}', [PackageController::class, 'show']);
        
        Route::resource('team',TeamController::class);
        Route::resource('package',PackageController::class);
        Route::resource('client',ClientController::class);
        Route::resource('joblist',JobListController::class);
        Route::resource('place',PlaceController::class);
        Route::resource('staff-member', StaffMemberController::class);
        Route::post('staff-member/upload-profile-image/{id}', [StaffMemberController::class,'upload_profile_image']);

        Route::resource('skill',SkillsController::class); 


        Route::post('paypal-payment-detail', [PaypalController::class, 'get_payment_detail']);
        Route::post('stripe-payment-detail', [StripeController::class, 'check_payment_detail']);        

    });

});

Route::get('gets', function(){
    dd("oka");
});