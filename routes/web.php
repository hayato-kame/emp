<?php

use App\Http\Controllers\PasswordController;
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

// 部署関係のページ 従業員関係のページなど、ログインしていないと、いけない            //作成順
Route::group(['middleware' => 'auth'], function() {

    // resource 使うと、名前をつけたように使える 'users.index' とか 'users.show'とか　link_to_route　で使えるらしい
    Route::resource('/users', UsersController::class, ['only' => ['index', 'show', 'edit', 'update']]);

    Route::resource('/password', PasswordController::class, ['only' => ['show', 'edit', 'update']]);

});
