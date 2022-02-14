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

      <h3>@lang('messages.packages')</h3>
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
                    <a class="dropdown-item" href="#!">
                      Export List
                    </a>
                  </li>
              </ul>
          </div>
          <a class="float-end ms-auto" href="{{ route('packages.create') }}"> <img src="{{ asset('assets') }}/images/icon-add.png"> </a>
      </div>
      <div class="row mb-5">
          <div class="col-md-12">
              <div class="white-box px-0">
                  <div class="table-responsive">
                      <table class="emp-table table" id="datatables-packages">
                        <thead>
                          <tr>
                              <th class="padding-left-10"><input type="checkbox" id="master"></th>
                              <th></th>
                              <th>@lang('messages.title')</th>
                             <th>@lang('messages.heading')</th>
                             <th>@lang('messages.sub_heading')</th>
                             <th>@lang('messages.package_name')</th>
                             <th>@lang('messages.currency')</th>
                             <th>@lang('messages.package_type_text')</th>
                             <th>@lang('messages.storage_place_size')</th>
                             <th>@lang('messages.button_text')</th>                 
                             <th>@lang('messages.duration')</th>
                             <th>@lang('messages.manager')</th>
                             <th>@lang('messages.users')</th>
                             <th>@lang('messages.support_text')</th>
                             <th>@lang('messages.storage_text')</th>
                             {{-- <th>created_by</th> --}}
                             <th>@lang('messages.price')</th>
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
      $('#datatables-packages').DataTable({

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
             ajax: "{{ route('packages.index') }}",
             columns: [
                      { 
                        data: 'id',
                        name: 'id',
                        // orderable: false,
                        orderable: false,
                        searchable: false,
                        "render": function(data, type, full, meta) {
                          
                            return `<input type="checkbox" class="sub_chk" data-encoded-id="`+full.encoded_id+`" data-id="`+full.id+`">`;
                        }
                      },
                      { 
                        data: 'icon', name: 'icon',
                        render: function(data, type, full, meta) {
                          if(data){
                            return "<img class='border-radius-50' src={{ asset('') }}" + data +
                                "\ width=\"50\"/>";
                          }else{
                            return '';
                          }
                        }  
                      },
                      { data: 'title', name: 'title' },

                      { data: 'heading', name: 'heading' },
                      { data: 'sub_heading', name: 'sub_heading' },
                      { data: 'package_name', name: 'package_name' },
                      { data: 'currency', name: 'currency' },
                      { data: 'package_type_text', name: 'package_type_text' },
                      { data: 'storage_place_size', name: 'storage_place_size' },
                      { data: 'button_text', name: 'button_text' },
                      { data: 'duration', name: 'duration' },
                      
                      { data: 'manager', name: 'manager' },
                      { data: 'users', name: 'users' },
                      { data: 'support_text', name: 'support_text' },
                      { data: 'storage_text', name: 'storage_text' },
                      // { data: 'user.name', name: 'user.name' },
                      
                      { data: 'price', name: 'price' },
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
            window.location.href = "/admin/packages/"+encoded_ids[0]+"/edit";
          }else if(type == 'delete'){

            alertify_func_post(encoded_ids,"{{ route('delete.packages') }}")
            // alert(allVals);
          }else if(type == 'deublicate'){
            window.location.href = "/admin/packages/create?id="+encoded_ids[0];
          }
        }
    }


  </script>
@endpush