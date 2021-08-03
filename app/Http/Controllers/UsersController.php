<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = Auth::user();
        // $user = User::find($id); // これもいい
        return view('users.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = Auth::user();
        // $user = User::find($id); // これもいい
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $param = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        $user = User::find($id);
        // Userクラスに　protected $fillable　で設定してあるので、fillメソッドで一気にセットして更新できる
        $user->fill($param)->save();
        return redirect('/users');
    }

    // パスワードのことは、このコントローラではなく、PasswordControllerを作成しました。
    // 内容は、PasswordControllerを作成してから、jetstreamで自動生成された UpdateUserPassword.phpから 内容を参考にして編集した。

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }

}
