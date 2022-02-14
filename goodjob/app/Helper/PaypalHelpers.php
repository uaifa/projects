<?php

namespace App\Helper;


use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalHelpers
{
	private $provider;
	public function __construct()
	{
		$this->provider = new PayPalClient;
		$this->provider->setApiCredentials(config('paypal'));
		$this->provider->setCurrency('EUR');
		$this->provider->getAccessToken();
		
	}

	public function products_list(){
		$products = $this->provider->listProducts();
		// $products = $this->provider->listProducts(1, 30, true);
		return $products;
	}
	public function create_product($data){

		$data =  json_decode('{
		"name": "Video Streaming Service",
		"description": "Video streaming service",
		"type": "SERVICE",
		"category": "SOFTWARE",
		"image_url": "https://example.com/streaming.jpg",
		"home_url": "https://example.com/home"
		}', true);

		$request_id = 'create-product-'.time();
		$product = $this->provider->createProduct($data, $request_id);
		return $product;

	}

	public function update_product($data, $product_id){
		$data = json_decode('[
			{
			"op": "replace",
			"path": "/description",
			"value": "Premium video streaming service"
			}
		]', true);
		$product = $this->provider->updateProduct($product_id, $data);

		return $product;
	}

	public function get_product_detail($product_id){
		$product = $this->provider->showProductDetails($product_id);
		return $product;
	}

	public function get_plans($fields){
		$plans = $this->provider->listPlans(1, 30, true, $fields);
		return $plans;
	}

	public function create_plan($data, $request_id){
		$data['currency'] = 'EUR';
		$response = $this->products_list();
		$product_id = $response['products'][0]['id'];
		
		$prepare_data = json_decode('{
			"product_id": "'.$product_id.'",
			"name": "'.$data['package_name'].'",
			"description": "'.$data['description'].'",
			"status": "ACTIVE",
			"billing_cycles": [
			  {
				"frequency": {
				  "interval_unit": "'.$data['interval_unit'].'",
				  "interval_count": "'.$data['interval_count'].'"
				},
				"tenure_type": "REGULAR",
				"sequence": 1,
				"total_cycles": 1,
				"pricing_scheme": {
				  "fixed_price": {
					"value": "'.$data['price'].'",
					"currency_code": "'.$data['currency'].'"
				  }
				}
			  }
			],
			"payment_preferences": {
			  "auto_bill_outstanding": true,
			  "setup_fee": {
				"value": "'.$data['price'].'",
				"currency_code": "'.$data['currency'].'"
			  },
			  "setup_fee_failure_action": "CONTINUE",
			  "payment_failure_threshold": 3
			},
			"taxes": {
			  "percentage": "0",
			  "inclusive": false
			}
		  }', true);
		// $prepare_data = $prepare_data;
		//   $request_id = 'create-plan-'.time();
		$plan = $this->provider->createPlan($prepare_data, $request_id);
		// $message = $plan['message'];
		
		return $plan['id'] ?? null;
	}

	public function update_plan($data, $plan_id){
		
		$prepare_data = json_decode('[
				{
				  "op": "replace",
				  "path": "/payment_preferences/payment_failure_threshold",
				  "value": '.$data['price'].',
				  "name": "'.$data['package_name'].'",
				  "description": "'.$data['description'].'"
				}
			  ]', true);

		$plan = $this->provider->updatePlan($plan_id, $prepare_data);
		return $plan;								  
	}
	public function get_plan_detail($plan_id){
		// $plan_id = 'P-7GL4271244454362WXNWU5NQ';
		$plan = $this->provider->showPlanDetails($plan_id);
		return $plan;
	}
	public function activate_plan($plan_id){
		// $plan_id = 'P-7GL4271244454362WXNWU5NQ';
		$plan = $this->provider->activatePlan($plan_id);
		return $plan;
	}
	public function deactivate_plan($plan_id){
		// $plan_id = 'P-7GL4271244454362WXNWU5NQ';
		$plan = $this->provider->deactivatePlan($plan_id);
		return $plan;
	}
	public function update_plan_pricing($data, $plan_id){
		$pricibg = json_decode('{
			"pricing_schemes": [
			  {
				"billing_cycle_sequence": 1,
				"pricing_scheme": {
				  "fixed_price": {
					"value": "'.$data['price'].'",
					"currency_code": "'.$data['currency'].'"
				  }
				}
			  }
			]
		}', true);
		// $plan_id = 'P-7GL4271244454362WXNWU5NQ';
		$plan = $this->provider->updatePlanPricing($plan_id, $pricibg);
		return $plan;
	}

	// Disputes
	public function disputes_product_list(){
		$products = $this->provider->listDisputes();
		return $products;
	} 
	public function update_dispute_product($data, $dispute_id){
		$data = json_decode('[
			{
			  "op": "add",
			  "path": "/partner_actions/-",
			  "value": {
				"id": "AMX-22345",
				"name": "ACCEPT_DISPUTE",
				"create_time": "2018-01-12T10:41:35.000Z",
				"status": "PENDING"
			  }
			}
		  ]', true);
		$dispute_id = 'PP-D-27803';
		$dispute = $this->provider->updateDispute($data, $dispute_id);
		return $dispute;
	}
	public function get_dispute_details($dispute_id){
		$dispute_id = 'PP-D-27803';
		$dispute = $this->provider->showDisputeDetails($dispute_id);
		return $dispute;
	}

	// Send Reminder for Invoice
	public function send_reminder_for_invoice($subject, $note, $invoice_no){
		// $subject = "Reminder: Payment due for the invoice #ABC-123";
		// $note = "Please pay before the due date to avoid incurring late payment charges which will be adjusted in the next bill generated.";
		// $invoice_no = 'INV2-Z56S-5LLA-Q52L-CPZ5';
		$emails = ['receipt1@example.com', 'receipt2@example.com'];
		$status = $this->provider->sendInvoiceReminder($invoice_no, $subject, $note, true, true, $emails);

		$status = $this->provider->sendInvoiceReminder($invoice_no, $subject, $note);
		return $status;						

	}
	// Subscriptions
	public function create_subscription($datas){

		$return_url = url('success-transaction');
		$cancel_url = url('cancel-transaction');

		$json_data = json_decode('{
						"plan_id": "P-4JD05025V88343317MHTKFKA",
						"PayPal-Request-Id": "123e4567-e89b-12d3-a456-426655440020",
					    	"start_time": "2022-01-19T00:00:00Z",
					    	"quantity": "20",
					    	"shipping_amount": {
					      	"currency_code": "USD",
					      	"value": "10.00"
					    },
					    "subscriber": {
					      "name": {
					        "given_name": "John",
					        "surname": "Doe"
					      },
					      "email_address": "customer@example.com",
					      "shipping_address": {
					        "name": {
					          "full_name": "John Doe"
					        },
					        "address": {
					          "address_line_1": "2211 N First Street",
					          "address_line_2": "Building 17",
					          "admin_area_2": "San Jose",
					          "admin_area_1": "CA",
					          "postal_code": "95131",
					          "country_code": "US"
					        }
					      }
					    },
					    "application_context": {
					      "brand_name": "Package Name 22",
					      "locale": "en-US",
					      "shipping_preference": "SET_PROVIDED_ADDRESS",
					      "user_action": "SUBSCRIBE_NOW",
					      "payment_method": {
					        "payer_selected": "PAYPAL",
					        "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
					      },
					      "return_url": "http://goodjob.test/success-transaction",
					      "cancel_url": "http://goodjob.test/cancel-transaction"
					    }
					}', true);
		// dd($json_data);

		// dd($return_url, $cancel_url, $json_data);
		$get_plan_detail = $this->get_plan_detail('P-4JD05025V88343317MHTKFKA');
		// dd($get_plan_detail);
		// $response = $this->provider->createSubscription([
  //               'plan_id' => 'P-4JD05025V88343317MHTKFKA',
  //               'subscriber' => [
  //                   'name' => [
  //                       'given_name' => 'Package Name 22',
  //                   ],
  //                   'email_address' => 'fab@gmail.com',
  //               ],
  //               'application_context' => [
  //                   'brand_name' => config('app.name'),
  //                   'shipping_preference' => 'NO_SHIPPING',
  //                   'user_action' => 'SUBSCRIBE_NOW',
  //                   'return_url' => route('successTransaction'),
  //                   'cancel_url' => route('cancelTransaction'),
  //               ],
  //       ]);
		// dd($json_data);
		// dd($get_plan_detail);
		$data = json_decode('{
			  "plan_id": "P-4JD05025V88343317MHTKFKA",
			  "start_time": "2022-01-18",
			  "quantity": "1",
			  "shipping_amount": {
			    "currency_code": "USD",
			    "value": "1.00"
			  },
			  "subscriber": {
			    "name": {
			      "given_name": "John",
			      "surname": "Doe"
			    },
			    "email_address": "customer@example.com"
			  },
			  "application_context": {
			    "brand_name": "walmart",
			    "locale": "en-US",
			    "shipping_preference": "NO_SHIPPING",
			    "user_action": "SUBSCRIBE_NOW",
			    "payment_method": {
			      "payer_selected": "PAYPAL",
			      "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
			    },
			    "return_url": "'.url('success-transaction').'",
			  	"cancel_url": "'.url('cancel-transaction').'"
			  }
			}', true);
			// dd(array($json_data));
			$subscription = $this->provider->createSubscription($json_data);
		  
		  // $subscription = $this->provider->createSubscription($prepare_data);
		  dd($subscription, $json_data);
		return $subscription;
	}
	public function update_subscription($data, $subscription_id){

		$data = json_decode('[
			{
			  "op": "replace",
			  "path": "/billing_info/outstanding_balance",
			  "value": {
				"currency_code": "USD",
				"value": "50.00"
			  }
			}
		  ]', true);  
		$response = $this->provider->updateSubscription($subscription_id, $data);
		return $response;
	}
	public function show_subscription_details($subscription_id){
		$subscription = $this->provider->showSubscriptionDetails($subscription_id);
		return $subscription;
	}
	public function activate_subscription($subscription_id, $note = 'Reactivating the subscription'){
		$response = $this->provider->activateSubscription($subscription_id, $note);
		return $response;
	}
	public function cancel_subscription($subscription_id, $note = 'Not satisfied with the service'){
		$response = $this->provider->cancelSubscription($subscription_id, $note);
		return $response;
	}
	public function suspend_subscription($subscription_id, $note = 'Item out of stock'){

		$response = $this->provider->suspendSubscription($subscription_id, $note);
		return $response;
	}
	public function capture_authorized_payment_on_subscription($subscription_id, $note = 'Charging as the balance reached the limit', $amount){
		
		$response = $this->provider->captureSubscriptionPayment($subscription_id, '', $amount);

		return $response;
	}
	public function revise_plan_or_quantity_of_subscription($subscription_id, $data){
		$data = \GuzzleHttp\json_decode('{
			"plan_id": "P-5ML4271244454362WXNWU5NQ",
			"shipping_amount": {
			  "currency_code": "USD",
			  "value": "10.00"
			},
			"shipping_address": {
			  "name": {
				"full_name": "John Doe"
			  },
			  "address": {
				"address_line_1": "2211 N First Street",
				"address_line_2": "Building 17",
				"admin_area_2": "San Jose",
				"admin_area_1": "CA",
				"postal_code": "95131",
				"country_code": "US"
			  }
			},
			"application_context": {
			  "brand_name": "walmart",
			  "locale": "en-US",
			  "shipping_preference": "NO_SHIPPING",
			  "payment_method": {
				"payer_selected": "PAYPAL",
				"payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
			  },
			  "return_url": "https://example.com/returnUrl",
			  "cancel_url": "https://example.com/cancelUrl"
			}
		  }', true);
		  
		  $response = $this->provider->reviseSubscription($subscription_id, $data);
	}
	public function capture_authorized_payment_on_subscription_with_date($subscription_id, $start_date = '', $end_date = ''){
		$response = $this->provider->listSubscriptionTransactions($subscription_id, $start_date, $end_date);

		return $response;
	}

}