<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>

    <!-- meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jquery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    
    <!-- datatable -->
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
    <script src="{{ asset('js/dataTables.bootstrap.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dataTables.jqueryui.css') }}">
    <script src="{{ asset('dataTables.jqueryui.js') }}"></script>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <script src="{{ asset('js/all.js') }}"></script>
</head>
@yield('content')
</html>