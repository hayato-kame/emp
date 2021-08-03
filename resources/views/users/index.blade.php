@extends('layouts.myapp')

@section('title', 'Index')

@section('menubar')
    @parent
    ユーザー一覧ページ
@endsection

@section('content')
    <div class="toolbar">
        {!! link_to_route('dashboard', 'Dashboardへ戻る') !!}
    </div>
    {{-- ユーザー一覧 --}}
    @include('users.users')
@endsection

@section('footer')
copyright 2021 kameyama
@endsection
