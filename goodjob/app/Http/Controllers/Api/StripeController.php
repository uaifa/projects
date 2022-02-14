<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\User;

class StripeController extends Controller
{
    

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
                        $users->package_type = request()->package_type;
                        $users->payment_status = 1;
                        $users->stripe_start_date = now();
                        $users->save();
                         
                        $status = 'success'; 
                        $statusMsg = 'Your Payment has been Successful!'; 
                        
                        return sendSuccessResponse(__('messages.stripe_payment_detail'), $paymentIntent);
                    }else{ 
                        $statusMsg = "Transaction has been failed!"; 
                        return sendErrorResponse(__('messages,transaction_has_been_failed!'));
                    } 
                }else{ 
                    $statusMsg = "Unable to fetch the transaction details! $api_error"; 
                    return sendErrorResponse(__('messages.unable_to_fetch_the_transaction_details'), $api_error); 
                } 
            }else{ 
                $statusMsg = "Invalid Transaction! $api_error";
                return sendErrorResponse(__('messages.invalid_transaction'), $api_error);   
            } 
             
        }else{ 
            $statusMsg = "Invalid Request!";
            return sendErrorResponse(__('messages.invalid_request'));   
        } 
        
        dd("success");
    }
}
