@push('css')
  @include('admin.partials.datatables_css')

  <style type="text/css">
    table{
      width: 100% !important;
    }
    .emp-table tr{
      border-bottom: solid 1px #707070;
    }

    /*Hidden class for adding and removing*/
    .lds-dual-ring.hidden {
        display: none;
    }

    /*Add an overlay to the entire page blocking any further presses to buttons or other elements.*/
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0,0,0,.8);
        z-index: 999;
        opacity: 1;
        transition: all 0.5s;
    }
     
    /*Spinner Styles*/
    .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 5% auto;
        border-radius: 50%;
        border: 6px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

  </style>
@endpush

<!-- Page content-->
  <div class="container">

      <h3>@lang('messages.staff_members')</h3>
      <div class="addnew d-inline-block w-100">
          <div class="filter-tags float-start">
              <span class="icn-fill">Supports <a href=""><img src="{{ asset('assets') }}/images/icon-cross.png"></a></span>
              <span class="icn-fill">Zurich <a href=""><img src="{{ asset('assets') }}/images/icon-cross.png"></a></span>
              <span class="icn-fill">Coop Food <a href=""><img src="{{ asset('assets') }}/images/icon-cross.png"></a></span>
              <span class="icn-no-fill">Name <a href=""><img src="{{ asset('assets') }}/images/icon-arrow-down.png"></a></span>
          </div>
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
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Import List
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('export.export') }}">
                      Export List
                    </a>
                  </li>
              </ul>
          </div>
          <a class="float-end ms-auto" href="{{ route('staff-members.create') }}"> <img src="{{ asset('assets') }}/images/icon-add.png"> </a>
      </div>
      <div class="row mb-5">
          <div class="col-md-12">
              <div class="white-box px-0">
                  <div class="table-responsive">
                      <table class="emp-table table" id="datatables-staff-members">
                        <thead>
                          <tr>
                              <th class="padding-left-10"><input type="checkbox" id="master"></th>
                              <th></th>
                              <th>@lang('messages.surname') </th>
                              <th>@lang('messages.name')</th>
                              <th>@lang('messages.team')</th>
                              <th>@lang('messages.telephone')</th>
                              <th>@lang('messages.user_name') </th>
                              <th>&nbsp;</th>
                          </tr>
                        </thead>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>



  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('messages.import_staff_members')</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="" id="upload_csv_file" enctype="multipart/form-data">
            @csrf
      <div class="modal-body">
        
            <div class="form-group">
              <label for="">@lang('messages.import_file')</label><br><br>
              <input type="file" name="import_file" id="import_file" accept="image/csv">
            </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('messages.close')</button>
        <button type="submit" class="btn btn-primary">@lang('messages.import')</button>
      </div>
       </form>
    </div>
  </div>
</div>



@push('js')

  @include('admin.partials.datatables_js')

  <script type="text/javascript">
    $(document).ready( function () {
      var i = 1;
      $('#datatables-staff-members').DataTable({

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
              // dom: 'Bfrtip',
              // buttons: [
              //     'copyHtml5',
              //     'excelHtml5',
              //     'csvHtml5',
              //     'pdfHtml5'
              // ],
             ajax: "{{ route('staff-members.index') }}",
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
                        data: 'profile_image', name: 'profile_image',
                        render: function(data, type, full, meta) {
                          if(data){
                            return "<img class='border-radius-50' src={{ asset('') }}" + data +
                                "\ width=\"50\"/>";
                          }else{
                            return `<img class='border-radius-50' src="{{ asset('assets/images/user.png') }}" width="50">`;
                            
                          }
                        }  
                      },
                      { data: 'first_name', name: 'first_name' },
                      { data: 'last_name', name: 'last_name' },
                      { 
                        data: 'teams', name: 'teams',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta){
                          if(data[0]){
                            return data[0].name;
                          }
                          return '';
                        }
                      },
                      { 
                        data: 'phone_number', name: 'phone_number',
                        render: function(data, type, full, meta){
                          return full.phone_number +' - '+ full.mobile_number;
                        } 

                      },
                      { data: 'email', name: 'email' },
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
            window.location.href = "/admin/staff-members/"+encoded_ids[0]+"/edit";
          }else if(type == 'delete'){

            alertify_func_post(encoded_ids,"{{ route('delete.staff.members') }}")
            // alert(allVals);
          }else if(type == 'deublicate'){
            window.location.href = "/admin/staff-members/create?id="+encoded_ids[0];
          }
        }
    }


    $(document).ready(function (e) {
      
       $("#upload_csv_file").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
               url: "{{ route('upload.import.csv') }}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
               cache: false,
         processData:false,
         beforeSend: function (request) {
             $('#loader').removeClass('hidden');
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
          //$("#preview").fadeOut();
          $("#err").fadeOut();
         },
          success: function(data){
            $('#loader').addClass('hidden');
            location.reload();
          },
           error: function(e) 
            {
          $("#err").html(e).fadeIn();
            }          
          });
       }));
      });

  </script>














@endpush