<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use Illuminate\Support\Facades\Route;

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

############### login && register ####################
Route::group(['middleware'=>'guest:web','prefix'=>'admin'], function(){
    Route::get('/login', [AuthController::class,'login'])->name('admin.login');
    Route::post( '/post-login', [AuthController::class,'postLogin'])->name('admin.postLogin');
    Route::post('/register', [AuthController::class,'register'])->name('admin.register');
});
############### end Login && register #################

    Route::group(['middleware' => 'auth:web','prefix'=>'admin'], function(){
        Route::get('/', [AdminController::class,'index'])->name('admin.dashboard');
        Route::get('/logout', [AuthController::class,'logout'])->name('admin.logout');
        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
            Route::put('update', 'ProfileController@updateprofile')->name('update.profile');
            Route::get('edit-password', 'ProfileController@editPass')->name('password.edit.profile');
            Route::post('update-password', 'ProfileController@updatepass')->name('password.update.profile');
        });
#######################main categories##############################
        Route::group(['prefix' => 'main-categories'], function () {
            Route::get('/', 'MaincategoriesController@index')->name('admin.maincategories');
            Route::get('create', 'MaincategoriesController@create')->name('admin.maincategories.create');
            Route::post('store', 'MaincategoriesController@store')->name('admin.maincategories.store');
            Route::get('edit/{id}', 'MaincategoriesController@edit')->name('admin.maincategories.edit');
            Route::post('update/{id}', 'MaincategoriesController@update')->name('admin.maincategories.update');
            Route::get('delete/{id}', 'MaincategoriesController@delete')->name('admin.maincategories.delete');
        });
#######################end main categories##############################

#######################Sub categories##############################
        Route::group(['prefix' => 'sub-categories'], function () {
            Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
            Route::get('create', 'SubCategoriesController@create')->name('admin.subcategories.create');
            Route::post('store', 'SubCategoriesController@store')->name('admin.subcategories.store');
            Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.subcategories.edit');
            Route::post('update/{id}', 'SubCategoriesController@update')->name('admin.subcategories.update');
            Route::get('delete/{id}', 'SubCategoriesController@delete')->name('admin.subcategories.delete');
        });
#######################end main categories##############################

    });
