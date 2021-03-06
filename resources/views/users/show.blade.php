@extends('layouts.myapp')

@section('title', 'Show')

@section('menubar')
    @parent
    ユーザー詳細ページ
@endsection

@section('content')
    <div class="toolbar">
        {!! link_to_route('users.index', 'ユーザー一覧へ戻る') !!}
    </div>
   {{-- @if (Auth::check()) @else  @endif  と同じ意味の  @auth  @else  @endauth  --}}
       {{--  @auth @else @endauthは、ミドルウェアで'middleware' => 'auth'　をつけてるから本当はいらないかも --}}
    @auth
        @if(isset($user))
            <h3>{{$user->name}} さんの詳細ページ</h3>
            @if(session('flash_message'))
                <p class="notice">
                    メッセージ:{{session('flash_message')}}
                </p>
            @endif
            <table>
                <tr>
                    <th>id</th><th>name</th><th>email</th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    {{-- 自分だけが編集  削除  できるようにすること $user->id ではなくAuth::id()  Auth::user()->id と同じ --}}
                    @if($user == Auth::user())
                        <td>
                            <button type="button" class="btn btn-light" display="inline-block">
                                {!! link_to_route('users.edit', 'ユーザー情報編集', ['user' => Auth::user()->id] ) !!}
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-light" display="inline-block">
                                {!! link_to_route('password.edit', 'ユーザパスワード変更', ['password' => Auth::user()->id]) !!}
                            </button>
                            {{-- password/{password}/edit の {}の中に入るものを第三引数で指定します。 http://localhost:8000/password/1/edit　というURLにするために このルートはresourcesメソッドで作ってるので、--}}
                        </td>
                        <td>
                            {!! Form::open(['route' => ['users.destroy', Auth::user()->id], 'method' => 'delete']) !!}
                                {{-- {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'confirm("本当に削除してよろしいですか")']) !!} --}}
                                {{-- ユーザーについては、確認してキャンセルしても、削除されてしまうので、'onclick' => 'confirm("本当に削除してよろしいですか")' はつけないこと --}}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    @endif
                </tr>
            </table>
        @endif
    {{-- ログインしてないなら --}}
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
    @endauth

@endsection

@section('footer')
copyright 2021 kameyama
@endsection

