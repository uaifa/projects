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
      <a class="btn btn-primary floar-right" href="{{ route('roles.create') }}"> @lang('messages.add') @lang('messages.roles') </a>

    </div>
    <div class="col-12">
      <div class="card-body">
        <table class="datatable-init table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$roles->isEmpty())
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($role->created_at)) }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('roles.edit',$role->id) }}">
                                <i class="fa fa-edit "></i>
                            </a>
                            <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func({{ $role->id }},'{{ route('roles.destroy', $role->id) }}');"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif



        </tbody>
    </table>
    </div>
    </div>
  </div>
</div>

@push('js')
@endpush