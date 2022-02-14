
{{-- @dd($clients) --}}

@push('css')
  <style type="text/css">
    #add_additional_contact_person{
      cursor: pointer;
    }
  </style>
@endpush


<div class="container">
  <div class="row">
    @if(!isset(request()->id) && isset($clients) && !empty($clients))
      <form class="row g-3" method="post" action="{{ route('clients.update', base64_encode($clients->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('clients.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    

    <div class="col-md-6">
      <label for="corporate_client" class="form-label">@lang('messages.corporate_client')</label>
      <input type="text" name="corporate_client" required="" class="form-control" id="corporate_client" placeholder="@lang('messages.corporate_client_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->corporate_client ?? '' }}" @else value="{{ old('corporate_client') }}" @endif>
      @if($errors->first('corporate_client'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('corporate_client') }}
      @endif  
    </div>
    <div class="col-md-6">
      <label for="company" class="form-label">@lang('messages.company')</label>
      <input type="text" name="company" required="" class="form-control" id="company" placeholder="@lang('messages.company_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->company ?? '' }}" @else value="{{ old('company') }}" @endif>
      @if($errors->first('company'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('company') }}
      @endif  
    </div>
    <div class="col-md-6">
      <label for="first_name" class="form-label">@lang('messages.first_name')</label>
      <input type="text" name="first_name" required="" class="form-control" id="first_name" placeholder="@lang('messages.first_name_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->first_name ?? '' }}" @else value="{{ old('first_name') }}" @endif>
      @if($errors->first('first_name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('first_name') }}</strong>
          </strong> }}
      @endif
    </div>
    <div class="col-6">
      <label for="last_name" class="form-label">@lang('messages.last_name')</label>
      <input type="text" name="last_name" required="" class="form-control" id="last_name" placeholder="@lang('messages.last_name_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->last_name ?? '' }}" @else value="{{ old('last_name') }}" @endif>
      @if($errors->first('last_name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('last_name') }} </strong>
        </strong>}}
      @endif
    </div>
    <div class="col-6">
      <label for="email" class="form-label">@lang('messages.email')</label>
      <input type="email" min="0" name="email" required="" class="form-control" id="email" placeholder="@lang('messages.email_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->email ?? '' }}" @else value="{{ old('email') }}" @endif>
      @if($errors->first('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}
 </strong>
 </span>     @endif
    </div>
    <div class="col-md-6">
      <label for="street" class="form-label">@lang('messages.street')</label>
      <input type="text" name="street" required="" class="form-control" id="street"  placeholder="@lang('messages.street_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->street ?? '' }}" @else value="{{ old('street') }}" @endif>
        @if($errors->first('street'))
        <span class="invalid-feedback" role="alert">
          <strong>
            {{ $errors->first('street') }}
          </strong>
        </span>      
        @endif
    </div>
    <div class="col-md-6">
      <label for="additional_address" class="form-label">@lang('messages.additional_address')</label>
      <input type="text" name="additional_address" required="" class="form-control" id="additional_address"  placeholder="@lang('messages.additional_address_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->additional_address ?? '' }}" @else value="{{ old('additional_address') }}" @endif>
        @if($errors->first('additional_address'))
        <span class="invalid-feedback" role="alert">
          <strong>
            {{ $errors->first('additional_address') }}
          </strong>
        </span>      
        @endif
    </div>

    <div class="col-md-6">
      <label for="house_no" class="form-label">@lang('messages.house_no')</label>
      <input type="text" name="house_no" required="" class="form-control" id="house_no" placeholder="@lang('messages.house_no_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->house_no ?? '' }}" @else value="{{ old('house_no') }}" @endif>
      @if($errors->first('company'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('company') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="zip_code" class="form-label">@lang('messages.zip_code')</label>
      <input type="text" name="zip_code" required="" class="form-control" id="zip_code" placeholder="@lang('messages.zip_code_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->zip_code ?? '' }}" @else value="{{ old('zip_code') }}" @endif>
      @if($errors->first('zip_code'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('zip_code') }}</strong>
          </strong>}
      @endif
    </div>
    <div class="col-md-6">
      <label for="town" class="form-label">@lang('messages.town')</label>
      <input type="text" name="town" required="" class="form-control" id="town" placeholder="@lang('messages.town_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->town ?? '' }}" @else value="{{ old('town') }}" @endif>
      @if($errors->first('town'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('town') }}
  </strong>
  </span>    @endif
    </div>

    <div class="col-md-6">
      <label for="telephone" class="form-label">@lang('messages.telephone')</label>
      <input type="text" name="telephone" required="" class="form-control" id="telephone" placeholder="@lang('messages.telephone_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->telephone ?? '' }}" @else value="{{ old('telephone') }}" @endif>
      @if($errors->first('telephone'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('telephone') }} </strong>
        </strong>}}
      @endif
    </div>
    
    <div class="col-md-6">
      <label for="branch" class="form-label">@lang('messages.branch')</label>
      <input type="text" name="branch" required="" class="form-control" id="branch" placeholder="@lang('messages.branch_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->branch ?? '' }}" @else value="{{ old('branch') }}" @endif>
      @if($errors->first('branch'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('branch') }}
</strong>
</span>      @endif
    </div>

    {{-- <div class="col-md-6">
      <label for="status" class="form-label">@lang('messages.status')</label>
      <select class="form-control" name="status" id="status">
        <option value="">@lang('messages.status_placeholder')</option>
        <option value="1">@lang('messages.active')</option>
        <option value="0">@lang('messages.inactive')</option>
      </select>
      @if($errors->first('status'))
        <span class="invalid-feedback" role="alert">
          <strong>
            {{ $errors->first('status') }}
          </strong>
        </span>      
      @endif
    </div> --}}
    <div class="row col-12 m-0 p-0">
      <h2></h2>
      @if(!empty($clients) && !empty($clients->ContactPerson))
      <span id="custom_fields">
      @foreach($clients->ContactPerson as $key => $value)
          <div class="add-new-job-main-div row">
          <div class="col-md-6">
            <label for="contact_person" class="form-label">@lang('messages.contact_person')</label>
            <input type="text" name="contact_person[{{ $key }}]" required="" class="form-control" id="contact_person" placeholder="@lang('messages.contact_person_placeholder')" @if(!empty($value)) value="{{ $value->name ?? '' }}" @else value="{{ old('contact_person[0]') }}" @endif>
            @if($errors->first('contact_person'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact_person') }} </strong>
              </strong>}}
            @endif
          </div>
          <div class="col-md-6">
            <label for="contact_person_email" class="form-label">@lang('messages.contact_person_email')</label>
            <input type="text" name="contact_person_email[{{ $key }}]" required="" class="form-control" id="contact_person_email" placeholder="@lang('messages.email_placeholder')" @if(!empty($value)) value="{{ $value->email ?? '' }}" @else value="{{ old('contact_person_email[0]') }}" @endif>
            @if($errors->first('contact_person_email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact_person_email') }} </strong>
              </strong>}}
            @endif
          </div>
          <div class="col-md-6">
            <label for="contact_person_phone_number" class="form-label">@lang('messages.contact_person_phone_number')</label>
            <input type="text" name="contact_person_phone_number[{{ $key }}]" required="" class="form-control" id="contact_person_phone_number" placeholder="@lang('messages.phone_number_placeholder')" @if(!empty($value)) value="{{ $value->phone_number ?? '' }}" @else value="{{ old('contact_person_phone_number[0]') }}" @endif>
            @if($errors->first('contact_person_phone_number'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact_person_phone_number') }} </strong>
              </strong>}}
            @endif
          </div>
          <div class="col-md-6">
            <label for="contact_person_function" class="form-label">@lang('messages.contact_person_function')</label>
            <input type="text" name="contact_person_function[{{ $key }}]" required="" class="form-control" id="contact_person_function" placeholder="@lang('messages.function_placeholder')" @if(!empty($value)) value="{{ $value->functions ?? '' }}" @else value="{{ old('contact_person_function[0]') }}" @endif>
            @if($errors->first('contact_person_function'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact_person_function') }} </strong>
              </strong>}}
            @endif
          </div>

          @if($key > 0)
          <br>
            <button class="mt-4 btn btn-primary remCF remove-btn" type="button">
                Remove additional contact person 
            </button> 
          @endif
        </div>
      @endforeach
      </span>
       <div class="col-12">
          <h2 class="add-additional-contact-person" id="add_additional_contact_person">
            <span>+</span>
            @lang('messages.add_additional_contact_person')
          </h2>
        </div>
      @else
        <div class="col-md-6">
          <label for="contact_person" class="form-label">@lang('messages.contact_person')</label>
          <input type="text" name="contact_person[0]" required="" class="form-control" id="contact_person" placeholder="@lang('messages.contact_person_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person ?? '' }}" @else value="{{ old('contact_person[0]') }}" @endif>
          @if($errors->first('contact_person'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person') }} </strong>
            </strong>}}
          @endif
        </div>
        <div class="col-md-6">
          <label for="contact_person_email" class="form-label">@lang('messages.contact_person_email')</label>
          <input type="text" name="contact_person_email[0]" required="" class="form-control" id="contact_person_email" placeholder="@lang('messages.email_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person_email ?? '' }}" @else value="{{ old('contact_person_email[0]') }}" @endif>
          @if($errors->first('contact_person_email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person_email') }} </strong>
            </strong>}}
          @endif
        </div>
        <div class="col-md-6">
          <label for="contact_person_phone_number" class="form-label">@lang('messages.contact_person_phone_number')</label>
          <input type="text" name="contact_person_phone_number[0]" required="" class="form-control" id="contact_person_phone_number" placeholder="@lang('messages.phone_number_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person_phone_number ?? '' }}" @else value="{{ old('contact_person_phone_number[0]') }}" @endif>
          @if($errors->first('contact_person_phone_number'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person_phone_number') }} </strong>
            </strong>}}
          @endif
        </div>
        <div class="col-md-6">
          <label for="contact_person_function" class="form-label">@lang('messages.contact_person_function')</label>
          <input type="text" name="contact_person_function[0]" required="" class="form-control" id="contact_person_function" placeholder="@lang('messages.function_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person_function ?? '' }}" @else value="{{ old('contact_person_function[0]') }}" @endif>
          @if($errors->first('contact_person_function'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person_function') }} </strong>
            </strong>}}
          @endif
        </div>
        <div class="col-12">
          <h2 class="add-additional-contact-person" id="add_additional_contact_person">
            <span>+</span>
            @lang('messages.add_additional_contact_person')
          </h2>
        </div>
        <span id="custom_fields">
            
          </span>
      @endif
        
        
        
        {{-- <div class="col-12" id="additional_contact_person"> --}}
          
            
        {{-- </div> --}}
    </div>

    <div class="col-12 text-right">
      <a href="{{ route('clients.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>

      <button type="submit" class="btn btn-primary">
        @if(isset($clients) && !empty($clients))
          @lang('messages.update')
        @else
          @lang('messages.submit')
        @endif
      </button>
    </div>
  </form>
  </div>
</div>


@push('js')
<script type="text/javascript">
  @if(isset($clients) && !empty($clients))
      $('#status').val('{{ $clients->status }}');
  @else
    $('#status').val("{{ old('status') }}");
  @endif

 var counter = 0;
  $('#add_additional_contact_person').on('click', function(e){
    if (counter < 20) { //max input box allowed
                counter++;
    var html = `<div class="add-new-job-main-div row">  
            <div class="col-12"> <hr> </div> 
          <div class="col-md-6">
          <label for="contact_person" class="form-label">@lang('messages.contact_person')</label>
          <input type="text" name="contact_person[`+counter+`]" required="" class="form-control" id="contact_person" placeholder="@lang('messages.contact_person_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person ?? '' }}" @else value="{{ old('contact_person[`+counter+`]') }}" @endif>
          @if($errors->first('contact_person'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person') }} </strong>
            </strong>}}
          @endif
        </div>
        <div class="col-md-6">
          <label for="contact_person_email" class="form-label">@lang('messages.contact_person_email')</label>
          <input type="text" name="contact_person_email[`+counter+`]" required="" class="form-control" id="contact_person_email" placeholder="@lang('messages.email_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person_email ?? '' }}" @else value="{{ old('contact_person_email[`+counter+`]') }}" @endif>
          @if($errors->first('contact_person_email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person_email') }} </strong>
            </strong>}}
          @endif
        </div>
        <div class="col-md-6">
          <label for="contact_person_phone_number" class="form-label">@lang('messages.contact_person_phone_number')</label>
          <input type="text" name="contact_person_phone_number[`+counter+`]" required="" class="form-control" id="contact_person_phone_number" placeholder="@lang('messages.phone_number_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person_phone_number ?? '' }}" @else value="{{ old('contact_person_phone_number[`+counter+`]') }}" @endif>
          @if($errors->first('contact_person_phone_number'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person_phone_number') }} </strong>
            </strong>}}
          @endif
        </div>
        <div class="col-md-6">
          <label for="contact_person_function" class="form-label">@lang('messages.contact_person_function')</label>
          <input type="text" name="contact_person_function[`+counter+`]" required="" class="form-control" id="contact_person_function" placeholder="@lang('messages.function_placeholder')" @if(isset($clients) && !empty($clients)) value="{{ $clients->contact_person_function ?? '' }}" @else value="{{ old('contact_person_function[`+counter+`]') }}" @endif>
          @if($errors->first('contact_person_function'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('contact_person_function') }} </strong>
            </strong>}}
          @endif
        </div> 
       
        <br>
            <button class="mt-4 btn btn-primary remCF remove-btn" type="button">
                Remove additional contact person 
            </button> 
            </div> 
        
        `;
        // if(counter >= 2)
            // html = '<div class="col-12"> <hr> </div>'+ html;
      }
        
        $('#custom_fields').append(html);
        $("#custom_fields").on('click','.remCF',function(){
            counter--;
            $(this).parent().remove();
        });
  });

  $("#custom_fields").on('click','.remCF',function(){
    $(this).parent().remove();
      // $(this).parent().remove();
  });
  </script>
@endpush