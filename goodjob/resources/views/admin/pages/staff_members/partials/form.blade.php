

<!-- Page content-->
            <div class="container">
                <h3> @lang('messages.add') @lang('messages.staff_members') </h3>

                <div class="row mb-5">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="profile-pic">
                                  @php

                                      $profile_image = (isset($staff_members) && !empty($staff_members->profile_image)) ? asset('/'.$staff_members->profile_image) : asset('assets').'/images/user.png';
                                  
                                  @endphp
                                    <img src="{{ $profile_image }}" id="previewImg">
                                    <a href="javascript:void(0)" class="add-pic">
                                        <img src="{{ asset('assets') }}/images/add-photo.png" onclick="changeImage()" >
                                    </a>
                                      <input type="file" id="uploadImage" style="display: none" accept="image/*"
                                          onchange="previewFile(this);">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(!isset(request()->id) && isset($staff_members) && !empty($staff_members))
                                    <form class="row g-3" method="post" action="{{ route('staff-members.update', base64_encode($staff_members->id)) }}" enctype="multipart/form-data">
                                    @method('put')

                                    <input type="hidden" name="staff_member_id" value="{{ $staff_members->id }}">
                                  @else
                                <form class="row g-3" method="post" action="{{ route('staff-members.store') }}" enctype="multipart/form-data">
                                  @endif
                                  @csrf

                                  @if(isset(request()->id) && isset($staff_members) && !empty($staff_members->profile_image))
                                    <input type="hidden" name="profile_image_url" id="profile_image_url" value="{{ $staff_members->profile_image }}">
                                  @endif


                                  <input type="hidden" name="profile_image" id="profile_image">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">@lang('messages.role')</label>
                                        <select name="roles" id="roles" class="form-select" aria-label="Default select example">
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

                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">@lang('messages.user_email')</label>
                                        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                        @if(!isset(request()->id) && isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->email ?? '' }}" @endif>
                                        @if($errors->first('email'))
                                          <span class="invalid-feedbacks" role="alert">
                                            <strong>{{ $errors->first('email') }}
                                        @endif 
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">@lang('messages.password')</label>
                                        <input name="password"  type="password" class="form-control" id="password">
                                        @if($errors->first('password'))
                                          <span class="invalid-feedbacks" role="alert">
                                            <strong>{{ $errors->first('password') }}
                                        @endif
                                    </div>
                                
                            </div>
                        </div>

                        <hr class="sep">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name" class="form-label">@lang('messages.surname')</label>
                                    <input name="first_name" type="text" class="form-control" id="first_name" aria-describedby="emailHelp"
                                    @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->first_name ?? '' }}" @endif>
                                    @if($errors->first('first_name'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('first_name') }}
                                    @endif 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="last_name" class="form-label">@lang('messages.name')</label>
                                    <input name="last_name" type="text" class="form-control" id="last_name" aria-describedby="emailHelp"
                                    @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->last_name ?? '' }}" @endif>
                                    @if($errors->first('last_name'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('last_name') }}
                                    @endif 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="private_address" class="form-label">@lang('messages.private_address')</label>
                                    <input name="private_address" type="text" class="form-control" id="private_address" aria-describedby="emailHelp"
                                    @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->private_address ?? '' }}" @endif>
                                    @if($errors->first('private_address'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('private_address') }}
                                    @endif 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="house_number" class="form-label">@lang('messages.house_number')</label>
                                    <input name="house_number" type="text" class="form-control" id="house_number" aria-describedby="emailHelp"
                                    @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->house_number ?? '' }}" @endif>
                                    @if($errors->first('house_number'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('house_number') }}
                                    @endif 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="zip_code" class="form-label">@lang('messages.zip_code')</label>
                                    <input name="zip_code" type="text" class="form-control" id="zip_code" aria-describedby="emailHelp"
                                    @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->zip_code ?? '' }}" @endif>
                                    @if($errors->first('zip_code'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('zip_code') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="city" class="form-label">@lang('messages.city')</label>
                                    <input name="city" type="text" class="form-control" id="city" aria-describedby="emailHelp"
                                    @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->city ?? '' }}" @endif>
                                    @if($errors->first('city'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('city') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="country" class="form-label">@lang('messages.country')</label>
                                    <input name="country" type="text" class="form-control" id="country" aria-describedby="emailHelp"
                                    @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->country ?? '' }}" @endif>
                                    @if($errors->first('country'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('country') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone_number" class="form-label">@lang('messages.phone_number')</label>
                                    <input name="phone_number" type="text" class="form-control" id="phone_number" aria-describedby="emailHelp" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->phone_number ?? '' }}" @endif>
                                    @if($errors->first('phone_number'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="mobile_number" class="form-label">@lang('messages.mobile_number')</label>
                                    <input name="mobile_number" type="text" class="form-control" id="mobile_number" aria-describedby="emailHelp" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->mobile_number ?? '' }}" @endif>
                                    @if($errors->first('mobile_number'))
                                      <span class="invalid-feedbacks" role="alert">
                                        <strong>{{ $errors->first('mobile_number') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="sep">
                        {{-- @dd($staff_members->teams) --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                  <label for="teams" class="form-label">@lang('messages.teams')</label>
                                    <select class="form-control js-example-basic-multiple" name="teams[]" multiple="multiple">
                                      @if(!empty($teams))
                                      @foreach($teams as $key => $value)
                                        <option @if(isset($staff_members->teams) &&  !empty($staff_members->teams)) @foreach($staff_members->teams as $key => $team) @if($team->id == $value->id) selected="true" @endif @endforeach @endif value="{{ $value->id }}"> {{ $value->name }} </option>
                                      @endforeach
                                      @endif
                                    </select>
                                    @if($errors->first('teams'))
                                    <span class="invalid-feedbacks" role="alert">
                                      <strong>
                                        {{ $errors->first('teams') }}
                                      </strong>
                                    </span>      
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 text-end">
                                <a href="{{ route('staff-members.index') }}" class="btn btn-secondary">@lang('messages.cancel')</a>
                                <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>

{{-- <div class="container">
  <div class="row">
    @if(isset($staff_members) && !empty($staff_members))
      <form class="row g-3" method="post" action="{{ route('staff-members.update', base64_encode($staff_members->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('staff-members.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    

    <div class="col-md-6">
      <label for="corporate_client" class="form-label">@lang('messages.corporate_client')</label>
      <input type="text" name="corporate_client" required="" class="form-control" id="corporate_client" placeholder="@lang('messages.corporate_client_placeholder')" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->corporate_client ?? '' }}" @endif>
      @if($errors->first('corporate_client'))
        <span class="invalid-feedbacks" role="alert">
          <strong>{{ $errors->first('corporate_client') }}
      @endif  
    </div>
    <div class="col-md-6">
      <label for="first_name" class="form-label">@lang('messages.first_name')</label>
      <input type="text" name="first_name" required="" class="form-control" id="first_name" placeholder="@lang('messages.first_name_placeholder')" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->first_name ?? '' }}" @endif>
      @if($errors->first('first_name'))
        <span class="invalid-feedbacks" role="alert">
          <strong>{{ $errors->first('first_name') }}</strong>
          </strong> }}
      @endif
    </div>
    <div class="col-6">
      <label for="last_name" class="form-label">@lang('messages.last_name')</label>
      <input type="text" name="last_name" required="" class="form-control" id="last_name" placeholder="@lang('messages.last_name_placeholder')" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->last_name ?? '' }}" @endif>
      @if($errors->first('last_name'))
        <span class="invalid-feedbacks" role="alert">
          <strong>{{ $errors->first('last_name') }} </strong>
        </strong>}}
      @endif
    </div>
    <div class="col-6">
      <label for="email" class="form-label">@lang('messages.email')</label>
      <input type="email" min="0" name="email" required="" class="form-control" id="email" placeholder="@lang('messages.email_placeholder')" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->email ?? '' }}" @endif>
      @if($errors->first('email'))
        <span class="invalid-feedbacks" role="alert">
          <strong>{{ $errors->first('email') }}
 </strong>
 </span>     @endif
    </div>
    <div class="col-md-6">
      <label for="phone_number_1" class="form-label">@lang('messages.phone_number_1')</label>
      <input type="text" name="phone_number_1" required="" class="form-control" id="phone_number_1"  placeholder="@lang('messages.phone_number_1_placeholder')" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->phone_number_1 ?? '' }}" @endif>
        @if($errors->first('phone_number_1'))
        <span class="invalid-feedbacks" role="alert">
          <strong>
            {{ $errors->first('phone_number_1') }}
          </strong>
        </span>      
        @endif
    </div>
    <div class="col-md-6">
      <label for="phone_number_2" class="form-label">@lang('messages.phone_number_2')</label>
      <input type="text" name="phone_number_2" required="" class="form-control" id="phone_number_2"  placeholder="@lang('messages.phone_number_2_placeholder')" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->phone_number_2 ?? '' }}" @endif>
        @if($errors->first('phone_number_2'))
        <span class="invalid-feedbacks" role="alert">
          <strong>
            {{ $errors->first('phone_number_2') }}
          </strong>
        </span>      
        @endif
    </div>
    <div class="col-md-6">
      <label for="profile_image" class="form-label">@lang('messages.profile_image')</label>
      <input type="file" name="profile_image" @if(isset($staff_members) && !empty($staff_members)) @else required="" @endif class="form-control" id="profile_images"  placeholder="@lang('messages.profile_image_placeholder')" @if(isset($staff_members) && !empty($staff_members)) value="{{ $staff_members->profile_image ?? '' }}" @endif>
        @if($errors->first('profile_image'))
        <span class="invalid-feedbacks" role="alert">
          <strong>
            {{ $errors->first('profile_image') }}
          </strong>
        </span>      
        @endif
    </div>

    <div class="col-md-6">
      <label for="teams" class="form-label">@lang('messages.teams')</label>
        <select class="form-control js-example-basic-multiple" name="teams[]" multiple="multiple">
          @if(!empty($teams))
          @foreach($teams as $key => $value)
            <option value="{{ $value->id }}"> {{ $value->name }} </option>
          @endforeach
          @endif
        </select>
        @if($errors->first('teams'))
        <span class="invalid-feedbacks" role="alert">
          <strong>
            {{ $errors->first('teams') }}
          </strong>
        </span>      
        @endif
    </div>
  
    <div class="col-12 text-right">
      <a href="{{ route('staff-members.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>
      <button type="submit" class="btn btn-primary">
        @if(isset($staff_members) && !empty($staff_members))
          @lang('messages.update')
        @else
          @lang('messages.submit')
        @endif
      </button>
    </div>
  </form>
  </div>
</div>
 --}}

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">@lang('messages.crop_image_before_upload')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="img-container">
                      <div class="row">
                          <div class="col-md-8">
                              <img src="" id="sample_image" />
                          </div>
                          <div class="col-md-4">
                              <div class="preview"></div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="crop" class="btn btn-primary">@lang('messages.crop')</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
                </div>
            </div>
        </div>
    </div>  


@push('js')
<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>


<script type="text/javascript">

  @if(isset($staff_members) && !empty($staff_members))
      $('#status').val('{{ $staff_members->status }}');
  @else
    $('#status').val("{{ old('status') }}");
  @endif


    function changeImage() {
        $('#uploadImage').trigger('click');
    }
    function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    // $("#previewImg").attr("src", reader.result);
                    // $("#previewImg").attr("height", 100);
                    // $("#previewImg").attr("width", 100);
                }

                reader.readAsDataURL(file);
            }
        }


    $(document).ready(function(){

      var $modal = $('#modal');

      var image = document.getElementById('sample_image');

      var cropper;

      $('#uploadImage').change(function(event){
        var files = event.target.files;

        var done = function(url){
          image.src = url;
          $modal.modal('show');
        };

        if(files && files.length > 0)
        {
          reader = new FileReader();
          reader.onload = function(event)
          {
            done(reader.result);
          };
          reader.readAsDataURL(files[0]);
        }
      });

      $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
          aspectRatio: 1,
          viewMode: 3,
          preview:'.preview'
        });
      }).on('hidden.bs.modal', function(){
        cropper.destroy();
          cropper = null;
      });

      $('#crop').click(function(){
        canvas = cropper.getCroppedCanvas({
          width:400,
          height:400
        });

        canvas.toBlob(function(blob){
          url = URL.createObjectURL(blob);
          var reader = new FileReader();
          reader.readAsDataURL(blob);
          reader.onloadend = function(){
            var base64data = reader.result;
            $("#previewImg").attr("src", reader.result);

            $('#profile_image').val(reader.result);
            $modal.modal('hide');

            // $.ajax({
            //   url:"{{ route('upload.profile.image')}} ",
            //   method:'POST',
            //   data:{uploaded_image:base64data},
            //   success:function(data)
            //   {
            //     $modal.modal('hide');
            //     $('#uploaded_image').attr('src', data);
            //   }
            // });
          };
        });
      });
      
    });

    @if(isset($staff_members->roles) && !empty($staff_members->roles[0]->id))
      $('#roles').val("{{ $staff_members->roles[0]->id }}")
    @endif
 </script>
@endpush