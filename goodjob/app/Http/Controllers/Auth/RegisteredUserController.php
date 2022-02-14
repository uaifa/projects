<?php

namespace App\Http\Controllers\Auth;

use App\Events\WelcomeMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(AuthUserRequest $request)
    {
        // $request->validate([
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => 'required|confirmed|min:8|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,20}$/', //password
        //     // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'password_confirmation' => 'required',
        // ],[
        //     'first_name.required' => __('messages.first_name_required'),
        //     'first_name.string' => __('messages.first_name_string'),
        //     'last_name.required' => __('messages.last_name_required'),
        //     'last_name.string' => __('messages.last_name_string'),
        //     'email.required' => __('messages.email_required'),
        //     'email.string' => __('messages.email_string'),
        //     'email.email' => __('messages.email_email'),
        //     'email.unique' => __('messages.email_unique'),
        //     'password.required' => __('messages.password_required'),
        //     'password.confirmed' => __('messages.password_confirmed'),
            
        // ]);
     
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->user_password = $request->password;
        
        // event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
