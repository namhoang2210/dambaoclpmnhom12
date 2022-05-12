<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', '@Học Viện Công Nghệ Bưu Chính Viễn Thông'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-sticky fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/home">
                    <img src="https://career.gpo.vn/uploads/images/truong-hoc/logo-hoc-vien-cong-nghe-buu-chinh-vien-thong-1-.jpg" width="100px" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-weight: 600;">
                    @auth
                    <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <a href="/home">Trang chủ</a>  
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <a href="/commingsoon">Đăng kí môn học</a>  
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <a href="/commingsoon">Xem TKB</a>  
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <a href="/commingsoon">Xem lịch thi</a>  
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <a href="{{ route('points', Auth::id() )}}">Xem điểm</a>  
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <a href="/commingsoon">Sửa TT cá nhân</a>  
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <a href="/commingsoon">Góp ý kiến</a>  
                        </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <h1 style="font-size: 15px; padding-top: 14px; color: red">HỌC VIỆN CÔNG NGHỆ BƯU CHÍNH VIỄN THÔNG</h1>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Đăng xuất') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="text-center p-3" style="background-color: rgba(191, 188, 188, 0.2); bottom: 0;">
            Copyright ©2022 <br>
            Học viện công nghệ bưu chính viễn thông
        </footer>
    </div>
</body>
</html>
