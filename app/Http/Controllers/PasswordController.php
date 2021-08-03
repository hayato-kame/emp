<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
//これも追加
use App\Actions\Fortify\PasswordValidationRules;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// UpdateUserPassword.phpの内容を見てかく
class PasswordController extends Controller
{
    use PasswordValidationRules;

     /**
     * Display the user's password. But not display  return RedirectResponse   ルーティングは一応ある。
     * passwordは見せないから、対応するビューはいらないから　ユーザアカウント修正の手順とはここが違う
     * リダイレクトさせる  redirect関数にパスを指定する
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect('users.show'); // 誘導
    }

    /**
     * Show the form for editing the user's password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('password.edit', ['user' => $user]);
    }

    /**
     * Update the users password.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))){
            return redirect()->back()->with('flash_message', '現在のパスワードが間違っています。');
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる  strcmp  が0 を返せば 等しい
        if(strcmp($request->get('current_password'), $request->get('password')) == 0) {
            return redirect()->back()->with('flash_message', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        //パスワードのバリデーション。新しいパスワードは8文字以上、password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //パスワードを変更
        $param = [
            'password' => bcrypt($request->get('password')),
        ];
        $user = User::find($id);
        $user->fill($param)->save();

        // ルーティングは resoucesメソッドを使ってるので redirect('users/:id') です。詳細ページにリダイレクトしますが。その前に、ログインし直しになり、その後で詳細ページに行きます。
        // また、新しいパスワードでログインし直しになりますので、ログインページに行きます。ので、フラッシュメーっセージは表示できなくなるので  セッションに保存しても ->with('flash_message', 'パスワードを変更しました。');なくなる
        // return redirect('users/:id')->with('flash_message', 'パスワードを変更しました。');
        return redirect('users/:id');
    }

}
