<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta_tag')

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('clients/css/layouts.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{asset('clients/themify-icons-font/themify-icons/themify-icons.css')}}">
    @yield('link')
</head>
<body>
 
    <div class="main">
        <div id="navbar">
            @include('layouts.navbar')
        </div>
        <div class="drop_down un_active" id="drop">
            @include('layouts.drop_down')
        </div>
        <div class="content">
            @yield('content')
        </div>

        <div class="footer">
            @include('layouts.footer')
        </div>
        
    </div>

    <script src="{{asset('clients/js/layout.js')}}"></script>
</body>
</html>