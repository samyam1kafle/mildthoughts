{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--<meta charset="utf-8">--}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--<title>Laravel</title>--}}

{{--<!-- Fonts -->--}}
{{--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}

{{--<!-- Styles -->--}}
{{--<style>--}}
{{--html, body {--}}
{{--background-color: #fff;--}}
{{--color: #636b6f;--}}
{{--font-family: 'Nunito', sans-serif;--}}
{{--font-weight: 200;--}}
{{--height: 100vh;--}}
{{--margin: 0;--}}
{{--}--}}

{{--.full-height {--}}
{{--height: 100vh;--}}
{{--}--}}

{{--.flex-center {--}}
{{--align-items: center;--}}
{{--display: flex;--}}
{{--justify-content: center;--}}
{{--}--}}

{{--.position-ref {--}}
{{--position: relative;--}}
{{--}--}}

{{--.top-right {--}}
{{--position: absolute;--}}
{{--right: 10px;--}}
{{--top: 18px;--}}
{{--}--}}

{{--.content {--}}
{{--text-align: center;--}}
{{--}--}}

{{--.title {--}}
{{--font-size: 84px;--}}
{{--}--}}

{{--.links > a {--}}
{{--color: #636b6f;--}}
{{--padding: 0 25px;--}}
{{--font-size: 13px;--}}
{{--font-weight: 600;--}}
{{--letter-spacing: .1rem;--}}
{{--text-decoration: none;--}}
{{--text-transform: uppercase;--}}
{{--}--}}

{{--.m-b-md {--}}
{{--margin-bottom: 30px;--}}
{{--}--}}
{{--</style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="flex-center position-ref full-height">--}}
{{--@if (Route::has('login'))--}}
{{--<div class="top-right links">--}}
{{--@auth--}}
{{--<a href="{{ url('/home') }}">Home</a>--}}
{{--@else--}}
{{--<a href="{{ route('login') }}">Login</a>--}}

{{--@if (Route::has('register'))--}}
{{--<a href="{{ route('register') }}">Register</a>--}}
{{--@endif--}}
{{--@endauth--}}
{{--</div>--}}
{{--@endif--}}

{{--<div class="content">--}}
{{--<div class="title m-b-md">--}}
{{--Laravel--}}
{{--</div>--}}

{{--<div class="links">--}}
{{--<a href="https://laravel.com/docs">Docs</a>--}}
{{--<a href="https://laracasts.com">Laracasts</a>--}}
{{--<a href="https://laravel-news.com">News</a>--}}
{{--<a href="https://blog.laravel.com">Blog</a>--}}
{{--<a href="https://nova.laravel.com">Nova</a>--}}
{{--<a href="https://forge.laravel.com">Forge</a>--}}
{{--<a href="https://vapor.laravel.com">Vapor</a>--}}
{{--<a href="https://github.com/laravel/laravel">GitHub</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}

        <!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Mild Thoughts') }}</title>
    <meta name="robots" content="noindex, follow"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('Frontend/assets/images/favicon.ico')}}">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900"
          rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/vendor/bootstrap.min.css')}}">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/vendor/bicon.min.css')}}">
    <!-- Flat Icon CSS -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/vendor/flaticon.css')}}">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/plugins/slick.min.css')}}">
    <!-- nice-select CSS -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/plugins/nice-select.css')}}">
    <!-- perfect scrollbar css -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/plugins/perfect-scrollbar.css')}}">
    <!-- light gallery css -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/plugins/lightgallery.min.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('Frontend/assets/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">


</head>

<body>
<div id="app">

    <router-view></router-view>

    <!-- header area start -->
    <header>
        <div class="header-top sticky bg-white d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <!-- header top navigation start -->
                        <div class="header-top-navigation">
                            <nav>
                                <ul>
                                    @if(auth()->user())
                                        <notification :userid="{{auth()->id()}}"
                                                      :allnotifications="{{auth()->user()->notifications->sortByDesc('created_at')->take(5)}}"
                                                      :unreads="{{count(auth()->user()->unreadNotifications)}}"></notification>
                                        </li>
                                        <li><a href="{{route('admin')}}">Dashboard</a></li>
                                    @endif
                                    <li class="active">
                                        <router-link :to="{name: 'Index'}" tag="a" active-class="active">home
                                        </router-link>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- header top navigation start -->
                    </div>

                    <div class="col-md-2">
                        <!-- brand logo start -->
                        <div class="brand-logo text-center">
                            <a href="">
                                <img src="{{asset('Frontend/assets/images/logo/logo.png')}}" alt="brand logo">
                            </a>
                        </div>
                        <!-- brand logo end -->
                    </div>

                    <div class="col-md-5">
                        <div class="header-top-right d-flex align-items-center justify-content-end">

                            <!-- profile picture start -->
                        @if(auth()->check())

                            <!-- header top search start -->
                                <div class="header-top-search">
                                    <form class="top-search-box">
                                        <input type="text" placeholder="Search" class="top-search-field">
                                        <button class="top-search-btn"><i class="flaticon-search"></i></button>
                                    </form>
                                </div>

                                <!-- header top search end -->

                                <!-- profile picture start -->
                                <div class="profile-setting-box">
                                    <div class="profile-thumb-small">
                                        <a href="javascript:void(0)" class="profile-triger">
                                            <figure>
                                                <img src="{{asset('Frontend/assets/images/profile/profile-small-1.jpg')}}"
                                                     alt="profile picture">
                                            </figure>
                                        </a>
                                        <div class="profile-dropdown">
                                            <div class="profile-head">
                                                <h5 class="name"><a href="#">Madison Howard</a></h5>
                                                <a class="mail" href="#">mailnam@mail.com</a>
                                            </div>
                                            <div class="profile-body">
                                                <ul>
                                                    <li><a href="profile.html"><i class="flaticon-user"></i>Profile</a>
                                                    </li>
                                                    <li><a href="#"><i class="flaticon-message"></i>Inbox</a>
                                                    </li>
                                                    <li><a href="#"><i
                                                                    class="flaticon-document"></i>Activity</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li><a href="#"><i class="flaticon-settings"></i>Setting</a>
                                                    </li>
                                                    <li><a href="signup.html"><i class="flaticon-unlock"></i>Sing
                                                            out</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- profile picture end -->

                            @else
                                <div class="header-top-navigation">
                                    <nav>
                                        <ul>
                                            <li>
                                                <div class="header-top-search">
                                                    <form class="top-search-box">
                                                        <input type="text" placeholder="Search"
                                                               class="top-search-field">
                                                        <button class="top-search-btn"><i class="flaticon-search"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                            <li class="btn-group">
                                                <a href="{{ route('login') }}">
                                                    Login/Signup
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->
    <!-- header area start -->
    <header>
        <div class="mobile-header-wrapper sticky d-block d-lg-none">
            <div class="mobile-header position-relative ">
                <div class="mobile-logo">
                    <a href="index.html">
                        <img src="{{asset('Frontend/assets/images/logo/logo-white.png')}}" alt="logo">
                    </a>
                </div>
                <div class="mobile-menu w-100">
                    <ul>
                        <li>
                            <button class="notification request-trigger"><i class="flaticon-users"></i>
                                <span>03</span>
                            </button>
                            <ul class="frnd-request-list">
                                <li>
                                    <div class="frnd-request-member">
                                        <figure class="request-thumb">
                                            <a href="profile.html">
                                                <img src="{{asset('')}}Frontend/assets/images/profile/profile-midle-1.jpg"
                                                     alt="proflie author">
                                            </a>
                                        </figure>
                                        <div class="frnd-content">
                                            <h6 class="author"><a href="profile.html">merry watson</a></h6>
                                            <p class="author-subtitle">Works at HasTech</p>
                                            <div class="request-btn-inner">
                                                <button class="frnd-btn">confirm</button>
                                                <button class="frnd-btn delete">delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="frnd-request-member">
                                        <figure class="request-thumb">
                                            <a href="profile.html">
                                                <img src="{{asset('')}}Frontend/assets/images/profile/profile-midle-2.jpg"
                                                     alt="proflie author">
                                            </a>
                                        </figure>
                                        <div class="frnd-content">
                                            <h6 class="author"><a href="profile.html">merry watson</a></h6>
                                            <p class="author-subtitle">Works at HasTech</p>
                                            <div class="request-btn-inner">
                                                <button class="frnd-btn">confirm</button>
                                                <button class="frnd-btn delete">delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="frnd-request-member">
                                        <figure class="request-thumb">
                                            <a href="profile.html">
                                                <img src=""
                                                     alt="proflie author">
                                            </a>
                                        </figure>
                                        <div class="frnd-content">
                                            <h6 class="author"><a href="profile.html">merry watson</a></h6>
                                            <p class="author-subtitle">Works at HasTech</p>
                                            <div class="request-btn-inner">
                                                <button class="frnd-btn">confirm</button>
                                                <button class="frnd-btn delete">delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <button class="notification"><i class="flaticon-notification"></i>
                                <span>03</span>
                            </button>
                        </li>
                        <li>
                            <button class="chat-trigger notification"><i class="flaticon-chats"></i>
                                <span>04</span>
                            </button>
                            <div class="mobile-chat-box">
                                <div class="live-chat-title">
                                    <!-- profile picture end -->
                                    <div class="profile-thumb">
                                        <a href="profile.html">
                                            <figure class="profile-thumb-small profile-active">
                                                <img src="{{asset('')}}Frontend/assets/images/profile/profile-small-15.jpg"
                                                     alt="profile picture">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- profile picture end -->
                                    <div class="posted-author">
                                        <h6 class="author"><a href="profile.html">Robart Marloyan</a></h6>
                                        <span class="active-pro">active now</span>
                                    </div>
                                    <div class="live-chat-settings ml-auto">
                                        <button class="chat-settings"><img
                                                    src="{{asset('')}}Frontend/assets/images/icons/settings.png" alt="">
                                        </button>
                                        <button class="close-btn"><img
                                                    src="{{asset('')}}Frontend/assets/images/icons/close.png" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="message-list-inner">
                                    <ul class="message-list custom-scroll">
                                        <li class="text-friends">
                                            <p>Many desktop publishing packages and web page editors now use Lorem Ipsum
                                                as
                                                their default model text</p>
                                            <div class="message-time">10 minute ago</div>
                                        </li>
                                        <li class="text-author">
                                            <p>Many desktop publishing packages and web page editors</p>
                                            <div class="message-time">5 minute ago</div>
                                        </li>
                                        <li class="text-friends">
                                            <p>packages and web page editors </p>
                                            <div class="message-time">2 minute ago</div>
                                        </li>
                                        <li class="text-friends">
                                            <p>Many desktop publishing packages and web page editors now use Lorem Ipsum
                                                as
                                                their default model text</p>
                                            <div class="message-time">10 minute ago</div>
                                        </li>
                                        <li class="text-author">
                                            <p>Many desktop publishing packages and web page editors</p>
                                            <div class="message-time">5 minute ago</div>
                                        </li>
                                        <li class="text-friends">
                                            <p>packages and web page editors </p>
                                            <div class="message-time">2 minute ago</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="chat-text-field mob-text-box">
                                    <textarea class="live-chat-field custom-scroll"
                                              placeholder="Text Message"></textarea>
                                    <button class="chat-message-send" type="submit" value="submit">
                                        <img src="{{asset('')}}Frontend/assets/images/icons/plane.png" alt="">
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <button class="search-trigger">
                                <i class="search-icon flaticon-search"></i>
                                <i class="close-icon flaticon-cross-out"></i>
                            </button>
                            <div class="mob-search-box">
                                <form class="mob-search-inner">
                                    <input type="text" placeholder="Search Here" class="mob-search-field">
                                    <button class="mob-search-btn"><i class="flaticon-search"></i></button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                @if(auth()->check())
                    <div class="mobile-header-profile">
                        <!-- profile picture end -->
                        <div class="profile-thumb profile-setting-box">
                            <a href="javascript:void(0)" class="profile-triger">
                                <figure class="profile-thumb-middle">
                                    <img src="{{asset('Frontend/assets/images/profile/profile-small-1.jpg')}}"
                                         alt="profile picture">
                                </figure>
                            </a>
                            <div class="profile-dropdown text-left">
                                <div class="profile-head">
                                    <h5 class="name"><a href="#">Madison Howard</a></h5>
                                    <a class="mail" href="#">mailnam@mail.com</a>
                                </div>
                                <div class="profile-body">
                                    <ul>
                                        <li><a href="profile.html"><i class="flaticon-user"></i>Profile</a></li>
                                        <li><a href="#"><i class="flaticon-message"></i>Inbox</a></li>
                                        <li><a href="#"><i class="flaticon-document"></i>Activity</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#"><i class="flaticon-settings"></i>Setting</a></li>
                                        <li><a href="signup.html"><i class="flaticon-unlock"></i>Sing out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- profile picture end -->
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="bi bi-finger-index"></i>
    </div>
    <!-- Scroll to Top End -->
</div>


{{--<!-- JS--}}
{{--============================================ -->--}}

<!-- Modernizer JS -->
<script src="{{asset('Frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<!-- jQuery JS -->
<script src="{{asset('Frontend/assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
<!-- Popper JS -->
{{--<script src="{{asset('Frontend/assets/js/vendor/popper.min.js')}}"></script>--}}
<!-- Bootstrap JS -->
{{--<script src="{{asset('Frontend/assets/js/vendor/bootstrap.min.js')}}"></script>--}}
<!-- Slick Slider JS -->
<script src="{{asset('Frontend/assets/js/plugins/slick.min.js')}}"></script>
<!-- nice select JS -->
<script src="{{asset('Frontend/assets/js/plugins/nice-select.min.js')}}"></script>

<!-- perfect scrollbar js -->
<script src="{{asset('Frontend/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<!-- light gallery js -->
<script src="{{asset('Frontend/assets/js/plugins/lightgallery-all.min.js')}}"></script>
<!-- image loaded js -->
<script src="{{asset('Frontend/assets/js/plugins/imagesloaded.pkgd.min.js')}}"></script>
<!-- isotope filter js -->
<script src="{{asset('Frontend/assets/js/plugins/isotope.pkgd.min.js')}}"></script>


<script src="{{asset('js/app.js')}}"></script>

</body>

</html>
