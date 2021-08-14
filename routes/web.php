<?php

use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
//追加
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DepartmentsController;
use App\Models\Department;
use App\Http\Controllers\EmployeesController;

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
    Route::resource('/users', UsersController::class, ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);

    Route::resource('/password', PasswordController::class, ['only' => ['show', 'edit', 'update']]);

    Route::get('/departments', [ DepartmentsController::class, 'index' ])->name('departments.index');
    //部署新規作成フォームと、編集フォームの表示をする http://localhost:8000/department/new_edit?action=add  新規作成ページへのリンクボタンからは、クエリー文字列がついてくる
    Route::get('/departments/new_edit', [ DepartmentsController::class, 'new_edit' ])->name('departments.new_edit');
    // 部署名の編集や、部署の削除などをするアクションへのルート
    Route::post('/departments/dep_control', [ DepartmentsController::class, 'dep_control' ])->name('departments.dep_control');

    Route::get('/employees', [ EmployeesController::class, 'index' ])->name('employees.index');

    Route::get('/employees/new_edit', [ EmployeesController::class, 'new_edit' ])->name('employees.new_edit');
    Route::post('/employees/emp_control', [ EmployeesController::class, 'emp_control' ])->name('employees.emp_control');

});
