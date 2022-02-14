<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\Plan;
use App\Models\User;
use DateTime;

class StripeController extends Controller
{
    
    public function __construct(){

        Stripe::setApiKey(env('STRIPE_SECRET')); 
    }
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function index()
    {
        $plans = Plan::all();
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
        
        return view('plans.show', compact('plan', 'intent'));
    }
    
    public function indexs()
    {
        return view('partials.stripe-payments');
    }

    public function orderPost(Request $request)
    {
            $user = auth()->user();
            $input = $request->all();
            $token =  $request->stripeToken;
            $paymentMethod = $request->paymentMethod;
            try {
                $key = env('STRIPE_SECRET');
                $stripe_key = Stripe::setApiKey(env('STRIPE_SECRET'));
                // dd($stripe_key,env('STRIPE_SECRET'));
                if (is_null($user->stripe_id)) {
                    $stripeCustomer = $user->createAsStripeCustomer();
                }

                Customer::createSource(
                    $user->stripe_id,
                    ['source' => $token]
                );

                $user->newSubscription('test',$input['plane'])
                    ->create($paymentMethod, [
                    'email' => $user->email,
                ]);
                // dd($user);
                return back()->with('success','Subscription is completed.');
            } catch (Exception $e) {
                // dd($e->getMessage());
                return back()->with('success',$e->getMessage());
            } 
    }

    // public function __construct() {
    //     $this->middleware('auth');
    // }
    public function retrievePlans() {
        $key = \config('services.stripe.secret');
        $stripe = new StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;
        
        foreach($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
        }
        return $plans;
    }
    public function showSubscription() {
        $plans = $this->retrievePlans();
        $user = Auth::user();
        
        return view('seller.pages.subscribe', [
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'plans' => $plans
        ]);
    }
    public function processSubscription(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
                    
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        try {
            $user->newSubscription('default', $plan)->create($paymentMethod, [
                'email' => $user->email
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        
        return redirect('dashboard');

        // stripe webhooks 

    }
    public function stripe_checkout($package_id = ''){

        $result_s = decryptstring($package_id);
        if(isset($result_s['status'])){
            smilify('error', __('messages.something_went_wrong'));
            return back();
        }
        Stripe::setApiKey(env('STRIPE_SECRET')); 

        $package_detail = Package::find(decryptstring($package_id));
        
        session()->put('package_id', decryptstring($package_id));

        $product_name = $package_detail->package_name;
        $product_id = $package_detail->id;
        $stripe_amount = $package_detail->price;
        $currency = 'USD'; //$package_detail->currency;
        $product_price = $package_detail->price;

        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Invalid Request!'    
            ) 
        ); 
         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $input = file_get_contents('php://input'); 
            $request = json_decode($input);     
        } 
         
        if (json_last_error() !== JSON_ERROR_NONE) { 
            http_response_code(400); 
            echo json_encode($response); 
            exit; 
        } 
        
        $package_id = session()->get('package_id');
        $package_id = encryptstring($package_id);


        if(!empty($request->createCheckoutSession)){ 
            // Convert product price to cent 
            $stripe_amount = round($product_price*100, 2); 
         
            // Create new Checkout Session for the order 
            try { 
                $checkout_session = \Stripe\Checkout\Session::create([ 
                    'line_items' => [[ 
                      'price_data' => [ 
                            'product_data' => [ 
                                'name' => $product_name, 
                                'metadata' => [ 
                                    'pro_id' => $product_id 
                                ] 
                            ], 
                            'unit_amount' => $stripe_amount, 
                            'currency' => $currency, 
                        ], 
                        'quantity' => 1, 
                        'description' => $product_name, 
                    ]], 
                    'mode' => 'payment', 
                    'success_url' => route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}', 
                    'cancel_url' =>  url('payments/'.$package_id), //route('stripe.cancel'), 
                ]); 
            } catch(Exception $e) {  
                $api_error = $e->getMessage();  
            } 
             
            if(empty($api_error) && $checkout_session){ 
                $response = array( 
                    'status' => 1, 
                    'message' => 'Checkout Session created successfully!', 
                    'sessionId' => $checkout_session->id 
                ); 
            }else{ 
                $response = array( 
                    'status' => 0, 
                    'error' => array( 
                        'message' => 'Checkout Session creation failed! '.$api_error    
                    ) 
                ); 
            } 
        } 
         
        // Return response 
        echo json_encode($response); 
    }

    public function success(){

        $product_name = 'New product';
        $product_id = '0012';
        $stripe_amount = 11;
        $currency = 'usd';
        $product_price = 11;

        Stripe::setApiKey(env('STRIPE_SECRET')); 


        $payment_id = $statusMsg = ''; 
        $status = 'error'; 
         
        // Check whether stripe checkout session is not empty 
        if(!empty(request()->session_id)){ 
            $session_id = request()->session_id; 
            // dd($session_id); 
            // Fetch the Checkout Session to display the JSON result on the success page 
            try { 
                $checkout_session = \Stripe\Checkout\Session::retrieve($session_id); 
            } catch(Exception $e) {  
                $api_error = $e->getMessage();  
            } 
             
            if(empty($api_error) && $checkout_session){ 
                // Retrieve the details of a PaymentIntent 
                try { 
                    $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent); 

                } catch (\Stripe\Exception\ApiErrorException $e) { 
                    $api_error = $e->getMessage(); 
                } 
                 
                // Retrieves the details of customer 
                try { 
                    $customer = \Stripe\Customer::retrieve($checkout_session->customer); 
                } catch (\Stripe\Exception\ApiErrorException $e) { 
                    $api_error = $e->getMessage(); 
                } 
                 
                if(empty($api_error) && $paymentIntent){  
                    // dd($paymentIntent);
                    // Check whether the payment was successful 
                    if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){ 
                        // Transaction details  
                        $transaction_id = $paymentIntent->id; 
                        $paid_amount = $paymentIntent->amount; 
                        $paid_amount = ($paid_amount/100); 
                        $paid_currency = $paymentIntent->currency; 
                        $payment_status = $paymentIntent->status; 
                         
                        // Customer details 
                        $customer_name = $customer_email = ''; 
                        if(!empty($customer)){ 
                            $customer_name = !empty($customer->name)?$customer->name:''; 
                            $customer_email = !empty($customer->email)?$customer->email:''; 
                        } 
                         
                         $transaction = new Transaction();
                         $transaction->customer_name = $customer_name;
                         $transaction->customer_email = $customer_email;
                         $transaction->item_name = $product_name;
                         $transaction->item_number = $product_id;
                         $transaction->item_price = $paid_amount;
                         $transaction->item_price_currency = $currency;
                         $transaction->paid_amount = $paid_amount;
                         $transaction->paid_amount_currency = $paid_currency;
                         $transaction->txn_id = $transaction_id;
                         $transaction->payment_status = $payment_status;
                         $transaction->stripe_checkout_session_id = $session_id;
                         $transaction->user_id = auth()->user()->id;
                         $transaction->created = now();
                         $transaction->modified = now();
                         $transaction->save();

                        $users = User::find(auth()->user()->id);
                        $users->payment_stripe_status = $payment_status;
                        $users->package_type = session()->get('package_id');
                        $users->payment_status = 1;
                        $users->stripe_start_date = now();
                        $users->payment_type = 'paid';
                        $users->package_start_date_time = now();
                        
                        $dt2 = new DateTime("+1 month");
                        $date = $dt2->format("Y-m-d");
                        $users->package_end_date_time = $date;
                        $users->save();
                         
                        $status = 'success'; 
                        $statusMsg = 'Your Payment has been Successful!'; 
                        smilify('success', 'Your plan subscribed successfully!');
                        return redirect()->to('admin/dashboard');
                    }else{ 
                        $statusMsg = "Transaction has been failed!"; 
                    } 
                }else{ 
                    $statusMsg = "Unable to fetch the transaction details! $api_error";  
                } 
            }else{ 
                $statusMsg = "Invalid Transaction! $api_error";  
            } 
             
        }else{ 
            $statusMsg = "Invalid Request!"; 
        } 
        
        dd("success");
    }
    public function cancel(){
        dd("payment cancels ");
    }
 
}
