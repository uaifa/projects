<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->payment_stripe_status == 'succeeded' || auth()->user()->payment_paypal_status == 'approved'){
            return redirect()->route('dashboard');
        }
        return $next($request);
        
    }
}
