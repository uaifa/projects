@push('css')
  <style type="text/css">
    table{
      width: 100% !important;
    }
  </style>
@endpush

<div class="container-fluid">
  <div class="row">
    <div class="col-12 ">
      <a class="btn btn-primary floar-right" href="{{ route('permissions.create') }}"> @lang('messages.add') @lang('messages.permissions') </a>

    </div>
    <div class="col-12">
      <div class="card-body">
        <table id="staffs" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>@lang('messages.name')</th>
                                    <th>@lang('messages.actions')</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    @foreach ($permissions as $permission)
                                        <td>{{ $permission->name}}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('permissions.edit',$permission->id) }}">
                                                <i class="fa fa-edit "></i>
                                            </a>
                                            <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func({{ $permission->id }},'{{ route('permissions.destroy', $permission->id) }}');"><i class="fa fa-trash"></i></button>
                                        </td>
                                </tr>

                                @endforeach


                                </tbody>
                            </table>

    </div>
    </div>
  </div>
</div>

@push('js')
@endpush