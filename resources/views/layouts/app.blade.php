<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head style="height: 100%;">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0,user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="height: 100%;">
@yield('content')
</body>
</html>
<style>
    .el-table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.5em;
        border: solid 1px #cbd5e0;
    }

    .el-form {
        border-radius: 0.5em;
        border: solid 1px #cbd5e0;
        background: #ffffff;
        padding: 10px;
    }
    .el-tabs--top {
        border-radius: 0.5em;
        border: solid 1px #cbd5e0;
    }

    .el-card {
        background: #ffffff;
    }

    .swal2-popup {
        background: #fafaf5;
     }
</style>
