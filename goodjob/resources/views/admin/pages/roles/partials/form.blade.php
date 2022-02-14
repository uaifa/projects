<div class="container">
  <div class="row">
    @if(isset($roles) && !empty($roles))
      <form class="row g-3" method="post" action="{{ route('roles.update', base64_encode($roles->id)) }}" enctype="multipart/form-data">
      @method('put')
    @else
  <form class="row g-3" method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="col-md-6">
        <lable>@lang('messages.name')</lable>
        <input type="text" name="name" class="form-control" id="name" placeholder="@lang('messages.name_placeholder')" @if(!empty($roles)) value="{{ $roles->name }}" @endif>
      @if($errors->first('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div>
    
    <div class="col-12">
      <div class="panel no-border">
          <div class="panel-title">
              <div class="panel-head">@lang('messages.enter_permissions')</div>
          </div>
          <div class="panel-body">
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-3">
                        <div class="checkbox checkbox-theme">
                            <input type="checkbox" class="flipswitch " name="permissions[]" id="permission_{{$permission->id}}" @if(!empty($permission_role)) @foreach($permission_role as $row)  @if(!empty($row) && $row == $permission->id) checked @endif @endforeach @endif  value="{{$permission->id}}">
                            <label class="permission-labels" for="permission_{{$permission->id}}">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
      </div>
    </div>

    <div class="col-12 text-right">
      <a href="{{ route('roles.index') }}" class="btn btn-info text-white">
          @lang('messages.back')
      </a>

      <button type="submit" class="btn btn-primary">
        @if(isset($roles) && !empty($roles))
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