
<style type="text/css">
	.button_loader {
	  background-color: transparent;
	  border: 4px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 4px solid #969696;
	  border-bottom: 4px solid #969696;
	  width: 35px;
	  height: 35px;
	  -webkit-animation: spin 0.8s linear infinite;
	  animation: spin 0.8s linear infinite;
	}

	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  99% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  99% { transform: rotate(360deg); }
	}
</style>


@php 
	$productName = 'New product';
	$productPrice = 1;
	$currency = '$';
@endphp
<!-- Display errors returned by checkout session -->
	<div id="paymentResponse" class="hidden"></div>

	<!-- Payment button -->
	<button class="stripe-button" id="payButton">
	    <div class="spinner hidden" id="spinner"></div>
	    <span id="buttonText">
	    	<img src="{{ asset('assets/images/stripe-logo-blue.png') }}">
	    </span>
	</button>

	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>

<script>
	// Set Stripe publishable key to initialize Stripe.js
	const stripe = Stripe('pk_test_51GtefbDu1Kgsa5mNqTOayOFKqKApY6GT0IBXtrdXcAIKSiGu6D4na0xp9TpQ7PAPYrtbd6ElD3FPVoV4niCxCt7900I7aWU3Dj');

	// Select payment button
	const payBtn = document.querySelector("#payButton");

	// Payment request handler
	payBtn.addEventListener("click", function (evt) {
	    setLoading(true);

	    createCheckoutSession().then(function (data) {
	        if(data.sessionId){
	            stripe.redirectToCheckout({
	                sessionId: data.sessionId,
	            }).then(handleResult);
	        }else{
	            handleResult(data);
	        }
	    });
	});
	    
	// Create a Checkout Session with the selected product
	const createCheckoutSession = function (stripe) {
	    return fetch("{{ route('stripe.checkout.payment', $package_id) }}", {
	        method: "POST",
	        headers: {
	            "Content-Type": "application/json",
	            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
	        },
	        body: JSON.stringify({
	            createCheckoutSession: 1,
	        }),
	    }).then(function (result) {
	        return result.json();
	    });
	};

	// Handle any errors returned from Checkout
	const handleResult = function (result) {
	    if (result.error) {
	        showMessage(result.error.message);
	    }
	    
	    setLoading(false);
	};

	// Show a spinner on payment processing
	function setLoading(isLoading) {
	    if (isLoading) {
	        // Disable the button and show a spinner
	        payBtn.disabled = true;
	        document.querySelector("#spinner").classList.remove("hidden");
	        $('#spinner').addClass('button_loader').attr("value","");
	        document.querySelector("#buttonText").classList.add("hidden");
	    } else {
	        // Enable the button and hide spinner
	        payBtn.disabled = false;
	        document.querySelector("#spinner").classList.add("hidden");
	        document.querySelector("#buttonText").classList.remove("hidden");
	        $('#spinner').removeClass('button_loader');
	    }
	}

	// Display message
	function showMessage(messageText) {
	    const messageContainer = document.querySelector("#paymentResponse");
		
	    messageContainer.classList.remove("hidden");
	    messageContainer.textContent = messageText;
		
	    setTimeout(function () {
	        messageContainer.classList.add("hidden");
	        messageText.textContent = "";
	    }, 5000);
	}
</script>

