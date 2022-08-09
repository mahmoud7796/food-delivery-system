<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\MaincategoriesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubCategoriesController;
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
            Route::get('edit', [ProfileController::class,'editProfile'])->name('edit.profile');
            Route::put('update',  [ProfileController::class,'updateProfile'])->name('update.profile');
            Route::get('edit-password',  [ProfileController::class,'editPass'])->name('password.edit.profile');
            Route::post('update-password',  [ProfileController::class,'updatePass'])->name('password.update.profile');
        });
#######################main categories######################
        Route::group(['prefix' => 'main-categories'], function () {
            Route::get('/',[MaincategoriesController::class,'index'])->name('admin.maincategories');
            Route::get('create', [MaincategoriesController::class,'create'])->name('admin.maincategories.create');
            Route::post('store', [MaincategoriesController::class,'store'])->name('admin.maincategories.store');
            Route::get('edit/{id}', [MaincategoriesController::class,'edit'])->name('admin.maincategories.edit');
            Route::post('update/{id}', [MaincategoriesController::class,'update'])->name('admin.maincategories.update');
            Route::get('delete/{id}', [MaincategoriesController::class,'delete'])->name('admin.maincategories.delete');
        });
#######################end main categories###################

#######################Sub categories##############################
        Route::group(['prefix' => 'sub-categories'], function () {
            Route::get('/', [SubCategoriesController::class,'index'])->name('admin.subcategories');
            Route::get('create', [SubCategoriesController::class,'create'])->name('admin.subcategories.create');
            Route::post('store', [SubCategoriesController::class,'store'])->name('admin.subcategories.store');
            Route::get('edit/{id}', [SubCategoriesController::class,'edit'])->name('admin.subcategories.edit');
            Route::post('update/{id}', [SubCategoriesController::class,'update'])->name('admin.subcategories.update');
            Route::get('delete/{id}', [SubCategoriesController::class,'delete'])->name('admin.subcategories.delete');
        });
#######################end main categories##############################

    });
