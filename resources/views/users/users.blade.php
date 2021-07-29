{{-- @authによってログインしてるユーザだけ見られる --}}
    {{-- @auth @else @endauth は、ミドルウェアで'middleware' => 'auth'　をつけてるから本当はいらないかも --}}
@auth
    {{-- link_to_route　なので　'/dashboard'  ではない →nameでつけてる名前で設定する --}}
    {{-- <div class="toolbar">{!! link_to_route('dashboard', 'DashBoardページへ', []) !!}</div> --}}

    @if(count($users) > 0)
        <p>ユーザー一覧</p>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>ユーザ名</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        {{$user->name}}


                    </td>
                </tr>
            @endforeach
        </table>
    @endif
{{-- ページネーションのリンク --}}
{{-- {{ $users->links() }} --}}

{{-- ログインしてなかったら --}}
@else
    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
    @endif


@endauth

