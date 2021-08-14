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

    // まず、親の写真の表示、編集、アップロードから考える。
    public function new_edit(Request $request)
    {
        $action = $request->action;
        // $departments = Department::all();  // 戻り値 Illuminate\Database\Eloquent\Collection
        // $dep_array = $departments->all();  // コレクションを配列に変換した
        // // ただの配列を 連想配列にしたい
        // $dep_name_array = [];
        // foreach($dep_array as $dep) {
        //     $dep_name_array[$dep->department_id] = $dep->department_name;
        // }
        // dd($dep_name_array);


        // 新規登録まず、親データの写真から行う 親データインスタンスと 子データインスタンスを生成する
        $photo = new Photo();
        $employee = new Employee();
        $params = [
            'photo' => $photo,
            'employee' => $employee,
            'action' => $action,
        ];
        return view('employees.new_edit', $params);
    }

    public function emp_control(Request $request)
    {

    }

}
