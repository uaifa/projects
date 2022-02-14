
		<a href="{{ route('paypal',$package_id) }}" onclick="event.preventDefault();document.getElementById('submit-payment-form').submit();">
			<img src="{{ asset('assets/images/paypal-featured-image.png') }}">
            <form id="submit-payment-form" action="{{ route('paypal',$package_id) }}" method="POST"
                style="display: none;">
                @csrf
            </form>
        </a>
