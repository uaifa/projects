<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class SubscriptionsController extends Controller
{
    protected $stripe;

    public function __construct() 
    {
        // dd(env('STRIPE_SECRET'));
        $stripe_key = env('STRIPE_SECRET');
        $this->stripe = new StripeClient($stripe_key);
    }

    public function create(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));
        
        $user = $request->user();
        $paymentMethod = $request->paymentMethod;

        $user->createOrGetStripeCustomer();

        $user->updateDefaultPaymentMethod($paymentMethod);
        $user->newSubscription('default', $plan->stripe_plan)
            ->create($paymentMethod, [
                'email' => $user->email,
            ]);
        dd($user, $paymentMethod);
        return redirect()->route('home')->with('success', 'Your plan subscribed successfully');
    }


    public function createPlan()
    {
        return view('plans.create');
    }

    public function storePlan(Request $request)
    {   

        dd($this->stripe->products->all(), $this->stripe->plans->all());
        $data = $request->except('_token');

        $data['slug'] = strtolower($data['name']);
        $price = $data['cost'] *100; 

        //create stripe product
        $stripeProduct = $this->stripe->products->create([
            'name' => $data['name'],
            'images' => '',
            'description' => '',
            'tax_code' => '',
            'type' => 'service',
            'unit_label' => '',

        ]);
        
        // dd($stripeProduct);
        
        //Stripe Plan Creation
        $stripePlanCreation = $this->stripe->plans->create([
            'amount' => $price,
            'currency' => 'inr',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripeProduct->id,
        ]);

        // use ApiOperations\All;
        // use ApiOperations\Create;
        // use ApiOperations\Delete;
        // use ApiOperations\Retrieve;
        // use ApiOperations\Update;


        $data['stripe_plan'] = $stripePlanCreation->id;

        Plan::create($data);

        echo 'plan has been created';
    }

    public function checkout($price_id){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // header('Content-Type: application/json');
        $result_s = decryptstring($price_id);
        if(isset($result_s['status'])){
            smilify('error', __('messages.something_went_wrong'));
            return back();
        }

        try {
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
              'price' => decryptstring($price_id),
              'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => url('success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => url('/cancel'),
          ]);
    
          header("HTTP/1.1 303 See Other");
          return redirect()->to($checkout_session->url);
          header("Location: " . $checkout_session->url);
          dd("oka",$checkout_session->url);
        } catch (Error $e) {
          http_response_code(500);
          dd($e->getMessage());
          echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function success(){
        $result = $this->stripe->checkout->sessions->retrieve(request()->session_id);
        $result = json_encode($result);
        $result=json_decode($result);
       
        $subscriptions = $this->stripe->subscriptions->retrieve($result->subscription);
        // $payment = $this->stripe->issuing->transactions->retrieve($result->id);

        $subscriptions = json_encode($subscriptions);
        $subscriptions=json_decode($subscriptions);
        $user = auth()->user();
        $data['user_id'] = auth()->user()->id;
        $data['name'] = $user->first_name.' '.$user->last_name;
        $data['stripe_id'] = $result->id;
        $data['stripe_status'] = $result->status;
        $data['stripe_price'] = $result->amount_total;
        // $data['quantity'] = ;
        $data['trial_ends_at'] = date('Y-m-d h:i:s', $subscriptions->current_period_end);
        $data['ends_at'] = date('Y-m-d h:i:s', $subscriptions->current_period_end);
        
        DB::table('subscriptions')->insert($data);

        $user->current_subscription_start = $subscriptions->created;
        $user->current_subscription_end = $subscriptions->current_period_end;
        $user->stripe_payment_status = $result->status;
        $user->save();

        smilify('success', 'Your plan subscribed successfully!');

        return redirect()->to('admin/dashboard');

        dd('success', $result, $result->subscription, $subscriptions);
    }


}
