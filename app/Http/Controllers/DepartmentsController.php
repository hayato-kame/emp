<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Models\Department;
// 例外クラスは、App\Http\Controllers\QueryException　では無いので注意する  Illuminate\Database\QueryExceprion  の方を使う
use Illuminate\Database\QueryExceprion;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Department::all();  // all()クラスメソッドの戻り値は Illuminate\Database\Eloquent\Collection オブジェクト
        // dd($departments);
        // dd(count($departments));  // 整数が返る
        return view('departments/index', ['departments' => $departments]);
    }

    public function new_edit(Request $request)
    {
        
    }
}
