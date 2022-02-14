@include('partials.login-signup-head')
    <div class="p-text">
        <h2>@lang('messages.reset_password_text_title')</h2>
        <p></p>
    </div>
    <div class="login-wrap">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-group mt-5">
                <input id="email" class="login-field" type="email" name="email" value="{{ $request->email }}" readonly="" required autofocus placeholder="@lang('messages.email_placeholder')" />
            </div>
            <div class="form-group">
                <input type="password" placeholder="@lang('messages.password_placeholder')" class="login-field" input id="password" name="password" required autocomplete="new-password" >
            </div>
            <div class="form-group">
                <input type="password" placeholder="@lang('messages.confirm_password_placeholder')" class="login-field" id="password_confirmation" name="password_confirmation" required>
            </div>

                @error('email')
                <div class="form-group text-left pb-3">
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
                @error('password')
                   <div class="form-group text-left pb-3">
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
            
            <div class="form-group mb-4 mt-3">
                <input type="submit" class="btn btn-yellow" value="@lang('messages.reset_password')">
            </div>


        </form>
    </div>

@include('partials.login-signup-footer')

{{-- 
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
 --}}