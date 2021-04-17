<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
@include('header')
@yield('content')
<div id="app">
    <example-component></example-component>
</div>
<script src=" {{ mix('js/app.js') }} "></script>
</body>

</html>
