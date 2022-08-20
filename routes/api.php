<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\MaincategoriesController;
use Illuminate\Support\Facades\Route;

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
 //test
//Madaaaaa
=======
#######  test github
####### Login && Register ########
Route::post('/auth',[AuthController::class,'registerOrLogin']);
####### End Login && Register ########

####### Categories ########
Route::group(['middleware'=>'auth:sanctum'], function(){

    ######## Connections ################
    Route::group(['prefix'=>'category','middleware'=>'auth:sanctum','controller'=>MaincategoriesController::class], function(){
        Route::get('/', 'index');
        Route::post('{id}', 'getSubCategoryOfMainCategory');

    });
});

####### End Categories ####

