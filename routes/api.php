<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;

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
Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);

// Contact Page route
Route::post('/postcontact', [ContactController::class, 'PostContactDetails']);

// Site Info route
Route::get('/allsiteinfo', [SiteInfoController::class, 'AllSiteInfo']);

// All Category route
Route::get('/allcategory', [CategoryController::class, 'AllCategory']);

// ProductList route
Route::get('/productlistbyremarks/{remarks}', [ProductListController::class, 'ProductListByRemarks']);
