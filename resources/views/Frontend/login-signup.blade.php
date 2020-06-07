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

<body class="bg-transparent">

<main id="app">
    <div class="main-wrapper pb-0 mb-0">
        <div class="timeline-wrapper">
            <div class="timeline-header">
                <div class="container-fluid p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-5">
                            <div class="timeline-logo-area d-flex align-items-center">
                                <div class="timeline-logo">
                                    <a href="{{url('/')}}">
                                        <img src="{{asset('Frontend/assets/images/logo/logo.png')}}"
                                             alt="timeline logo">
                                    </a>
                                </div>
                                <div class="timeline-tagline">
                                    <h6 class="tagline"><strong>Welcome
                                            to {{ config('app.name', 'Mild Thoughts') }}</strong>
                                        It’s helps you to connect and share your thoughts with the
                                        people around the globe.</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="login-area">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-6 col-sm">
                                            <input id="email" type="email" placeholder="Email"
                                                   class="single-field @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong style="color: black">{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>
                                        <div class="col-6 col-sm">
                                            <input id="password" type="password" placeholder="Password"
                                                   class="single-field @error('password') is-invalid @enderror"
                                                   name="password"
                                                   required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong style="color: black">{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>


                                        <div class="col-12 col-sm-auto">
                                            <button type="submit" class="login-btn">
                                                {{ __('Login') }}
                                            </button>
                                        </div>

                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-6 col-sm">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif

                                        </div>
                                        <div class="col-6 col-sm">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-page-wrapper">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-5 order-2 order-lg-1">
                            <div class="timeline-bg-content bg-img"
                                 data-bg="">
                                <img src="{{asset('images/Thought.png')}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 order-1 order-lg-2 d-flex align-items-center justify-content-center">
                            <div class="signup-form-wrapper">
                                <h1 class="create-acc text-center">Create An Account</h1>
                                <div class="signup-inner text-center">
                                    <h3 class="title">Welcome to {{ config('app.name', 'Mild Thoughts') }}</h3>
                                    <form class="signup-inner--form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <input id="email" type="email" placeholder="Email"
                                                       class="single-field @error('email') is-invalid @enderror"
                                                       name="email"
                                                       value="{{ old('email') }}" required>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <input id="name" placeholder="Username" type="text"
                                                       class="single-field @error('name') is-invalid @enderror"
                                                       name="name" value="{{ old('name') }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input id="password" type="password" placeholder="Password"
                                                       class="single-field @error('password') is-invalid @enderror"
                                                       name="password"
                                                       required>

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input id="password-confirm" placeholder="Confirm Password"
                                                       type="password" class="single-field"
                                                       name="password_confirmation" required>
                                            </div>

                                            <div class="col-12">
                                                <button class="submit-btn" type="submit">Create My Account</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

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