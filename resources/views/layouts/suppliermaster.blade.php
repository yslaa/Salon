<!DOCTYPE html>
<html>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
    }
</style>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('src/css/app.css') }}">
    @yield('styles')
    @vite('resources/css/app.css')
</head>

<body
    style="background-image: url(/navbar/background-salon.jpg); background-repeat: no-repeat; background-size:cover; overflow:hidden;">
    @include('sweetalert::alert')
    @include('partials.supplierheader')
    <div>
        @yield('content')
    </div>

    @yield('scripts')
</body>

</html>
