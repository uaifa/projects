

@include('admin.partials.footer')

<div id="loader" class="lds-dual-ring hidden overlay"></div>

<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.min.js"></script>
 <!-- Bootstrap core JS-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets') }}/js/select2.min.js"></script>

<script src="{{ asset('assets') }}/js/alertify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


   <script type="text/javascript">
    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer {{ \Illuminate\Support\Facades\Session::get('token') }}',
            }
        });

   function alertify_func(id=0,url=''){
      alertify.confirm("@lang('messages.are_your_you_want_to_delete')",function(e){
            if(e) {

                $.ajax(
                {
                    url: url,
                    type: 'post',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE'
                    },
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response)
                    {
                        location.reload();
                        console.log("it Work");
                    }
                });

            } 
        }, function(e){
           // cancel case 
        }).setHeader("<em> @lang('messages.confirmation') </em> ").set('labels', {ok:"@lang('messages.yes')", cancel:"@lang('messages.cancel')"});

   }

   function alertify_func_post(id=0,url=''){
      alertify.confirm("@lang('messages.are_your_you_want_to_delete')",function(e){
            if(e) {

                $.ajax(
                {
                    url: url,
                    type: 'post',
                    dataType: "JSON",
                    data: {
                        "ids": id,
                    },
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response)
                    {
                        location.reload();
                    }
                });

            } 
        }, function(e){
           // cancel case 
        }).setHeader("<em> @lang('messages.confirmation') </em> ").set('labels', {ok:"@lang('messages.yes')", cancel:"@lang('messages.cancel')"});

   }

</script>
<script type="text/javascript" src="{{ asset('assets') }}/js/jquery.inputmask.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
    setTimeout(function() { 
        checkbox_click();
      }, 3000);

      
        function currency_format(currency = '$'){
            Inputmask.extendAliases({
            'myCurrency': {
                alias: 'numeric',
                prefix: currency+' ',
                // digits: 0,
                autoUnmask: true,
                removeMaskOnSubmit: true,
                unmaskAsNumber: true,
                allowPlus: false,
                allowMinus: false,
                autoGroup: true,
                groupSeparator: ",", 
            }
        });
    
        $(".currency").inputmask("myCurrency");
    }
        currency_format();

        var currency = '$';
        $('#currency').on('change', function(){
            currency = $(this).val();

            currency_format(currency);
        });

        
        $(".input-number").inputmask({
                alias: 'numeric',
                // prefix: '$ ',
                digits: 0,
                max: 10000,
                autoUnmask: true,
                removeMaskOnSubmit: true,
                unmaskAsNumber: true,
                allowPlus: false,
                allowMinus: true,
                autoGroup: true,
                groupSeparator: ",", 
            });
        
    });     


 

    function checkbox_click(){
        $('.sub_chk').on('click',function () {
         if ($('.sub_chk:checked').length == $('.sub_chk').length){
          $('#master').prop('checked',true);
         }
         else {
          $('#master').prop('checked',false);
         }
        });
    }


    // $(function() {
    //     $(".datepicker").datetimepicker({
    //         maxDate: moment(),
    //         allowInputToggle: true,
    //         enabledHours : false,
    //         locale: moment().local('en'),
    //         format: 'DD-MM-YYYY'
    //     });
    // });



    function TimePickerCtrl($) {
      var startTime = $('#starttime').datetimepicker({
        format: 'HH:mm'
      });
      
      var endTime = $('#endtime').datetimepicker({
        format: 'HH:mm',
        minDate: startTime.data("DateTimePicker").date()
      });
      
      function setMinDate() {
        return endTime
          .data("DateTimePicker").minDate(
            startTime.data("DateTimePicker").date()
          )
        ;
      }
      
      var bound = false;
      function bindMinEndTimeToStartTime() {
      
        return bound || startTime.on('dp.change', setMinDate);
      }
      
      endTime.on('dp.change', () => {
        bindMinEndTimeToStartTime();
        bound = true;
        setMinDate();
      });
    }

    $(document).ready(TimePickerCtrl);

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Select team",
                allowClear: true
            });
        });
    
   </script>

@notifyJs
 @stack('js')