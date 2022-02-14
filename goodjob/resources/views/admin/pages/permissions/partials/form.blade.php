<div class="container">
  <div class="row">
    @if(isset($permissions) && !empty($permissions))
      <form class="row g-3" method="post" action="{{ route('permissions.update', base64_encode($permissions->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="col-md-6">
      <lable>@lang('messages.name')</lable>
      <input type="text" name="name" class="form-control" id="name" placeholder="@lang('messages.name_placeholder')" @if(!empty($permissions)) value="{{ $permissions->name }}" @endif>
      @if($errors->first('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div>
 

    <div class="col-12 text-right">
      <a href="{{ route('permissions.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>

      <button type="submit" class="btn btn-primary">
        @if(isset($permissions) && !empty($permissions))
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
  
@endpush