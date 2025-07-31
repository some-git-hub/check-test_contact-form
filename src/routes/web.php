<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;

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

// 管理画面
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.admin');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::delete('/admin/delete{id}', [AdminController::class, 'delete'])->name('admin.delete');
});

// 管理画面へのログイン
Route::post('/login', [LoginController::class, 'login'])->name('login');

// お問い合わせフォーム
Route::middleware(['web'])->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
    Route::post('/thanks', [ContactController::class, 'store'])->name('contact.thanks');
});
Route::get('/confirm', function () {
    return redirect()->route('contact.index');
});
Route::get('/thanks', function () {
    return redirect()->route('contact.index');
});