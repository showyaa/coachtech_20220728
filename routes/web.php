<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
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

// ホーム
Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// 認証関係
require __DIR__.'/auth.php';

Route::prefix('teacher')->name('teacher.')->group(function(){
    require __DIR__.'/teacher-auth.php';
});

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/teacher/logout', [LogoutController::class, 'teacher_logout']);

// 投稿(Post)
Route::prefix('post')->group(function () {
    Route::post('/create', [PostController::class, 'create']);
});

// 返信(Reply)
Route::prefix('reply')->group(function () {
    Route::post('/create', [ReplyController::class, 'create']);
});

