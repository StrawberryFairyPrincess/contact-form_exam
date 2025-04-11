<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
// use App\Http\Controllers\TodoController;
// use App\Http\Controllers\CategoryController;


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
// postメソッドで'/contacts/confirm'にアクセスしたときContactControllerクラスの'confirm'アクションを呼び出す
// Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
// postメソッドで'/contacts'にアクセスしたときContactControllerクラスの'store'アクションを呼び出す
// Route::post('/contacts', [ContactController::class, 'store']);

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