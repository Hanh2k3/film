<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Master Page-->
    <title>Trang Quản Trị</title>
    @include('libraries.toplibs')
    @yield('link-style')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div id="layout-menu" class="layout-menu menu-vertical">
                @include('admin.layouts.slidebar')
            </div>
            <div class="layout-page">
                @include('admin.layouts.navbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <footer class="content-footer footer bg-footer-theme">
                        @include('admin.layouts.footer')
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>
    @include('libraries.bottomlibs')
    @yield('script')
</body>

</html>
