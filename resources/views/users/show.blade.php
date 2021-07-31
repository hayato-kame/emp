@extends('layouts.myapp')

@section('title', 'Show')

@section('menubar')
    @parent
    ユーザー詳細ページ
@endsection

@section('content')
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

                            </button>
                        </td>
                        <td>
                        </td>
                        <td>
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

