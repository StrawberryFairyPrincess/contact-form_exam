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





// // getメソッドで'/'にアクセスしたとき、TodoControllerの'index'アクションを呼び出す
// Route::get('/', [TodoController::class, 'index']);
// // postメソッドで'/todos'にアクセスしたとき、TodoControllerの'store'アクションを呼び出す
// Route::post('/todos',[TodoController::class, 'store']);
// // patchメソッドで'/todos/update'にアクセスしたとき、TodoControllerの'update'アクションを呼び出す
// Route::patch('/todos/update', [TodoController::class, 'update']);
// // deleteメソッドで'/todos/delete'にアクセスしたとき、TodoControllerの'destroy'アクションを呼び出す
// Route::delete('/todos/delete', [TodoController::class, 'destroy']);
// // getメソッドで'/todos/search'にアクセスしたとき、TodoControllerの'search'アクションを呼び出す
// Route::get('/todos/search', [TodoController::class, 'search']);

// // getメソッドで'/categories'にアクセスしたとき、CategoryControllerの'index'アクションを呼び出す
// Route::get('/categories', [CategoryController::class, 'index']);
// // postメソッドで'/categories'にアクセスしたとき、CategoryControllerの'store'アクションを呼び出す
// Route::post('/categories', [CategoryController::class, 'store']);
// // patchメソッドで'/categories/update'にアクセスしたとき、CategoryControllerの'update'アクションを呼び出す
// Route::patch('/categories/update', [CategoryController::class, 'update']);
// // deleteメソッドで'/categories/delete'にアクセスしたとき、CategoryControllerの'destroy'アクションを呼び出す
// Route::delete('/categories/delete', [CategoryController::class, 'destroy']);