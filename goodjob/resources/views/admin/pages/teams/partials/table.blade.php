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
      <h3>@lang('messages.teams')</h3>
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
          <a class="float-end ms-auto" href="{{ route('teams.create') }}"> <img src="{{ asset('assets') }}/images/icon-add.png"> </a>
      </div>
      <div class="row mb-5">
          <div class="col-md-12">
              <div class="white-box px-0">
                  <div class="table-responsive">
                      <table class="emp-table table" id="datatables-teams">
                        <thead>
                          <tr>
                              <th class="padding-left-10"><input type="checkbox" id="master"></th>
                              <th>@lang('messages.name')</th>
                              <th>@lang('messages.address')</th>
                              <th>@lang('messages.city')</th>
                              <th>@lang('messages.country')</th>
                              <th>@lang('messages.zip_code')</th>
                              <th>@lang('messages.description')</th>

                              <th>@lang('messages.status')</th>
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
      $('#datatables-teams').DataTable({

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
             ajax: "{{ route('teams.index') }}",
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
                      { data: 'address', name: 'address' },
                      { data: 'city', name: 'city' },
                      { data: 'country', name: 'country' },
                      { data: 'zip_code', name: 'zip_code' },
                      { data: 'description', name: 'description' },
                      { 
                        data: 'status', name: 'status',
                        render: function(data, type, full, meta) {
                            return data == 1 ? 'Active' : 'Inactive';
                        } 
                      },

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
            window.location.href = "/admin/teams/"+encoded_ids[0]+"/edit";
          }else if(type == 'delete'){

            alertify_func_post(encoded_ids,"{{ route('delete.teams') }}")
            // alert(allVals);
          }else if(type == 'deublicate'){
            window.location.href = "/admin/teams/create?id="+encoded_ids[0];
          }
        }
    }

  </script>
@endpush