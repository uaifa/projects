<!-- Page content-->
            <div class="container">
                <h3> {{ $page_name ?? '' }} </h3>
                @if(!isset(request()->id) && isset($joblists) && !empty($joblists))
              <form class="row g-3" method="post" action="{{ route('joblists.update', base64_encode($joblists->id)) }}" enctype="multipart/form-data">
              @method('put')
            @else
          <form class="row g-3" method="post" action="{{ route('joblists.store') }}" enctype="multipart/form-data">
            @endif
            @csrf

                <div class="row mb-5">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-5">
                                    <input type="text" name="name" required="" class="form-control" id="name" placeholder="@lang('messages.name_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->name ?? '' }}" @endif>
                                      @if($errors->first('name'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                      @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">@lang('messages.description')</label>
                                      <textarea name="description" required="" class="form-control" id="description" placeholder="@lang('messages.description_placeholder')" style="min-height: 120px">@if(isset($joblists) && !empty($joblists)) {{ $joblists->description ?? '' }} @endif</textarea>
                                      @if($errors->first('description'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                      @endif

                                    {{-- <textarea class="form-control" rows="5" style="max-height: 120px"></textarea> --}}
                                </div>
                                <div class="form-group mb-3">
                                    <label for="client_id" class="form-label">@lang('messages.client_id')</label>
                                      <select name="client_id" id="client_id" class="form-control" required="">
                                        <option value="">@lang('messages.client')</option>
                                        @if(isset($clients) && !empty($clients))
                                        @foreach($clients as $key => $client)
                                          <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }} </option>
                                        @endforeach
                                        @endif
                                      </select>
                                      @if($errors->first('client_id'))
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('client_id') }}</strong>
                                        </span>
                                      @endif

                                    {{-- <label class="form-label">Customer</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Employee</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Employer</option>
                                        <option value="3">Super Admin</option>
                                    </select> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-5">
                                    <div class="form-group mb-3">
                                        {{-- <label for="" class="form-label">@lang('messages.role')</label> --}}
                                        <select name="role_id" id="role_id" class="form-select" aria-label="Default select example">
                                          <option value="">@lang('messages.select')</option>
                                          @if(!empty($roles))
                                          @foreach($roles as $key => $value)                                          
                                            <option value="{{ $value->id }}"> {{ $value->name }} </option>
                                          @endforeach
                                          @endif
                                        </select>
                                        @if($errors->first('roles'))
                                          <span class="invalid-feedbacks" role="alert">
                                            <strong>{{ $errors->first('roles') }}
                                        @endif 
                                    </div>

                                    {{-- <select class="form-select" aria-label="Default select example">
                                        <option selected>Employee</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Employer</option>
                                        <option value="3">Super Admin</option>
                                    </select> --}}
                                </div>

                                <div class="form-group mb-3">
                                <label for="date" class="form-label">@lang('messages.date')</label>
                                  <input type="date"  name="date" required="" class="form-control" id="date" placeholder="@lang('messages.date_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->date ?? '' }}" @endif>
                                  @if($errors->first('date'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                  @endif

                                    <!-- <label class="form-label">Date</label> -->
                                    <!-- <input type="date" class="form-control"> -->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                        <label for="from_time_hours" class="form-label">@lang('messages.from_time_hours')</label>
                                        <input type="text" name="from_time_hours" required="" class="form-control" id="starttime" placeholder="@lang('messages.from_time_hours_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->from_time_hours ?? '' }}" @endif>
                                        @if($errors->first('from_time_hours'))
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from_time_hours') }}</strong>
                                          </span>
                                        @endif
                                            <!-- <label class="form-label">From</label>
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control"> <span class="px-2"> : </span>
                                                <input type="text" class="form-control"> <span class="px-2"> am </span>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                          <label for="to_time_minutes" class="form-label">@lang('messages.to_time_minutes')</label>
                                          <input type="text" name="to_time_minutes" required="" class="form-control" id="endtime" placeholder="@lang('messages.to_time_minutes_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->to_time_minutes ?? '' }}" @endif>
                                          @if($errors->first('to_time_minutes'))
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('to_time_minutes') }}</strong>
                                            </span>
                                          @endif
                                            <!-- <label class="form-label">To</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control"> <span class="px-2"> : </span>
                                                <input type="text" class="form-control"> <span class="px-2"> am </span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="place_of_work" class="form-label">@lang('messages.place_of_work')</label>
                                    <input type="text" name="place_of_work" required="" class="form-control" id="place_of_work" placeholder="@lang('messages.place_of_work_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->place_of_work ?? '' }}" @endif>
                                    @if($errors->first('place_of_work'))
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('place_of_work') }}</strong>
                                      </span>
                                    @endif
                                    <!-- <label class="form-label">Place of work</label> -->
                                    <!-- <input type="text" class="form-control"> -->
                                </div>
                            </div>
                        </div>

                        <hr class="sep">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                  <label for="contact_person" class="form-label">@lang('messages.contact_person')</label>
                                  <input type="text" name="contact_person" required="" class="form-control" id="contact_person" placeholder="@lang('messages.contact_person_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->contact_person ?? '' }}" @endif>
                                  @if($errors->first('contact_person'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('contact_person') }}</strong>
                                    </span>
                                  @endif
                                    <!-- <label for="" class="form-label">Contact person</label> -->
                                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                  <label for="phone" class="form-label">@lang('messages.phone')</label>
                                  <input type="number" min="0" name="phone" required="" class="form-control" id="phone" placeholder="@lang('messages.phone_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->phone ?? '' }}" @endif>
                                  @if($errors->first('phone'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                  @endif
                                    <!-- <label for="" class="form-label">Phone</label> -->
                                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- <div class="col-md-12"> --}}
                                <div class="col-md-6">
                                <div class="form-group mb-3">
                                  <label for="email" class="form-label">@lang('messages.email')</label>
                                  <input type="email" name="email" required="" class="form-control" id="email" placeholder="@lang('messages.email_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->email ?? '' }}" @endif>
                                  @if($errors->first('email'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                  @endif
                                    <!-- <label for="" class="form-label">Email</label> -->
                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->
                                </div>
                            </div>
                                <div class="col-md-6">
                                  <label for="signature" class="form-label">@lang('messages.signature')</label>
                                  <input type="text" name="signature" required="" class="form-control" id="signature" placeholder="@lang('messages.signature_placeholder')" @if(isset($joblists) && !empty($joblists)) value="{{ $joblists->signature ?? '' }}" @endif>
                                  @if($errors->first('signature'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('signature') }}</strong>
                                    </span>
                                  @endif
                                </div>
                            {{-- </div> --}}
                        </div>

                        <hr class="sep">

                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </div>

                    </div>
                    <div class="offset-md-1 col-md-4">
                        <div class="activities">
                            <div class="activity">
                                <div class="thumb">
                                    <img src="images/user-profile.png">
                                </div>
                                <div>
                                    12.07.20, 12:13 Uhr<br>
                                    <b>You created a new Job.</b>
                                </div>
                            </div>
                            <div class="activity">
                                <div class="thumb">
                                    <img src="images/user-profile.png">
                                </div>
                                <div>
                                    12.07.20, 12:13 Uhr<br>
                                    <b>You created a new Job.</b>
                                </div>
                            </div>
                            <div class="activity">
                                <div class="thumb">
                                    <img src="images/user-profile.png">
                                </div>
                                <div>
                                    12.07.20, 12:13 Uhr<br>
                                    <b>You created a new Job.</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            </div>
            



@push('js')
<script type="text/javascript">
  @if(isset($joblists) && !empty($joblists))
      $('#status').val('{{ $joblists->status }}');

      $('#client_id').val('{{ $joblists->client_id }}');
      $('#role_id').val('{{ $joblists->role_id }}');
  @else
    $('#status').val("{{ old('status') }}");
  @endif
  </script>
@endpush