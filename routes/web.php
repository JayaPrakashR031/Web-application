<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[App\Http\Controllers\AdminController::class,'index'])->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/')->middleware('auth')->group(function (){
    Route::get('createpost', [App\Http\Controllers\AdminController::class, 'view'])->name('post.view');
    Route::post('createpost', [App\Http\Controllers\AdminController::class, 'create'])->name('post.create');
    Route::get('viewpost', [App\Http\Controllers\AdminController::class, 'postView'])->name('post.table');
});
Route::prefix('/')->middleware(['admin'])->group(function() {
    Route::get('tables', [App\Http\Controllers\AdminController::class, 'table'])->name('table');
    Route::get('edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('update');
    Route::get('delete/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('delete');
});
