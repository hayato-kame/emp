<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Models\Department;
// 例外クラスは、App\Http\Controllers\QueryException　では無いので注意する  Illuminate\Database\QueryExceprion  の方を使う
use Illuminate\Database\QueryException;

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
        $action = $request->action;
        switch($action) {
            case 'add':
                $department = new Department;
                break;
            case 'edit':
                $department = Department::find($request->department_id);
                // dd($department->department_id);
                break;
        }
        return view('departments.new_edit', ['department' => $department, 'action' => $action]);
    }

    public function dep_control(Request $request)
    {
        $action = $request->action;
        $f_message = "";
         // dd($request->department_name); // フォームに入力された値を取得
        // dd($request->department_id); // hiddenフィールドから送られてくる値 新規作成では、 null
        switch($action)
        {
            case 'add':
                $last_department = Department::orderby('department_id', 'desc')->first();
                // dd($last_department);
                // dd($last_department->department_id);
                if($last_department == null) {
                    $result = "D01"; // 初期値
                } else {
                    $str = substr($last_department->department_id, 1, 2);
                    // dd($str);  // "03" とかになってる
                    // intval関数は引数で設定した値を整数値に変換させることができます。
                    // dd(intval($str) + 1)  // 整数で 4  とかになる
                    $result = sprintf("D%02d", intval($str) + 1 );
                    // dd($result);   // "D04"  とかになってる
                }
                $department = new Department;
                $department->department_id = $result;  // 作った文字列を代入する
                $department->department_name = $request->department_name;
                $department->save();
                // dd($department);
                $f_message = '部署データを新規作成しました。';
                break;
            case 'edit':
                $department = Department::find($request->department_id);
                // findメソッドはプライマリーキーを引数にとる
                $department->department_name = $request->department_name; // フォームからの送信の値で上書きする
                $department->save();
                $f_message = '部署名を更新しました。';
                break;
            case 'delete':
                $department = Department::find($request->department_id);
                // delete()が例外を投げる可能性あるので try catch で囲う
                // 子テーブルemployeesの外部キー制約で、->onDelete('restrict')  だと、親を消そうとして、紐づく子テーブルのデータがあったら、エラー発生する
                try {
                    $department->delete();
                } catch (QueryException $e) {
                    $f_message = 'この部署は、所属する社員がいるので、削除できませんでした。';
                    return redirect('/departments')->with( ['f_message' => $f_message] );
                    // return　で即終了してリダイレクト
                }
                $f_message = '部署データを削除しました。';
                break;
        }
        return redirect('/departments')->with(['f_message' => $f_message]);
        // リダイレクトは、セッションスコープに f_message というキーで、値が保存されます。
    }
}
