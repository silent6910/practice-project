@extends('layouts.app')
@section('title', 'Page Title')
@section('content')
    @section('test')
        <p>这将追加到主布局的侧边栏。</p>
        @endsection
    <example-component></example-component>
@endsection
