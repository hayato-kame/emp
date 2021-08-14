<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Models\Employee;
use App\Models\Department;
use App\Models\Photo;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', [ 'employees' => $employees ]);
    }

    // まず、写真の表示、編集、アップロードから考える。
    public function new_edit(Request $request)
    {
        // $action = $request->action;
        // $departments = Department::all();  // 戻り値 Illuminate\Database\Eloquent\Collection
        // $dep_array = $departments->all();  // コレクションを配列に変換した
        // // ただの配列を 連想配列にしたい
        // $dep_name_array = [];
        // foreach($dep_array as $dep) {
        //     $dep_name_array[$dep->department_id] = $dep->department_name;
        // }
        // dd($dep_name_array);

    }

}
