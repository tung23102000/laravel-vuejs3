<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
// Điều này sẽ buộc Laravel không tải lại ứng dụng trên mỗi lần thay đổi lộ trình. Việc định tuyến của Laravel hiện đã bị dừng và VueJS có thể tiếp quản nó từ đây.
Route::get('{any}', function () { 
    return view('layouts.app'); 
    
})->where('any', '.*'); 