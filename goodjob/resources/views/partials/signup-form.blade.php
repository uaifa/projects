<style type="text/css">
    .custom-checkbox-:before{
        content: '';
        -webkit-appearance: none;
        background-color: transparent;
        border: 2px solid #324755;
        padding: 10px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        width: 32px;
        height: 32px;
    }


[type="checkbox"] + span {
  position: relative;
    width: 21%;
    word-wrap: break-word;
}

/* the basic, unchecked style */
[type="checkbox"] + span:before {
    content: '';
    display: inline-block;
    width: 2em;
    height: 2em;
    vertical-align: -0.25em;
    border: 2px solid #DADEE2;
    border-radius: 3px;
    margin-right: 0.75em;
    transition: 0.5s ease all;

    content: '';
    -webkit-appearance: none;
    background-color: transparent;
    border: 2px solid #324755;
    padding: 10px;
    display: inline-block;
    position: relative;
    vertical-align: middle;
    cursor: pointer;
    width: 32px;
    height: 32px;
    margin-right: 7px;
}
 
/* This adds the checkmark itself */
[type="checkbox"]:checked + span:after {
    /*content: '\2713';
    position: absolute;
    left: 12px;
    color: #FFF;
    top: 0;
*/
    content: '';
    display: block;
    position: absolute;
    top: 0;
    left: 13px;
    width: 8px;
    height: 16px;
    border: 1px  solid #fff;
    border-width: 0 2px  2px 0;
    transform: rotate(45deg);
}

/* This adds the focus styling when unchecked */
[type="checkbox"]:focus + span:before {
  content: '';
  border: 2px solid #006EB3;
}

#accessible-and-pretty{
    opacity: 0;
    position: absolute;
    top: 20px;
    left: 12px;
}
</style>



<div class="tab-pane fade @if(!$login_error) show active @endif" id="singup" role="tabpanel" aria-labelledby="singup-tab">
    <form method="POST" action="{{ route('register') }}" id="signup_form" name="signup_form">
        @csrf
        <div class="form-group">
            <input type="text" placeholder="@lang('messages.first_name_placeholder')" class="login-field" name="first_name" value="{{ old('first_name') }}" required autofocus id="first_name" />
            @if($errors->first('first_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input type="text" placeholder="@lang('messages.last_name_placeholder')" class="login-field" name="last_name" value="{{ old('last_name') }}" required autofocus id="last_name" />
            @if($errors->first('last_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input type="email" placeholder="@lang('messages.email_placeholder')" class="login-field" name="email" @if(!$login_error) value="{{ old('email') }}" @endif required  id="email">
            @if($errors->first('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input type="password" placeholder="@lang('messages.password_placeholder')" class="login-field" input id="password" name="password" required autocomplete="new-password" value="{{ old('password') }}">
            <em class="toggle-password fa fa-fw fa-eye-slash"></em>
            @if($errors->first('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input type="password" placeholder="@lang('messages.confirm_password_placeholder')" class="login-field" id="password_confirmation" name="password_confirmation" required>
            <em class="toggle-password fa fa-fw fa-eye-slash"></em>
            @if($errors->first('password_confirmation'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group mb-4 pt-3 text-check">
            <label for="accessible-and-pretty" style="position:relative;">
                <input type="checkbox" value="term_condition" name="term_condition" id="accessible-and-pretty" required> 
                <span><b>@lang('messages.registering_agree_text')</b> </span>
            </label>
            @if($errors->first('term_condition'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('term_condition') }}</strong>
                </span>
            @endif
        </div>
        <div class="clearfix"></div>
        <div class="form-group mb-4 mt-5">
            <input type="submit" class="btn btn-yellow" value="@lang('messages.create')">
        </div>
        <div class="form-group">
            <a href="{{ route('login') }}" class="login-link"> @lang('messages.sign_in_with') </a>
        </div>
    </form>
</div>



@push('js')

@endpush