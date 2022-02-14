    
        <div id="page-content-wrapper" class="packages">
            <div class="logo-pack">
                <img src="{{ asset('assets/images/Logo.png') }}">
            </div>
            <!-- Page content-->
            <div class="container">
                <div class="text-center">
                    <h2>Herzlichen Glückwunsch -<br>Du bist ein Durchstarter!</h2>
                    <p>Preise in CHF exkl. MWST</p>
                </div>
                <div class="prices mt-5 mb-5">
                    <div class="row mb-4">
                        @if(isset($packages) && count($packages) > 0)
                            @foreach($packages as $key => $value)
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="inner">
                                        <div class="icon">
                                            <img src="{{ asset($value->icon) }}">
                                        </div>
                                        <h3>{{ $value->package_name ?? 'FREEBIE' }}</h3>
                                        <div class="price">{{ $value->price ?? '0.-' }}</div>
                                        <div class="content fadeIn_bottom">
                                            <ul>
                                                <li><img src="{{ asset('assets/images/check-yellow.png') }}"> {{ $value->manager ?? '1'}} manager + {{ $value->users ?? '1'}} user</li>
                                                <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Support within {{ $value->duration ?? '8' }} hours</li>
                                                <li><img src="{{ asset('assets/images/check-yellow.png') }}"> {{ $value->storage_text ?? 'Unlimited storage' }} </li>
                                            </ul>
                                            <a href="{{ route('admin.payments.index',encryptstring($value->id)) }}" class="btn btn-yellow">THIS IS IT</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="col-lg-3 col-md-6">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/price-icon1.svg') }}">
                                </div>
                                <h3>FREEBIE</h3>
                                <div class="price">0.-</div>
                                <div class="content fadeIn_bottom">
                                    <ul>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> 1 manager + 1 user</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Support within 8 hours</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Unlimited storage</li>
                                    </ul>
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn-yellow">THIS IS IT</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/price-icon2.svg') }}">
                                </div>
                                <h3>FREEBIE</h3>
                                <div class="price">49.90</div>
                                <div class="content fadeIn_bottom">
                                    <ul>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> 1 manager + 5 user</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Support within 8 hours</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Unlimited storage</li>
                                    </ul>
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn-yellow">THIS IS IT</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/price-icon3.svg') }}">
                                </div>
                                <h3>FREEBIE</h3>
                                <div class="price">79.90</div>
                                <div class="content fadeIn_bottom">
                                    <ul>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> 1 manager + 10 user</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Support within 8 hours</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Unlimited storage</li>
                                    </ul>
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn-yellow">THIS IS IT</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/price-icon4.svg') }}">
                                </div>
                                <h3>FREEBIE</h3>
                                <div class="price">129.90</div>
                                <div class="content fadeIn_bottom">
                                    <ul>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> 1 manager + 20 user</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Support within 8 hours</li>
                                        <li><img src="{{ asset('assets/images/check-yellow.png') }}"> Unlimited storage</li>
                                    </ul>
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn-yellow">THIS IS IT</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="row pack-banner m-0">
                    <div class="col-md-6">
                        <div class="img">
                            <img src="{{ asset('assets/images/image1.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="txt">
                            <h4>Learn more about <br>our galactic work helper!</h4>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                nonumy eirmod tempor invidunt ut labore et dolore </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer s2 pt-5 pb-3">
                <div class="container-fluid">
                    <div class="row">
                        @if(auth()->user()->payment_stripe_status == 'succeeded' || auth()->user()->payment_paypal_status == 'approved')
                        <div class="col-md-3"></div>
                        @endif
                        <div class="col-md-6">© 2021 Mycomp IT-Services GmbH - www.mycomp.ch. All rights reserved.</div>
                        <div class="col-md-3"> <span class="footer-menu"> <a href="#">Privacy Policy</a> <a href="#">Terms of Service</a> </span></div>
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

