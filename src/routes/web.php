<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;


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


// getメソッドで'/'にアクセスしたときContactControllerクラスの'index'アクションを呼び出す
Route::get('/', [ContactController::class, 'index']);
// postメソッドで'/confirm'にアクセスしたときContactControllerクラスの'confirm'アクションを呼び出す
Route::post('/confirm', [ContactController::class, 'confirm']);
// postメソッドで'/thanks'にアクセスしたときContactControllerクラスの'store'アクションを呼び出す
Route::post('/thanks', [ContactController::class, 'store']);


// ミドルウェア
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'admin']);
});
// getメソッドで'/search'にアクセスしたときAuthControllerクラスの'search'アクションを呼び出す
Route::get('/search', [AuthController::class, 'search']);
// loginページからのリンク
Route::get('/register', [AuthController::class, 'register']);
// registerページからのリンク
Route::get('/login', [AuthController::class, 'login']);
// deleteメソッドで'/delete'にアクセスしたとき、AuthControllerの'destroy'アクションを呼び出す
Route::delete('/delete', [AuthController::class, 'destroy']);

