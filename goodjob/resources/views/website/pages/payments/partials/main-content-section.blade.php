<style type="text/css">
    .payments-main-div{
        margin: 0 auto;
    }
</style>
<div id="page-content-wrapper" class="payments d-flex">
    <div class="text-center mt-5 pt-5 mb-5 payments-main-div">
        <img src="{{ asset('assets/images/logo-black.png') }}">
    </div>
     
    <!-- Page content-->
    <div class="container">
        <div class="p-text">
            <h2>Zahlen und<br>
                sofort anfangen!</h2>
            <hr>
            <p>Wie zahlst du?</p>
        </div>

       <div class="pay-methods text-center">
        @include('website.pages.payments.partials.paypal-checkout-script')
        @include('website.pages.payments.partials.stripe-checkout-script')
            <!-- <img src="{{ asset('assets/images/payment-method1.png') }}">
            <img src="{{ asset('assets/images/payment-method2.png') }}">
            <img src="{{ asset('assets/images/payment-method3.png') }}">
            <img src="{{ asset('assets/images/payment-method4.png') }}"> -->
        </div>
    </div>

    <div class="footer s2 pt-5 pb-3">
        <div class="container-fluid">
            <div class="row">
                @if(auth()->user()->payment_stripe_status == 'succeeded' || auth()->user()->payment_paypal_status == 'approved')
                    <div class="col-md-3"></div>
                @endif
                <div class="col-md-6">© 2021 Mycomp IT-Services GmbH - www.mycomp.ch. All rights reserved.</div>
                <div class="col-md-3"> 
                    <span class="footer-menu"> 
                        <a href="#">
                            Privacy Policy
                        </a> 
                        <a href="#">
                            Terms of Service
                        </a> 
                    </span>
                </div>
                @if(!auth()->user()->payment_stripe_status == 'succeeded' || !auth()->user()->payment_paypal_status == 'approved')
                <div class="col-md-3">
                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt" style="margin-right: 13px;"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        logout
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

