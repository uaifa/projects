<div class="container">
  <div class="row">
    @if(!isset(request()->id) && isset($teams) && !empty($teams))
      <form class="row g-3" method="post" action="{{ route('teams.update', base64_encode($teams->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('teams.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="col-md-6">
      <label for="name" class="form-label">@lang('messages.name')</label>
      <input type="text" name="name" required="" class="form-control" id="name" placeholder="@lang('messages.name_placeholder')" @if(isset($teams) && !empty($teams)) value="{{ $teams->name ?? '' }}" @else value="{{ old('name') }}" @endif>
      @if($errors->first('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div>

    <div class="col-md-6">
      <label for="address" class="form-label">@lang('messages.address')</label>
      <input type="text" name="address" required="" class="form-control" id="address" placeholder="@lang('messages.address_placeholder')" @if(isset($teams) && !empty($teams)) value="{{ $teams->address ?? '' }}" @else value="{{ old('address') }}" @endif>
      @if($errors->first('address'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('address') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="city" class="form-label">@lang('messages.city')</label>
      <input type="text" name="city" required="" class="form-control" id="city" placeholder="@lang('messages.city_placeholder')" @if(isset($teams) && !empty($teams)) value="{{ $teams->city ?? '' }}" @else value="{{ old('city') }}" @endif>
      @if($errors->first('city'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('city') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="country" class="form-label">@lang('messages.country')</label>
      <input type="text" name="country" required="" class="form-control" id="country" placeholder="@lang('messages.country_placeholder')" @if(isset($teams) && !empty($teams)) value="{{ $teams->country ?? '' }}" @else value="{{ old('country') }}" @endif>
      @if($errors->first('country'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('country') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="zip_code" class="form-label">@lang('messages.zip_code')</label>
      <input type="text" name="zip_code" required="" class="form-control" id="zip_code" placeholder="@lang('messages.zip_code_placeholder')" @if(isset($teams) && !empty($teams)) value="{{ $teams->zip_code ?? '' }}" @else value="{{ old('zip_code') }}" @endif>
      @if($errors->first('zip_code'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('zip_code') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="description" class="form-label">@lang('messages.description')</label>
      <input type="text" name="description" required="" class="form-control" id="description" placeholder="@lang('messages.description_placeholder')" @if(isset($teams) && !empty($teams)) value="{{ $teams->description ?? '' }}" @else value="{{ old('description') }}" @endif>
      @if($errors->first('description'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('description') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="skills" class="form-label">@lang('messages.skills')</label>
        <select class="form-control js-example-basic-multiple" name="skills[]" multiple="multiple">
          @if(!empty($skills))
          @foreach($skills as $key => $value)
            <option @if(isset($teams->skills) &&  !empty($teams->skills)) @foreach($teams->skills as $key => $team) @if($team->id == $value->id) selected="true" @endif @endforeach @endif value="{{ $value->id }}"> {{ $value->name }} </option>
          @endforeach
          @endif
        </select>
        @if($errors->first('skills'))
        <span class="invalid-feedbacks" role="alert">
          <strong>
            {{ $errors->first('skills') }}
          </strong>
        </span>      
        @endif
  </div>

    <div class="col-md-6">
      <label for="status" class="form-label">@lang('messages.status')</label>
      <select class="form-control" name="status" id="status">
        <option value="">@lang('messages.status_placeholder')</option>
        <option value="1">@lang('messages.active')</option>
        <option value="0">@lang('messages.inactive')</option>
      </select>
      @if($errors->first('status'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('status') }}</strong>
        </span>
      @endif
    </div>
    

    <div class="col-12 text-right">
      <a href="{{ route('teams.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>
      <button type="submit" class="btn btn-primary">
        @if(isset($teams) && !empty($teams))
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
  @if(isset($teams) && !empty($teams))
      $('#status').val('{{ $teams->status }}');
  @else
    $('#status').val("{{ old('status') }}");
  @endif
  </script>
@endpush