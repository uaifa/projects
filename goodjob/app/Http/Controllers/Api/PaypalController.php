<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use App\Models\Package;
use App\Models\Transaction as ModelsTransaction;
use App\Models\User;
use DateTime;
use Exception;
use Stripe\Stripe;


class PaypalController extends Controller
{
    
    private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }
    
    public function get_payment_detail(Request $request)
    {        
        
        if(request()->payment_type == 'stripe'){
            try{
                $result = $this->check_payment_detail();
            }catch(Exception $e){
                return sendErrorResponse(__('messages.something_went_wrong'), []);
            }
            
            if($result['status'] == 'error'){
                return sendErrorResponse($result['messages'], $result['data']);
            }else{
                return sendSuccessResponse($result['messages'], $result['data']);
            }
        }else if(request()->payment_type == 'paypal'){
            try{
                $result = $this->check_payment_detail_paypal($request);
            }catch(Exception $e){
                return sendErrorResponse(__('messages.something_went_wrong'), []);
            }
            
            if($result['status'] == 'error'){
                return sendErrorResponse($result['messages'], $result['data']);
            }else{
                return sendSuccessResponse($result['messages'], $result['data']);
            }
        }else if(request()->payment_type == 'free'){
            try{
                $result = $this->set_package_free();
            }catch(Exception $e){
                return sendErrorResponse(__('messages.something_went_wrong'), []);
            }
            
            if($result['status'] == 'error'){
                return sendErrorResponse($result['messages'], $result['data']);
            }else{
                return sendSuccessResponse($result['messages'], $result['data']);
            }
        }
    }
    public function check_payment_detail_paypal($request){
        $payment_id = $request->input('paymentId'); //Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            Session::put('error','Payment failed');
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        // dd($result);
        $data = [];
        if ($result->getState() == 'approved') {
            $transactions = $result->getTransactions();
            $total_price = 0;
            $currency = '';
            foreach ($transactions as $key => $value) {
                $total_price = $value->getAmount()->total;
                $currency = $value->getAmount()->currency;
            }
            $users = User::find(auth()->user()->id);
            $users->payment_paypal_status = $result->getState();
            $data['item_price'] = $total_price;
            $data['item_price_currency'] = $currency;
            $data['paid_amount_currency'] = $currency;
            $data['payment_type'] = 'paypal';    
            $data['payment_id'] = $result->getId();
            $data['payment_state'] = $result->getState();
            $data['payer_status'] = $result->getPayer()->status;
            $data['payment_status'] = $result->getState();
            $data['payer_id'] = $result->getPayer()->getPayerInfo()->payer_id;
            $data['created'] = $result->create_time;
            $data['modified'] = $result->create_time;
            $data['user_id'] = auth()->user()->id;
            $data['customer_name'] = $result->getPayer()->getPayerInfo()->first_name .' '.$result->getPayer()->getPayerInfo()->last_name;
            $data['customer_email'] = $result->getPayer()->getPayerInfo()->email;
            ModelsTransaction::insert($data);
            
            $users->paypal_start_date = now();
            $users->package_type = request()->package_type;
            $users->payment_type = 'paid';
            $users->package_start_date_time = now();
            $dt2 = new DateTime("+1 month");
            $date = $dt2->format("Y-m-d");
            $users->package_end_date_time = $date;
     
            $users->save();
            
            // dd($data);
            Session::put('success','Payment success !!');
            $data['status'] = 'success';
            $data['messages'] = __('messages.user_subscribe_successfull');
            $data['data'] = $result;
            return $data;
            return sendSuccessResponse(__('messages.payment_success'), $result);
        }
        // dd($result);
        Session::put('error','Payment failed !!');
        $data['status'] = 'error';
        $data['messages'] = __('messages.payment_failed');
        $data['data'] = [];
        return $data;
        return sendSuccessResponse(__('messages.payment_failed'));
    }

    public function check_payment_detail(){

        $product_name = 'New product';
        $product_id = '0012';
        $stripe_amount = 11;
        $currency = 'usd';
        $product_price = 11;

        Stripe::setApiKey(env('STRIPE_SECRET')); 
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $pi = $stripe->paymentIntents->retrieve(
          request()->session_id,
          []
        );
        // dd($pi);
        $payment_id = $statusMsg = ''; 
        $status = 'error'; 
         
        // Check whether stripe checkout session is not empty 
        if(!empty(request()->session_id)){ 
            $session_id = request()->session_id; 
                 
            // Fetch the Checkout Session to display the JSON result on the success page 
            try { 
                $checkout_session = $stripe->paymentIntents->retrieve(
                      request()->session_id,
                      []
                    ); 
            } catch(Exception $e) {  
                $api_error = $e->getMessage();  
            } 
             // dd($checkout_session);
            if(empty($api_error) && $checkout_session){ 
                // Retrieve the details of a PaymentIntent 
                try { 
                    $paymentIntent = \Stripe\PaymentIntent::retrieve(request()->session_id); 

                } catch (\Stripe\Exception\ApiErrorException $e) { 
                    $api_error = $e->getMessage(); 
                } 
                 // return sendSuccessResponse(__('messages.stripe_payment_detail'), $paymentIntent);
                 // dd($paymentIntent);
                // Retrieves the details of customer 
               if($checkout_session->customer){
                    $customer = \Stripe\Customer::retrieve($checkout_session->customer); 
               }
                // try { 
                //     $customer = \Stripe\Customer::retrieve($checkout_session->customer); 
                // } catch (\Stripe\Exception\ApiErrorException $e) { 
                //     $api_error = $e->getMessage(); 
                // } 
                 // dd($api_error);
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
                         
                         $transaction = new ModelsTransaction();
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
                        $users->package_type = request()->package_type;
                        $users->payment_status = 1;
                        $users->payment_type = 'paid';
                        $users->stripe_start_date = now();
                        $users->package_start_date_time = now();
                        $dt2 = new DateTime("+1 month");
                        $date = $dt2->format("Y-m-d");
                        $users->package_end_date_time = $date;
                        $users->save();
                         
                        $status = 'success'; 
                        $statusMsg = 'Your Payment has been Successful!'; 
                        
                        $data['status'] = 'success';
                        $data['messages'] = __('messages.user_subscribe_successfull');
                        $data['data'] = $paymentIntent;
                        return $data;
                        return sendSuccessResponse(__('messages.stripe_payment_detail'), $paymentIntent);
                    }else{ 
                        $statusMsg = "Transaction has been failed!";
                        $data['status'] = 'error';
                        $data['messages'] = __('messages.transaction_has_been_failed');
                        $data['data'] = $paymentIntent;
                        return $data; 
                        return sendErrorResponse(__('messages,transaction_has_been_failed!'));
                    } 
                }else{ 
                    $statusMsg = "Unable to fetch the transaction details! $api_error"; 
                    $data['status'] = 'error';
                    $data['messages'] = __('messages.unable_to_fetch_the_transaction_details');
                    $data['data'] = $api_error;
                    return $data; 
                    return sendErrorResponse(__('messages.unable_to_fetch_the_transaction_details'), $api_error); 
                } 
            }else{ 
                $statusMsg = "Invalid Transaction! $api_error";
                $data['status'] = 'error';
                $data['messages'] = __('messages.invalid_transaction');
                $data['data'] = $api_error;
                return $data; 
                return sendErrorResponse(__('messages.invalid_transaction'), $api_error);   
            } 
             
        }else{ 
            $statusMsg = "Invalid Request!";
            $data['status'] = 'error';
            $data['messages'] = __('messages.invalid_request');
            $data['data'] = [];
            return $data;
            return sendErrorResponse(__('messages.invalid_request'));   
        } 
        
        dd("success");
    }

    public function set_package_free(){

        $users = User::find(auth()->user()->id);
        $users->package_type = request()->package_type;
        $users->payment_status = 1;
        $users->payment_type = 'free';
        $users->stripe_start_date = now();
        $users->package_start_date_time = now();
        $dt2 = new DateTime("+1 month");
        $date = $dt2->format("Y-m-d");
        $users->package_end_date_time = $date;
        $users->save();

        $data['status'] = 'success';
        $data['messages'] = __('messages.user_subscribe_successfull');
        $data['data'] = [];
        return $data;

        return sendSuccessResponse(__('messages.user_subscribe_successfull'), $users);

    }
}
