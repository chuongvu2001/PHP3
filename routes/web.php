<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
Route::get('danh-muc', [CategoryController::class, 'index'])->name('cate.index');
Route::get('danh-muc/{id}/remove', 
            [CategoryController::class, 'remove'])->name('cate.remove');
            
Route::get('danh-muc/add', [CategoryController::class, 'addForm'])->name('cate.add');
Route::post('danh-muc/add', [CategoryController::class, 'saveAdd']);

Route::get('danh-muc/edit/{id}', [CategoryController::class, 'editForm'])->name('cate.edit');
Route::post('danh-muc/edit/{id}', [CategoryController::class, 'saveEdit']);

Route::get('san-pham', [ProductController::class, 'index'])->name('product.index');
Route::get('hoa-don', [OrderController::class, 'index'])->name('order.index');