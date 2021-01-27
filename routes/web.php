<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::view('login', 'auth.login')->name('login');
Route::post('login', [LoginController::class, 'postLogin']);
Route::any('logout', function(){
    Auth::logout();
    return redirect(route('login'));
})->name('logout');

Route::prefix('danh-muc')
    ->middleware('auth')
    ->group(function(){
        Route::get('/', [CategoryController::class, 'index'])
            // ->middleware('check-age-gt18')
            ->name('cate.index');
        Route::get('{id}/remove', 
            [CategoryController::class, 'remove'])->name('cate.remove');
        Route::get('add', [CategoryController::class, 'addForm'])->name('cate.add');
        Route::post('add', [CategoryController::class, 'saveAdd']);

        Route::get('edit/{id}', [CategoryController::class, 'editForm'])->name('cate.edit');
        Route::post('edit/{id}', [CategoryController::class, 'saveEdit']);
    });
    

            


Route::get('san-pham', [ProductController::class, 'index'])->name('product.index');
Route::get('hoa-don', [OrderController::class, 'index'])->name('order.index');