@push('css')
@include('admin.partials.datatables_css')
  <style type="text/css">
    table{
      width: 100% !important;
    }
  </style>
@endpush

<!-- Page content-->
            <div class="container">
                <h3>@lang('messages.joblist')</h3>
      <div class="addnew d-inline-block w-100">
          <div class="dropdown float-end">
              <a class="dropdown-dots" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('assets') }}/images/3dots.png">
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="#" onclick="get_checked_value('edit')">
                      Edit
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" onclick="get_checked_value('delete')">
                      Delete
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" onclick="get_checked_value('deublicate')">
                      Duplicate
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      Import List
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      Export List
                    </a>
                  </li>
              </ul>
          </div>
          <a class="float-end ms-auto" href="{{ route('joblists.create') }}"> <img src="{{ asset('assets') }}/images/icon-add.png"> </a>
      </div>

                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="white-box px-0">

                            <div class="table-responsive">
                                <table class="dte-table">
                                    <thead>
                                        <tr>
                                            <th> @lang('messages.date') </th>
                                            <th> @lang('messages.job_title') </th>
                                            <th> @lang('messages.client') </th>
                                            <th> @lang('messages.description') </th>
                                            <th> @lang('messages.time') </th>
                                            <th> @lang('messages.responsible')</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($jobs_lists) && count($jobs_lists) > 0)
                                        @foreach($jobs_lists as $key => $value)
                                        @if(!empty($value))
                                            <tr class="date">
                                                <td colspan="7">
                                                    <strong class="mt-3 d-block"> {{ date('l', strtotime($key)) }}, {{ date('d', strtotime($key)) }} {{ date('M', strtotime($key)) }} {{ date('Y', strtotime($key)) }} </strong>
                                                </td>
                                            </tr>
                                            @foreach($value as $key => $val)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="sub_chk" data-encoded-id="{{ $val->encoded_id }}" data-id="{{ $val->id }}">

                                                    {{-- <input type="checkbox"> --}}
                                                </td>
                                                <td> {{ $val->name ?? '' }} </td>
                                                <td> {{ $val->clients->first_name.'  '.$val->clients->last_name  ?? '' }} </td>
                                                <td> {{ $val->description ?? '' }} </td>
                                                <td> 
                                                    {{ $val->from_time_hours }} {{ $val->to_time_minutes }} 
                                                    {{-- 10:00 am - 01:30 pm --}}
                                                </td>
                                                <td> {{ $val->contact_person ?? '' }} </td>
                                                <td>
                                                    <span class="actions">
                                                        <span class="status 
                                                            @if($val->status == 'done') green 
                                                            @elseif($val->status == 'cancel') red
                                                            @elseif($val->status == 'pendent') orange
                                                            @elseif($val->status == 'inprogress') orange @endif
                                                        "></span>
                                                        <a href="{{ route('joblists.edit', base64_encode($val->id)) }}">
                                                            <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                        </a>
                                                        <img src="{{ asset('assets') }}/images/icon-person.png">
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        @endforeach
                                        @endif
                                       {{--  <tr class="date">
                                            <td colspan="7">
                                                <strong class="mt-3 d-block">Friday, 25 July 2021</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status green"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status orange"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status red"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr class="date">
                                            <td colspan="7">
                                                <strong class="mt-3 d-block">Friday, 25 July 2021</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status green"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status orange"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status red"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>


                                        <tr class="date">
                                            <td colspan="7">
                                                <strong class="mt-3 d-block">Friday, 25 July 2021</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status green"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status orange"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status red"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>


                                        <tr class="date">
                                            <td colspan="7">
                                                <strong class="mt-3 d-block">Friday, 25 July 2021</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status green"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status orange"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status red"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>


                                        <tr class="date">
                                            <td colspan="7">
                                                <strong class="mt-3 d-block">Friday, 25 July 2021</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status green"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status orange"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status red"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>


                                        <tr class="date">
                                            <td colspan="7">
                                                <strong class="mt-3 d-block">Friday, 25 July 2021</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status green"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status orange"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Update IP-Telefonie</td>
                                            <td>Laufer Radiegummis AD</td>
                                            <td>Description Description Description</td>
                                            <td>10:00 am - 01:30 pm</td>
                                            <td>Carla Brulmann</td>
                                            <td>
                                                <span class="actions">
                                                    <span class="status red"></span>
                                                    <img src="{{ asset('assets') }}/images/icon-edit.png">
                                                    <img src="{{ asset('assets') }}/images/icon-person.png">
                                                </span>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-- Page content-->
{{--   <div class="container">
      <h3>@lang('messages.joblist')</h3>
      <div class="addnew d-inline-block w-100">
          <div class="dropdown float-end">
              <a class="dropdown-dots" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('assets') }}/images/3dots.png">
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="#" onclick="get_checked_value('edit')">
                      Edit
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" onclick="get_checked_value('delete')">
                      Delete
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" onclick="get_checked_value('deublicate')">
                      Duplicate
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      Import List
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      Export List
                    </a>
                  </li>
              </ul>
          </div>
          <a class="float-end ms-auto" href="{{ route('joblists.create') }}"> <img src="{{ asset('assets') }}/images/icon-add.png"> </a>
      </div>
      <div class="row mb-5">
          <div class="col-md-12">
              <div class="white-box px-0">
                  <div class="table-responsive">
                      <table class="emp-table table" id="datatables-joblists">
                        <thead>
                          <tr>
                              <th class="padding-left-10"><input type="checkbox" id="master"></th>
                              <th>@lang('messages.name')</th>
                               <th>@lang('messages.status')</th>
                               <th>@lang('messages.description')</th>
                               <th>@lang('messages.date')</th>
                               <th>@lang('messages.from_time_hours')</th>
                               <th>@lang('messages.to_time_minutes')</th>
                               <th>@lang('messages.client')</th>
                               <th>@lang('messages.place_of_work')</th>
                               <th>@lang('messages.contact_person')</th>
                               <th>@lang('messages.phone')</th>
                               <th>@lang('messages.email')</th>
                               <th>@lang('messages.created_by')</th>
                               <th>@lang('messages.signature')</th>
                              <th>&nbsp;</th>
                          </tr>
                        </thead>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div> --}}

{{-- <div class="container-fluid">
  <div class="row">
    <div class="col-12 ">
      <a class="btn btn-primary floar-right" href="{{ route('joblists.create') }}"> @lang('messages.add') @lang('messages.joblist') </a>

    </div>
    <div class="col-12">
      <div class="card-body">
        <table class="table table-bordered" id="datatables-joblists">
           <thead>
              <tr>
                 <th>@lang('messages.id')</th>
                 <th>@lang('messages.name')</th>
                 <th>@lang('messages.status')</th>
                 <th>@lang('messages.description')</th>
                 <th>@lang('messages.date')</th>
                 <th>@lang('messages.from_time_hours')</th>
                 <th>@lang('messages.to_time_minutes')</th>
                 <th>@lang('messages.customer_id')</th>
                 <th>@lang('messages.place_of_work')</th>
                 <th>@lang('messages.contact_person')</th>
                 <th>@lang('messages.phone')</th>
                 <th>@lang('messages.email')</th>
                 <th>@lang('messages.created_by')</th>
                 <th>@lang('messages.signature')</th>
                 <th>@lang('messages.action')</th>
              </tr>
           </thead>
        </table>
    </div>
    </div>
  </div>
</div> --}}

@push('js')
@include('admin.partials.datatables_js')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#datatables-joblists').DataTable({

            "oLanguage": {
                    "sLengthMenu": "@lang('messages.show') _MENU_ @lang('messages.entries')",

                    "sSearch": "@lang('messages.search'): ",
                    "sProcessing": "@lang('messages.processing')",
                    "sZeroRecords": "@lang('messages.no_data_available_in_table')",
                    "sInfoEmpty": "@lang('messages.no_records') ",
                    "sInfo": "@lang('messages.showing') _START_ @lang('messages.to') _END_ @lang('messages.from') _TOTAL_ @lang('messages.entries')",
                    "oPaginate": {
                        "sNext": "@lang('messages.next')", // This is the link to the next page
                        "sPrevious": "@lang('messages.previous')", // This is the link to the previous page
                    }
              },

             processing: true,
             serverSide: true,
             ajax: "{{ route('joblists.index') }}",
             columns: [
                      { 
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        "render": function(data, type, full, meta) {
                          
                            return `<input type="checkbox" class="sub_chk" data-encoded-id="`+full.encoded_id+`" data-id="`+full.id+`">`;
                        }
                      },
                      { data: 'name', name: 'name' },
                      { data: 'status', name: 'status' },
                      { data: 'description', name: 'description'},
                      { data: 'date', name: 'date' },
                      { data: 'from_time_hours', name: 'from_time_hours' },
                      { data: 'to_time_minutes', name: 'to_time_minutes' },
                      { 
                        data: 'clients', name: 'clients',
                        render: function(data, full, type, meta){
                          return data.last_name ?? '';
                        }
                        
                      },
                      { data: 'place_of_work', name: 'place_of_work' },
                      { data: 'contact_person', name: 'contact_person' },
                      { data: 'phone', name: 'phone' },
                      { data: 'email', name: 'email' },
                      { data: 'created_by', name: 'created_by' },
                      { data: 'signature', name: 'signature' },

                      {data: 'action', name: 'action', orderable: false, searchable: false},
                   ],

                  scrollX: true,   //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<         
                  // scrollY: 300,   //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
                  scrollCollapse: true,
                  responsive: true,
                  colReorder: false,
                  keys: true,
                  select: true,
                  
         });
      
    });



    $(document).ready(function () {
      
      

    

        $('#master').on('click', function(e) {
          // e.preventDefault();
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });

        $('.delete_all').on('click', function(e) {

            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  
            alert(allVals);
        });


      });

    function get_checked_value(type){
      var allVals = [];  
      var encoded_ids = [];
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
            encoded_ids.push($(this).attr('data-encoded-id'));
        });  
        if(allVals.length){
          if(type == 'edit'){
            window.location.href = "/admin/joblists/"+encoded_ids[0]+"/edit";
          }else if(type == 'delete'){

            alertify_func_post(encoded_ids,"{{ route('delete.joblists') }}")
            // alert(allVals);
          }else if(type == 'deublicate'){
            window.location.href = "/admin/joblists/create?id="+encoded_ids[0];
          }
        }
    }

    
  </script>
@endpush