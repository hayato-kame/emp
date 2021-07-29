<?php

use Illuminate\Support\Facades\Route;
//追加
use App\Http\Controllers\UsersController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 部署関係のページ 従業員関係のページなど、ログインしていないと、いけない
Route::group(['middleware' => 'auth'], function() {

    Route::resource('/users', UsersController::class, ['only' => ['index']]);


});
