<div class="container">
  <div class="row">
    @if(!isset(request()->id) && isset($places) && !empty($places))
      <form class="row g-3" method="post" action="{{ route('places.update', base64_encode($places->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="col-md-6">
      <label for="job_title" class="form-label">@lang('messages.job_title')</label>
      <input type="text" name="job_title" required="" class="form-control" id="job_title" placeholder="@lang('messages.job_title_placeholder')" @if(isset($places) && !empty($places)) value="{{ $places->job_title ?? '' }}" @endif>
      @if($errors->first('job_title'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('job_title') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="distance" class="form-label">@lang('messages.distance')</label>
      <input type="text" name="distance" required="" class="form-control" id="distance" placeholder="@lang('messages.distance_placeholder')" @if(isset($places) && !empty($places)) value="{{ $places->distance ?? '' }}" @endif>
      @if($errors->first('distance'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('distance') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-6">
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
    </div>
    <div class="col-6">
      <label for="description" class="form-label">@lang('messages.description')</label>
      <input type="text" min="0" name="description" required="" class="form-control" id="description" placeholder="@lang('messages.description_placeholder')" @if(isset($places) && !empty($places)) value="{{ $places->description ?? '' }}" @endif>
      @if($errors->first('description'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('description') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-md-6">
      <label for="scheduled" class="form-label">@lang('messages.scheduled')</label>
      <input type="text" name="scheduled" required="" class="form-control" id="scheduled" placeholder="@lang('messages.scheduled_placeholder')" @if(isset($places) && !empty($places)) value="{{ $places->scheduled ?? '' }}" @endif>
      @if($errors->first('scheduled'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('scheduled') }}</strong>
        </span>
      @endif
    </div>

    <div class="col-md-6">
      <label for="assign_to" class="form-label">@lang('messages.assign_to')</label>
      <select name="assign_to" id="assign_to" class="form-control" required="">
        <option value="">@lang('messages.client')</option>
        @if(isset($clients) && !empty($clients))
        @foreach($clients as $key => $client)
          <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }} </option>
        @endforeach
        @endif
      </select>
      @if($errors->first('assign_to'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('assign_to') }}</strong>
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
      <a href="{{ route('places.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>
      <button type="submit" class="btn btn-primary">
        @if(isset($places) && !empty($places))
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
  @if(isset($places) && !empty($places))
      $('#status').val('{{ $places->status }}');
  @else
    $('#status').val("{{ old('status') }}");
  @endif
  </script>
@endpush