<!-- Top navigation-->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <div class="topbar" id="navbarSupportedContent">
            <ul class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item">
                    <div class="topsearch">
                        <input type="search" placeholder="Search">
                        <input type="image" src="{{ asset('assets/images/icon-search.png') }}" alt="Submit">
                    </div>
                </li>
                <li class="nav-item dropdown usermenu">
                                <a class="nav-link dropdown-toggleX" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('assets/images/user-profile.png') }}">
                                </a>
                                <ul class="dropdown-menu p-4" aria-labelledby="navbarDropdown">
                                    <div class="user-dtl">
                                        <b>Serkan Bulut</b><br>
                                        Super-Admin
                                    </div>
                                    <div class="mb-4 mt-4">
                                        <a href="#" class="float-end"><img src="{{ asset('assets/images/icon-cross.png') }}"></a>
                                    </div>
                                    <li>
                                        <b>Profile</b>
                                        <a class="dropdown-item" href="#">User</a>
                                        <a class="dropdown-item" href="#">Password</a>
                                    </li>
                                    <div class="mb-4"></div>
                                    <li>
                                        <b>Team</b>
                                        <a class="dropdown-item" href="#">Assigned teams</a>
                                    </li>
                                    <div class="mb-4"></div>
                                    <li class="mb-4">
                                        <b>Assigned</b>
                                        <a class="dropdown-item" href="#">Assigned teams</a>
                                        <a class="dropdown-item" href="#">Assigned customer</a>
                                        <a class="dropdown-item" href="#">Assigned places</a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <b>Account</b>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{-- <i class="fa fa-sign-out-alt" style="margin-right: 13px;"></i> --}}
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                            Sign out
                                        </a>
                                    </li>
                                </ul>
                            </li>

                {{-- <li class="nav-item usernav">
                    <img src="{{ asset('assets/images/user-profile.png') }}">
                </li> --}}
            </ul>
        </div>
    </div>
</nav>