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
      <h3>@lang('messages.clients')</h3>
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
          <a class="float-end ms-auto" href="{{ route('clients.create') }}"> <img src="{{ asset('assets') }}/images/icon-add.png"> </a>
      </div>
      <div class="row mb-5">
          <div class="col-md-12">
              <div class="white-box px-0">
                  <div class="table-responsive">
                      <table class="emp-table table" id="datatables-clients">
                        <thead>
                          <tr>
                              <th class="padding-left-10"><input type="checkbox" id="master"></th>
                              <th>@lang('messages.company')</th>
                               <th>@lang('messages.first_name')</th>
                               <th>@lang('messages.last_name')</th>
                               <th>@lang('messages.email')</th>
                               <th>@lang('messages.street')</th>
                               <th>@lang('messages.house_no')</th>
                               <th>@lang('messages.zip_code')</th>
                               <th>@lang('messages.town')</th>
                               <th>@lang('messages.telephone')</th>
                               <th>@lang('messages.branch')</th>
                              <th>&nbsp;</th>
                          </tr>
                        </thead>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>


@push('js')
@include('admin.partials.datatables_js')

  <script type="text/javascript">
    $(document).ready( function () {
      $('#datatables-clients').DataTable({

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
             ajax: "{{ route('clients.index') }}",
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
                      { data: 'company', name: 'company' },
                      { data: 'first_name', name: 'first_name' },
                      { data: 'last_name', name: 'last_name' },
                      { data: 'email', name: 'email' },
                      { data: 'street', name: 'street' },
                      { data: 'house_no', name: 'house_no' },
                      { data: 'zip_code', name: 'zip_code' },
                      { data: 'town', name: 'town' },
                      { data: 'telephone', name: 'telephone' },
                      { data: 'branch', name: 'branch' },
                      {data: 'action', name: 'action', orderable: false, searchable: false},
                   ],

                  scrollX: true,   //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<         
                  // scrollY: 300,   //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
                  scrollCollapse: true,
                  responsive: true,
                  colReorder: false,
                  keys: true,
                  select: true
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
            window.location.href = "/admin/clients/"+encoded_ids[0]+"/edit";
          }else if(type == 'delete'){

            alertify_func_post(encoded_ids,"{{ route('delete.clients') }}")
            // alert(allVals);
          }else if(type == 'deublicate'){
            window.location.href = "/admin/clients/create?id="+encoded_ids[0];
          }
        }
    }


  </script>
@endpush