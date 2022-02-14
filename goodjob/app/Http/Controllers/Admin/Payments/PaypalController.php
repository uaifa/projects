<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('partials.payments');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $provider->getAccessToken();

        // $accessToken = $provider->getAccessToken();
        // $accessToken = $accessToken['access_token'];

        // $this->provider->getAccessToken();
        $payment_id = 'YDEMNW77N5ETJ';
   
      
        $url = "https://api.sandbox.paypal.com/v2/checkout/orders/YDEMNW77N5ETJ";
        $accessToken = $provider->getAccessToken();
        $accessToken = $accessToken['access_token'];
        // dd();
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        $response = curl_exec($curl);

        print_r($response);
        exit;

        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
          // Execute payment
          $result = $payment->execute($execution, $apiContext);
          var_dump($result);
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
          echo $ex->getCode();
          echo $ex->getData();
          die($ex);
        } catch (Exception $ex) {
          die($ex);
        }

        dd(request()->all());
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
    

    public function add_product(){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // $products = $provider->listProducts();
        $products = $provider->listProducts(1, 1, true);
        dd($products);
        // dd($provider);
        $response = $provider->addProduct('Demo Product', 'Demo Product', 'SERVICE', 'SOFTWARE');

            // ->addPlanTrialPricing('DAY', 7)
            // ->addDailyPlan('Demo Plan', 'Demo Plan', 1.50)
            // ->setupSubscription('John Doe', 'john@example.com', '2021-12-10') ;

            dd('sdfsdfasdasdfg ',$response);
    }

}
