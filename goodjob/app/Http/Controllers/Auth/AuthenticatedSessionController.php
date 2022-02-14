<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        return view('admin.signin');
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // dd($request->all());
        if($request->remember === null){
            
            setcookie('login_email', $request->email, 365);
            setcookie('login_pwd', $request->password, 365);
            setcookie('login_remember', $request->remember, 365);

        }else{

            setcookie('login_email', $request->email, time()+60*60*24*365);
            setcookie('login_pwd', $request->password, time()+60*60*24*365);
            setcookie('login_remember', $request->remember, time()+60*60*24*365);
               
        }
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->route('dashboard');
        // return view('admin.dashboard');

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
