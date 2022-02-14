<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function index()
    {
        $plans = Plan::all();
        // return view('website.pages.packages.index', compact('plans'));
        return view('plans.index', compact('plans'));
    }

    /**
     * Show the Plan.
     *
     * @return mixed
     */
    public function show(Plan $plan, Request $request)
    {   
        $paymentMethods = $request->user()->paymentMethods();
        
        $intent = $request->user()->createSetupIntent();
        // dd($paymentMethods, $intent);
        return view('plans.show', compact('plan', 'intent'));
    }
}
