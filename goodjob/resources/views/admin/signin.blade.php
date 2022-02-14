@php
$login_error = false;
$login_error_messages = 'These credentials do not match our records.';
if ($errors->any()){
    foreach ($errors->all() as $error){
        if ($error == 'These credentials do not match our records.'){
            $login_error = true;
        }
    }
}
@endphp

@push('title')
    Sign Up / Sign In 
@endpush

@include('partials.login-signup-head')
    <div class="p-text">
        <h2>Nice to see you!</h2>
        <p>Create an account or log in.</p>
    </div>
    <div class="login-wrap">
        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-linkX @if(!$login_error) active @endif" id="singup-tab" data-bs-toggle="tab" data-bs-target="#singup" type="button" role="tab" aria-controls="singup" aria-selected="true">Create an account</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-linkX @if($login_error) active @endif" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="false">Login</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            @include('partials.signup-form')
            @include('partials.login-form')
        </div>
        <div class="social-icon mb-5">
            <a href="{{ route('login', 'google') }}">
                <img src="{{ asset('assets/images/social-google.png') }}">
            </a>
            <a href="{{ route('login', 'facebook') }}">
                <img src="{{ asset('assets/images/social-facebook.png') }}">
            </a>
          {{--   <a href="{{ route('login', 'linkedin') }}">
                <img src="{{ asset('assets/images/social-linkedin.png') }}">
            </a>
            <a href="{{ route('login', 'twitter') }}">
                <img src="{{ asset('assets/images/social-twitter.png') }}">
            </a> --}}
        </div>
    </div>
@include('partials.login-signup-footer')

<!-- <!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <title>Goodjob-Login</title>
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon icon.png') }}">
    <link rel="stylesheet" href="{{ asset('admin/dashlite-template/css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dashlite-template/css/theme.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em
                                        class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                    <a href="{{ route('login') }}" class="logo-link">
                                        <img class="logo-light logo-img logo-img-lg"
                                            src="{{ asset('admin/images/favicon.png') }}"
                                            srcset="./images/logo2x.png 2x" alt="logo">
                                        <img class="logo-dark logo-img logo-img-lg"
                                            src="{{ asset('admin/images/favicon.png') }}"
                                            srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Welcome Back</h5>
                                        <div class="nk-block-des">
                                            {{-- <p>Access the goodjob panel using your email and passcode.</p> --}}
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email <span
                                                    class="form-note text-danger d-inline-block">@error('email')
                                                        {{ $message }}</span>
                                                @enderror</label>
                                            {{-- <a class="link link-primary link-sm" tabindex="-1" href="#">Need Help?</a> --}}
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-lg @error('email') error @enderror"
                                            id="default-01" placeholder="Enter your email address " name="email"
                                            value="{{ old('email') }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Passcode <span
                                                    class="form-note text-danger d-inline-block"> @error('password')
                                                        {{ $message }}</span>
                                                @enderror</label>
                                            {{-- <a class="link link-primary link-sm" tabindex="-1"
                                                href="html/pages/auths/auth-reset.html">Forgot Code?</a> --}}
                                        </div>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password"
                                                class="form-control form-control-lg @error('email') error @enderror"
                                                id="password" placeholder="Enter your passcode" name="password">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                                <a href="{{ url('/login/facebook') }}" class="btn btn-facebook"> Facebook</a>
                                <a href="{{ url('/login/google') }}" class="btn btn-google-plus"> Google</a>
                                {{-- <div class="form-note-s2 pt-4"> New on our platform? <a
                                        href="html/pages/auths/auth-register.html">Create an account</a>
                                </div>
                                <div class="text-center pt-4 pb-3">
                                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                                </div>
                                <ul class="nav justify-center gx-4">
                                    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
                                </ul>
                                <div class="text-center mt-5">
                                    <span class="fw-500">I don't have an account? <a href="#">Try 15 days
                                            free</a></span>
                                </div> --}}
                            </div>
                            {{-- <div class="nk-block nk-auth-footer">
                                <div class="nk-block-between">
                                    <ul class="nav nav-sm">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link"
                                                data-toggle="dropdown" data-offset="0,10"><small>English</small></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/english.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/spanish.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/french.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">Français</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/turkey.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                                <div class="mt-3">
                                    <p>&copy; 2019 DashLite. All Rights Reserved.</p>
                                </div>
                            </div>--}}
                        </div>
                        <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
                            data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                            <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                                <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                                    <div class="slider-item">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round"
                                                    src="{{ asset('admin/images/promo-a2x.png') }}"
                                                    srcset="./images/slides/promo-a2x.png 2x" alt="">
                                            </div>
                                            {{-- <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Dashlite</h4>
                                                <p>You can start to create your products easily with its user-friendly
                                                    design & most completed responsive layout.</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="slider-item">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round"
                                                    src="{{ asset('admin/images/promo-b2x.png') }}"
                                                    srcset="./images/slides/promo-b2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Dashlite</h4>
                                                <p>You can start to create your products easily with its user-friendly
                                                    design & most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round"
                                                    src="{{ asset('admin/images/promo-c2x.png') }}"
                                                    srcset="./images/slides/promo-c2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Dashlite</h4>
                                                <p>You can start to create your products easily with its user-friendly
                                                    design & most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="slider-dots"></div>
                                <div class="slider-arrows"></div>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
           
        </div>
       
    </div>
    <script src="{{ asset('admin/dashlite-template/js/bundle.js') }}"></script>
    <script src="{{ asset('admin/dashlite-template/js/scripts.js') }}"></script>

</html>
    -->