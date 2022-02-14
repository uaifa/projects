<?php

namespace App\Http\Controllers\Website;

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

class PaypalController extends Controller
{
    
    private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return view('paywithpaypal');
    }

    public function postPaymentWithpaypal(Request $request, $package_id = '')
    {
        $result_s = decryptstring($package_id);
        if(isset($result_s['status'])){
            smilify('error', __('messages.something_went_wrong'));
            return back();
        }
        $package_id = decryptstring($package_id);

        session()->put('package_id', $package_id);

        $package_detail = Package::find($package_id);
        $request['amount'] = $package_detail->price;
        $request['currency'] = (isset($package_detail->currency) && !empty($package_detail->currency)) ? $package_detail->currency : 'USD';
        // dd($package_detail);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        // dd($request->get('currency'));
        $item_1 = new Item();

        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (Config::get('app.debug')) {
                Session::put('error','Connection timeout');
                smilify('error', 'Connection timeout!');
                $package_id = session()->get('package_id');
                $package_id = encryptstring($package_id);
                return Redirect::to('payments/'.$package_id);
                return Redirect::route('paywithpaypal');                
            } else {
                Session::put('error','Some error occur, sorry for inconvenient');
                smilify('error', 'Some error occur, sorry for inconvenient!');
                $package_id = session()->get('package_id');
                $package_id = encryptstring($package_id);
                return Redirect::to('payments/'.$package_id);

                return Redirect::route('paywithpaypal');                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        Session::put('error','Unknown error occurred');
        smilify('error', 'Unknown error occurred!');
        $package_id = session()->get('package_id');
        $package_id = encryptstring($package_id);
        return Redirect::to('payments/'.$package_id);

        return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            Session::put('error','Payment failed');
            $package_id = session()->get('package_id');
            $package_id = encryptstring($package_id);
            return Redirect::to('payments/'.$package_id);
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
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
            $users->package_type = session()->get('package_id');
            $users->payment_status = 1;
            $users->paypal_start_date = now();
            $users->payment_type = 'paid';
            $users->package_start_date_time = now();
            $dt2 = new DateTime("+1 month");
            $date = $dt2->format("Y-m-d");
            $users->package_end_date_time = $date;
            $users->save();
            
            // dd($data);
            Session::put('success','Payment success !!');
            smilify('success', 'Your plan subscribed successfully!');
            return redirect()->to('admin/dashboard');

            return Redirect::route('paywithpaypal');
        }
        // dd($result);
        Session::put('error','Payment failed !!');
        smilify('error', 'Payment failed!');
        return redirect()->to('packages');
        return Redirect::route('paywithpaypal');
    }
}
