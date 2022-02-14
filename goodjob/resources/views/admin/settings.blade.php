@extends('admin.layouts.main')
@section('title', '- Settings')

@section('bed-title', 'Settings')
@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Personal Information</h4>

                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Basics</h6>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Full Name</span>
                                                    <span
                                                        class="data-value">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Display Name</span>
                                                    <span
                                                        class="data-value">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    <span class="data-value">{{ Auth::user()->email }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more disable"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Phone Number</span>
                                                    <span
                                                        class="data-value text-soft">{{ Auth::user()->phone ? Auth::user()->phone : '-' }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Date of Birth</span>
                                                    <span
                                                        class="data-value">{{ Auth::user()->dob ? date('j F, Y', strtotime(Auth::user()->dob)) : '-' }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->

                                        </div><!-- data-list -->

                                    </div><!-- .nk-block -->
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <span>{{ substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span
                                                        class="lead-text">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                                                    <span class="sub-text">{{ Auth::user()->email }}</span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="dropdown">
                                                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown"
                                                            href="#"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li onclick="changeImage()"><a href="javascript:void(0)"><em
                                                                            class="icon ni ni-camera-fill"></em><span>Change
                                                                            Photo</span></a></li>
                                                                <form action="" id="adminSideImage">
                                                                    @csrf
                                                                    <input type="file" name="image" id="image"
                                                                        style="display: none" accept="image/png, image/jpeg"
                                                                        onchange="uploadImage()">
                                                                </form>

                                                                {{-- <li><a href="#"><em
                                                                            class="icon ni ni-edit-fill"></em><span>Update
                                                                            Profile</span></a></li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        {{-- <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <h6 class="overline-title-alt">Account Balance</h6>
                                                <div class="user-balance">12.395769 <small
                                                        class="currency currency-btc">USD</small></div>
                                                <div class="user-balance-sub">Pending <span>0.344939 <span
                                                            class="currency currency-btc">USD</span></span></div>
                                            </div>
                                        </div><!-- .card-inner --> --}}
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li><a class="active" href="{{ route('setting') }}"><em
                                                            class="icon ni ni-user-fill-c"></em><span>Personal
                                                            Infomation</span></a></li>
                                                {{-- <li><a href="html/user-profile-notification.html"><em
                                                            class="icon ni ni-bell-fill"></em><span>Notifications</span></a>
                                                </li>
                                                <li><a href="html/user-profile-activity.html"><em
                                                            class="icon ni ni-activity-round-fill"></em><span>Account
                                                            Activity</span></a></li> --}}
                                                <li><a href="{{ route('security') }}"><em
                                                            class="icon ni ni-lock-alt-fill"></em><span>Security
                                                            Settings</span></a></li>
                                            </ul>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>



    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Update Profile</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#address">Address</a>
                        </li> --}}
                    </ul><!-- .nav-tabs -->
                    <form action="" id="personalnfo">
                        <div class="text-center text-danger">
                            <b id="error"></b>
                        </div>
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="personal">
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">First Name</label>
                                            <input type="text" class="form-control form-control-lg" id="full-name"
                                                value="{{ Auth::user()->first_name }}" placeholder="Enter First name"
                                                name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Last Name</label>
                                            <input type="text" class="form-control form-control-lg" id="display-name"
                                                value="{{ Auth::user()->last_name }}" placeholder="Enter LAst name"
                                                name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Phone Number</label>
                                            <input type="text" class="form-control form-control-lg" id="phone-no"
                                                value="{{ Auth::user()->phone }}" placeholder="Phone Number"
                                                name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="birth-day">Date of Birth</label>
                                            <input type="text" class="form-control form-control-lg date-picker"
                                                id="birth-day"
                                                placeholder="{{ date('j F, Y', strtotime(Auth::user()->dob)) }}"
                                                name="dob">
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="latest-sale">
                                        <label class="custom-control-label" for="latest-sale">Use full name to display
                                        </label>
                                    </div>
                                </div> --}}
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button type="submit" class="btn btn-lg btn-primary">Update
                                                    Profile</button>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .tab-pane -->
                            {{-- <div class="tab-pane" id="address">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Address Line 1</label>
                                        <input type="text" class="form-control form-control-lg" id="address-l1"
                                            value="2337 Kildeer Drive">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l2">Address Line 2</label>
                                        <input type="text" class="form-control form-control-lg" id="address-l2" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-st">State</label>
                                        <input type="text" class="form-control form-control-lg" id="address-st"
                                            value="Kentucky">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-county">Country</label>
                                        <select class="form-select" id="address-county" data-ui="lg">
                                            <option>Canada</option>
                                            <option>United State</option>
                                            <option>United Kindom</option>
                                            <option>Australia</option>
                                            <option>India</option>
                                            <option>Bangladesh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" class="btn btn-lg btn-primary">Update Address</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .tab-pane --> --}}
                        </div><!-- .tab-content -->
                    </form>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
@endsection

@section('js')
    <script>
        $('#personalnfo').submit(function(e) {
            e.preventDefault();
            $('#error').html('');
            $.ajax({
                type: "post",
                url: "{{ route('profile.setting') }}",
                data: $('#personalnfo').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status == 201) {
                        $('#error').html(response.message);
                    } else if (response.status == 200) {
                        NioApp.Toast(response.message, 'success', {
                            position: 'top-right'
                        });
                        setInterval(() => {
                            location.reload();
                        }, 1300);
                    } else {
                        NioApp.Toast(response.message, 'error', {
                            position: 'top-right'
                        });
                    }
                }
            });
        });
    </script>

@endsection
