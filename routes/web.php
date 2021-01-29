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
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    
    return view('welcome');
})->name('homepage');

use Illuminate\Http\Request;
Route::view('upload-file', 'file-upload');
Route::post('save-file-upload', function(Request $request){

    $fileName = uniqid().'_'.$request->image->getClientOriginalName();
    $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

    return $filePath;
})->name('up.load');

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
Route::get('san-pham/chi-tiet/{id}', [ProductController::class, 'detail'])
        ->name('product.detail');
Route::post('san-pham/api/tang-view', [ProductController::class, 'tangView'])
->name('product.tangView');
Route::get('hoa-don', [OrderController::class, 'index'])->name('order.index');