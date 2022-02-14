<div class="container">
  <div class="row">
    @if(!isset(request()->id) && isset($skills) && !empty($skills))
      <form class="row g-3" method="post" action="{{ route('skills.update', base64_encode($skills->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('skills.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="col-md-6">
      <label for="name" class="form-label">@lang('messages.name')</label>
      <input type="text" name="name" required="" class="form-control" id="name" placeholder="@lang('messages.name_placeholder')" @if(isset($skills) && !empty($skills)) value="{{ $skills->name ?? '' }}" @else value="{{ old('name') }}" @endif>
      @if($errors->first('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="description" class="form-label">@lang('messages.description')</label>
      <input type="text" name="description" required="" class="form-control" id="description" placeholder="@lang('messages.description_placeholder')" @if(isset($skills) && !empty($skills)) value="{{ $skills->description ?? '' }}" @else value="{{ old('description') }}" @endif>
      @if($errors->first('description'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('description') }}</strong>
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
      <a href="{{ route('skills.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>
      <button type="submit" class="btn btn-primary">
        @if(isset($skills) && !empty($skills))
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
  @if(isset($skills) && !empty($skills))
      $('#status').val('{{ $skills->status }}');
  @else
    $('#status').val("{{ old('status') }}");
  @endif
  </script>
@endpush