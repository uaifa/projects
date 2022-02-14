<!-- Page content-->
            <div class="container">
                <h3>Team-Scheduler
                    <div class="form-group">
                        <input type="date" class="form-control" id="selectdate" value="2020-12-31">
                    </div>
                </h3>
                <div class="addnew d-inline-block w-100">

                    <div class="filter-tags float-start">
                        <span class="icn-fill">Supports <a href=""><img src="{{ asset('assets') }}/images/icon-cross.png"></a></span>
                        <span class="icn-fill">Zurich <a href=""><img src="{{ asset('assets') }}/images/icon-cross.png"></a></span>
                        <span class="icn-fill">Coop Food <a href=""><img src="{{ asset('assets') }}/images/icon-cross.png"></a></span>
                        <span class="icn-no-fill">Name <a href=""><img src="{{ asset('assets') }}/images/icon-arrow-down.png"></a></span>
                    </div>



                    <div class="dropdown float-end">
                        <a class="dropdown-dots" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets') }}/images/3dots.png">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#">Delete</a></li>
                            <li><a class="dropdown-item" href="#">Duplicate</a></li>
                            <li><a class="dropdown-item" href="#">Import List</a></li>
                            <li><a class="dropdown-item" href="#">Export List</a></li>
                        </ul>
                    </div>
                    <a class="float-end ms-auto" href="{{ route('schedulers.create') }}"> <img src="{{ asset('assets') }}/images/icon-add.png"> </a>
                    <div class="cal-view float-end">
                        <div class="row">
                            <div class="col-auto">
                                <span class="icon"></span>
                                Show me a
                            </div>
                            <div class="col-auto">
                                <span class="icon active"><img src="{{ asset('assets') }}/images/icon-calendar-day.png"></span>
                                day
                            </div>
                            <div class="col-auto">
                                <span class="icon"><img src="{{ asset('assets') }}/images/icon-calendar-week.png"></span>
                                week
                            </div>
                            <div class="col-auto">
                                <span class="icon"><img src="{{ asset('assets') }}/images/icon-calendar-alt.png"></span>
                                day
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="white-box px-0">
                            <div class="table-responsive">
                                <table class="emp-table sched-table">
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        @php 
                                            $max_days=date('t');
                                        @endphp
                                        @for($i = 1; $i <= $max_days; $i++)
                                        <th> {{ $i }} </th>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><img src="{{ asset('assets') }}/images/pic.png"></td>
                                        <td>Huber</td>
                                        <td>Massi</td>
                                        <td>
                                            <span class="red" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover" data-bs-custom-class="sched-pop" data-bs-placement="bottom"></span>

                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="black"></span>
                                        </td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td><span class="orange"></span></td>
                                        <td><span class="yellow"></span></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><img src="{{ asset('assets') }}/images/pic.png"></td>
                                        <td>Huber</td>
                                        <td>Massi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td><span class="orange"></span></td>
                                        <td><span class="yellow"></span></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><img src="{{ asset('assets') }}/images/pic.png"></td>
                                        <td>Huber</td>
                                        <td>Massi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td><span class="orange"></span></td>
                                        <td><span class="yellow"></span></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><img src="{{ asset('assets') }}/images/pic.png"></td>
                                        <td>Huber</td>
                                        <td>Massi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td><span class="orange"></span></td>
                                        <td><span class="yellow"></span></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><img src="{{ asset('assets') }}/images/pic.png"></td>
                                        <td>Huber</td>
                                        <td>Massi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td><span class="orange"></span></td>
                                        <td><span class="yellow"></span></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><img src="{{ asset('assets') }}/images/pic.png"></td>
                                        <td>Huber</td>
                                        <td>Massi</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td><span class="orange"></span></td>
                                        <td><span class="yellow"></span></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td><span class="black"></span></td>
                                        <td><span class="green"></span></td>
                                        <td><span class="red"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Google map-->
                <div id="map-container-google-1" class="z-depth-1-half map-container mb-4" style="height: 300px;width: 100%;">
                    <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

                <!--Google Maps-->
            </div>