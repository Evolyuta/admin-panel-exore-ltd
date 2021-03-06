<?php

use App\Http\Controllers\Admin\{PostController, UserController};
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
});

Auth::routes();

Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('', [UserController::class, 'store'])->name('store');
    });

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/{id}', [PostController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('', [PostController::class, 'store'])->name('store');
        Route::put('', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'delete'])->name('delete');
    });

    Route::get('/', [PostController::class, 'index'])->name('index');
});
