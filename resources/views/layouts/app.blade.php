<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>应用程序名称 - @yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">
    <div id = "app-2"> <span v-bind:title = "message">     鼠標懸停幾秒鐘查看此處動態綁定的提示信息！</span> </div>

@section('test')
        <p>这将追加到主布局的侧边栏。</p>
    @show
    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
