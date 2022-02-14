@php
    if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd']) && isset($_COOKIE['login_remember'])){
        $login_email = $_COOKIE['login_email'];
        $login_pwd = $_COOKIE['login_pwd'];
        $login_remember = $_COOKIE['login_remember'];
    }else{

        $login_email = '';
        $login_pwd = '';
        $login_remember = '';

    }
@endphp

<style type="text/css">
    .forgot-password-link{
        float: right;
        margin-top: -27px;
    }

    
</style>

<div class="tab-pane fade @if($login_error) show active @endif" id="login" role="tabpanel" aria-labelledby="login-tab">
    <form action="{{ route('login') }}" method="POST">
    @csrf

        <div class="form-group">
        <input type="email" class="login-field @error('email') error @enderror" id="default-01" placeholder="@lang('messages.email_placeholder')" name="email" @if($login_email || $login_error) value="{{ $login_email ?? old('email') }}" @endif required="">
        {{-- @if($errors->first('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors }}</strong>
            </span>
        @endif --}}
        </div>
        <div class="form-group">
        <input type="password" class="login-field @error('email') error @enderror" id="password" placeholder="@lang('messages.password_placeholder')" name="password" value="{{ $login_pwd ?? old('password') }}" required>
        <em class="toggle-password fa fa-fw fa-eye-slash"></em>
        {{-- @if($errors->first('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif --}}
        </div>
        <div class="form-group text-left">
            @if($login_error)
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $login_error_messages }}</strong>
                </span>
            @enderror
            @else
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $login_error_messages }}</strong>
                </span>
            @enderror
            @endif
        </div>
        <div class="form-group custom-checkbox mb-4">
            <div class="col-6">
            <input type="checkbox" @if($login_remember) checked="" @endif id="signin" name="remember" value="1">
            <label for="signin">
                <span>@lang('messages.remember_me')</span>
            </label>
            </div>
            <div class="col-6" style="float: right;">
                 @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 forgot-password-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="form-group mb-4">
            <input type="submit" class="btn btn-yellow" value="@lang('messages.sing_in')">
        </div>
        <div class="form-group">
            <a href="{{ route('login') }}" id="singup-tab" class="login-link">
                 @lang('messages.sign_up_with') 
             </a>
        </div>
    </form>
</div>