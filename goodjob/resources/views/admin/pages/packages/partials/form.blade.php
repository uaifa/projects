<div class="container">
  <div class="row">
    @if(!isset(request()->id) && isset($packages) && !empty($packages))
      <form class="row g-3" method="post" action="{{ route('packages.update', base64_encode($packages->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('packages.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="col-md-6">
      <label for="title" class="form-label">@lang('messages.title')</label>
      <input type="text" name="title" required="" class="form-control" id="title" placeholder="@lang('messages.title_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->title ?? '' }}" @endif>
      @if($errors->first('title'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('title') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="heading" class="form-label">@lang('messages.heading')</label>
      <input type="text" name="heading" required="" class="form-control" id="heading" placeholder="@lang('messages.heading_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->heading ?? '' }}" @endif>
      @if($errors->first('heading'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('heading') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="sub_heading" class="form-label">@lang('messages.sub_heading')</label>
      <input type="text" name="sub_heading" required="" class="form-control" id="sub_heading" placeholder="@lang('messages.sub_heading_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->sub_heading ?? '' }}" @endif>
      @if($errors->first('sub_heading'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('sub_heading') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="package_name" class="form-label">@lang('messages.package_name')</label>
      <input type="text" name="package_name" required="" class="form-control" id="package_name" placeholder="@lang('messages.package_name_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->package_name ?? '' }}" @endif>
      @if($errors->first('package_name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('package_name') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="package_type_text" class="form-label">@lang('messages.package_type_text')</label>
      <input type="text" name="package_type_text" required="" class="form-control" id="package_type_text" placeholder="@lang('messages.package_type_text_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->package_type_text ?? '' }}" @endif>
      @if($errors->first('package_type_text'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('package_type_text') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="duration" class="form-label">@lang('messages.duration')</label>
      <input type="text" name="duration" required="" class="form-control input-number" id="duration" placeholder="@lang('messages.duration_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->duration ?? '' }}" @endif>
      @if($errors->first('duration'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('duration') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
      <label for="icon" class="form-label">@lang('messages.icon')</label>
      <input type="file" name="icon" @if(isset($packages) && !empty($packages)) @else required="" @endif class="form-control" id="icon" placeholder="@lang('messages.icon_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->icon ?? '' }}" @endif>
      @if($errors->first('icon'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('icon') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
      <label for="currency" class="form-label">@lang('messages.currency')</label>
      <select id="currency" name="currency" class="form-control">
        <option value=""> @lang('messages.select_currency') </option>
        @if(!empty($currencies))
        @foreach($currencies as $key => $value)
          <option value="{{ $value->code }}"> {{ $value->code }} </option>
        @endforeach
        @endif            
    </select>
      
      @if($errors->first('currency'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('currency') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
      <label for="price" class="form-label">@lang('messages.price')</label>
      <input type="text" min="0" name="price" required="" class="form-control currency" id="price" placeholder="@lang('messages.price_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->price ?? '' }}" @endif>
      @if($errors->first('price'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('price') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
      <label for="manager" class="form-label">@lang('messages.manager')</label>
      <input type="text" name="manager" required="" class="form-control input-number" id="manager" id="@lang('messages.manager_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->manager ?? '' }}" @endif>
      @if($errors->first('manager'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('manager') }}</strong>
        </span>
      @endif
    </div>

    <div class="col-6">
      <label for="users" class="form-label">@lang('messages.users')</label>
      <input type="text" name="users" required="" class="form-control input-number" id="users" placeholder="@lang('messages.users_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->users ?? '' }}" @endif>
      @if($errors->first('users'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('users') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
      <label for="support_text" class="form-label">@lang('messages.support_text')</label>
      <input type="text" name="support_text" required="" class="form-control" id="support_text" placeholder="@lang('messages.support_text_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->support_text ?? '' }}" @endif>
      @if($errors->first('support_text'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('support_text') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
      <label for="storage_text" class="form-label">@lang('messages.storage_text')</label>
      <input type="text" name="storage_text" required="" class="form-control" id="storage_text" placeholder="@lang('messages.storage_text_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->storage_text ?? '' }}" @endif>
      @if($errors->first('storage_text'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('storage_text') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
      <label for="storage_place_size" class="form-label">@lang('messages.storage_place_size')</label>
      <input type="text" name="storage_place_size" required="" class="form-control input-number" id="storage_place_size" placeholder="@lang('messages.storage_place_size_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->storage_place_size ?? '' }}" @endif>
      @if($errors->first('storage_place_size'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('storage_place_size') }}</strong>
        </span>
      @endif
    </div>
    
    <div class="col-6">
      <label for="button_text" class="form-label">@lang('messages.button_text')</label>
      <input type="text" name="button_text" required="" class="form-control" id="button_text" placeholder="@lang('messages.button_text_placeholder')" @if(isset($packages) && !empty($packages)) value="{{ $packages->button_text ?? '' }}" @endif>
      @if($errors->first('button_text'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('button_text') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-12">
      <label for="description" class="form-label">@lang('messages.description')</label>
      <textarea name="description" required="" class="form-control" id="description" placeholder="@lang('messages.description_placeholder')">@if(isset($packages) && !empty($packages)) {{ $packages->description ?? '' }} @endif</textarea>
        @if($errors->first('description'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
        @endif
    </div>

    <div class="col-12 text-right">
      <a href="{{ route('packages.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>

      <button type="submit" class="btn btn-primary">
        @if(isset($packages) && !empty($packages))
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
  @if(isset($packages) && !empty($packages))
    <script type="text/javascript">
      $('#currency').val("{{ $packages->currency }}");
    </script>
  @endif
@endpush