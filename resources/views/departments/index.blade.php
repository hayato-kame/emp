@extends('layouts.myapp')

@section('title', 'Index')

@section('menubar')
    @parent
    部署一覧ページ
@endsection

@section('content')
    <h3>部署一覧:</h3>
    {{-- もしセッションスコープに、'f_message'　というキーがあれば、その値を表示します 二重波括弧の中で、sessionメソッドの引数に キーを指定すると 値が表示できます --}}
    @if(session('f_message'))
        <p class="notice">
            メッセージ:{{session('f_message')}}
        </p>
    @endif

    <div class="toolbar">
        {!! link_to_route('dashboard', 'Dashboardへ戻る') !!}
    </div>

    {{-- コレクションの中身の要素が 0以上なら テーブルを表示する --}}
    @if(count($departments) > 0)
        <div class="row">
            <div class="col-sm-7 offset-sm-2">
                <table class="table table-striped">
                    <thead>
                        <tr><th width="25%">部署ID</th><th>部署名</th><th colspan="2"></th></tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{$department->department_id}}</td>
                                <td>{{$department->department_name}}</td>
                                <td>

                                </td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                <table>
            </div>
        </div>
    @else
        {{-- 部署が一つも無いなら --}}
        <p>現在登録されている部署はありません。</p>
    @endif
    <div>
        <button type="button" class="btn btn-light" display="inline-block">
            {!! link_to_route('departments.new_edit', '部署新規作成ページ', ['action' => 'add'], []) !!}
            {{-- 第3引数の　　'action' => 'add'　は、 クエリー文字列の指定です http://localhost:8000/department/new_edit?action=add 　?以降のクエリー文字列を設定をしてます--}}
        </button>
    </div>
@endsection

@section('footer')
    copyright 2021 kameyama
@endsection
