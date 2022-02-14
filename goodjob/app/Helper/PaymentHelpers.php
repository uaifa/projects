<?php

use App\Models\Plan;
use Stripe\Stripe;
use Stripe\StripeClient;

if(!function_exists('create_package')){
	function create_package($data, $stripe_key){
    // dd($data);
		$stripe = new StripeClient($stripe_key);
        $data['slug'] = strtolower($data['package_name']);
        $price = $data['price'] *100; 
        $image[] = $data['image'];
        //create stripe product
        $stripeProduct = $stripe->products->create([
            'name' => $data['package_name'],
            'images' => $image,
            'description' => $data['description'],
        ]);
        //Stripe Plan Creation
        $stripePlanCreation = $stripe->plans->create([
            'amount' => $price,
            'currency' => $data['currency'],
            'interval' => strtolower($data['interval_unit']), //  it can be day,week,month or year
            'product' => $stripeProduct->id,
        ]);
        $plan_data['slug'] = strtolower($data['package_name']);
        $plan_data['stripe_plan'] = $stripePlanCreation->id;
        $plan_data['name'] = $data['package_name'];
        $plan_data['image'] = $data['image'];
        $plan_data['description'] = $data['description'];
        $plan_data['cost'] = $price;
        // dd($plan_data);
        Plan::create($plan_data);
        return $stripePlanCreation->id;

	}
}

if(!function_exists('update_package')){
    function update_package($data, $stripe_plan, $stripe_key){
    
        $stripe = new StripeClient($stripe_key);
        $data['slug'] = strtolower($data['package_name']);
        $price = $data['price'] *100; 
        $image[] = $data['image'];
        //create stripe product
        // $stripeProduct = $stripe->products->update(
        //     $stripe_plan,
        //     [
        //     'name' => $data['package_name'],
        //     'images' => $image,
        //     'description' => $data['description'],
        // ]);
        // dd($stripe_plan);
        //Stripe Plan Creation
        $stripePlanCreation = $stripe->plans->update($stripe_plan,[
            'amount' => (int)$price,
            'currency' => $data['currency'],
            'interval' => strtolower($data['interval_unit']), //  it can be day,week,month or year
            'product' => $stripe_plan,
            ['metadata' => ['order_id' => '6735']]

        ]);

        // use ApiOperations\All;
        // use ApiOperations\Create;
        // use ApiOperations\Delete;
        // use ApiOperations\Retrieve;
        // use ApiOperations\Update;

        // $data['stripe_plan'] = $stripePlanCreation->id;
        // $data['name'] = $data['package_name'];
        // $data['cost'] = $price;
        // Plan::create($data);
        return $stripePlanCreation->id;

    }
}

if(!function_exists('stripe_checkout')){
	function stripe_checkout($price_id){

		Stripe::setApiKey(env('STRIPE_SECRET'));

		// header('Content-Type: application/json');

        try {
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
              'price' => 1.00, // decryptstring($price_id),
              'quantity' => 1,
              "product_data" => [
                "name" => 'Product name ...',
                "images" => [
                  'https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mnx8fGVufDB8fHx8&w=1000&q=80',
                ],
              ]
            ]],
            'mode' => 'payment', // 'subscription',
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
}



