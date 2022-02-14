@extends('admin.layouts.main')
@section('title', '- Settings')

@section('bed-title', 'Settings')
@section('content')
    <!-- content @s -->
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
                                                <h4 class="nk-block-title"> Change Password</h4>

                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card">
                                            <div class="card-inner-group">
                                                <div class="data-head">
                                                    <h6 class="overline-title">Password</h6>
                                                </div>
                                                <div class="card-inner">

                                                    {{-- <div class="between-center flex-wrap flex-md-nowrap g-3"> --}}
                                                    {{-- <div class="nk-block-text"> --}}
                                                    <div class="text-center text-danger mb-3">
                                                        <b id="error"></b>
                                                    </div>
                                                    <form action="" id="resetPassword">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">Old Password</label>
                                                            <input type="password" name="old_password" id=""
                                                                class="form-control" placeholder="Old Password"
                                                                aria-describedby="helpId">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">New Password</label>
                                                            <input type="password" name="new_password" id=""
                                                                class="form-control" placeholder="New Password"
                                                                aria-describedby="helpId">
                                                            <small id="helpId" class="text-muted">Should be 8
                                                                character
                                                                with 1 capital, 1 number and 1 special character</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Confirm Password</label>
                                                            <input type="password" name="confirm_password" id=""
                                                                class="form-control" placeholder="Confirm PAssword"
                                                                aria-describedby="helpId">
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-primary" type="submit">Reset Now</button>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div><!-- .card-inner -->
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group">
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
                                            </div>
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
                                                <li><a href="{{ route('setting') }}"><em
                                                            class="icon ni ni-user-fill-c"></em><span>Personal
                                                            Infomation</span></a></li>
                                                {{-- <li><a href="html/user-profile-notification.html"><em
                                                    class="icon ni ni-bell-fill"></em><span>Notifications</span></a>
                                        </li>
                                        <li><a href="html/user-profile-activity.html"><em
                                                    class="icon ni ni-activity-round-fill"></em><span>Account
                                                    Activity</span></a></li> --}}
                                                <li><a class="active" href="{{ route('security') }}"><em
                                                            class="icon ni ni-lock-alt-fill"></em><span>Security
                                                            Settings</span></a></li>
                                            </ul>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#resetPassword').submit(function(e) {
            e.preventDefault();
            $('#error').html('');
            $.ajax({
                type: "post",
                url: "{{ route('admin.password') }}",
                data: $('#resetPassword').serialize(),
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
