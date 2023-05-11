<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\NotificationController;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Get visitor data
Route::get(
    '/getvisitor',
    [VisitorController::class, 'GetVisitorDetails']
);

// Contact Page route
Route::post(
    '/postcontact',
    [ContactController::class, 'PostContactDetails']
);

// Site Info route
Route::get(
    '/allsiteinfo',
    [SiteInfoController::class, 'AllSiteInfo']
);

// All Category route
Route::get(
    '/allcategory',
    [CategoryController::class, 'AllCategory']
);

// productlistbyremarks route
Route::get(
    '/productlistbyremarks/{remarks}',
    [ProductListController::class, 'ProductListByRemarks']
);

// productlistbycategory route
Route::get(
    '/productlistbycategory/{category}',
    [ProductListController::class, 'ProductListByCategory']
);

// productlistbycategory route
Route::get(
    '/productlistbysubcategory/{category}/{subcategory}',
    [ProductListController::class, 'ProductListBySubcategory']
);

// Slider route
Route::get(
    '/allslider',
    [SliderController::class, 'AllSlider']
);

// Product Details route
Route::get(
    '/productdetails/{id}',
    [ProductDetailsController::class, 'ProductDetails']
);

// Notification route
Route::get(
    '/notification',
    [NotificationController::class, 'NotificationHistory']
);

// Notification route
Route::get(
    '/search/{key}',
    [ProductListController::class, 'ProductBySearch']
);


//UserAuthentication--------------------------------------------------------------

// Login Routes
Route::post('/login', [AuthController::class, 'Login']);

// Register Routes
Route::post('/register', [AuthController::class, 'Register']);

// Forget Password Routes
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);

// Reset Password Routes
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);
//
