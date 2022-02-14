<div class="row">
	<div class="col-12">
		<h2>Profile</h2>
	</div>
	<div class="col-4">
		<div class="form-group">
	        <div class="uploadpic">
	            @php
	                $profile_image = !empty(auth()->user()->image) ? asset('storage/' . auth()->user()->image) : asset('assets/images/icon-profile.png');
	            @endphp
	            <img class="profile-image" src="{{ $profile_image }}" alt="profile" id="previewImg">
	            @if (auth()->user()->image == 'users/default.png')
	                @lang('messages.Upload Profile')<br>@lang('messages.photo')
	            @endif

	            <a href="javascript:void(0)" class="btnup">
	                <img src="{{ asset('assets/images/icon-camera.png') }}" alt="camera icon"
	                    onclick="changeImage()">
	            </a>
	            <input type="file" id="uploadImage" style="display: none" accept="image/*"
	                onchange="previewFile(this);">
	        </div>
	    </div>
	</div>
	<div class="col-8">
		
	</div>
</div>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('messages.Crop Image Before Upload')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
              <div class="row">
                  <div class="col-md-8">
                      <img src="" id="sample_image" />
                  </div>
                  <div class="col-md-4">
                      <div class="preview"></div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="crop" class="btn btn-primary">@lang('messages.Crop')</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.Cancel')</button>
        </div>
    </div>
  </div>
</div>

@push('js')

<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>

	<script type="text/javascript">
		$(document).ready(function(){

	      var $modal = $('#modal');

	      var image = document.getElementById('sample_image');

	      var cropper;

	      $('#uploadImage').change(function(event){
	        var files = event.target.files;

	        var done = function(url){
	          image.src = url;
	          $modal.modal('show');
	        };

	        if(files && files.length > 0)
	        {
	          reader = new FileReader();
	          reader.onload = function(event)
	          {
	            done(reader.result);
	          };
	          reader.readAsDataURL(files[0]);
	        }
	      });

	      $modal.on('shown.bs.modal', function() {
	        cropper = new Cropper(image, {
	          aspectRatio: 1,
	          viewMode: 3,
	          preview:'.preview'
	        });
	      }).on('hidden.bs.modal', function(){
	        cropper.destroy();
	          cropper = null;
	      });

	      $('#crop').click(function(){
	        canvas = cropper.getCroppedCanvas({
	          width:400,
	          height:400
	        });

	        canvas.toBlob(function(blob){
	          url = URL.createObjectURL(blob);
	          var reader = new FileReader();
	          reader.readAsDataURL(blob);
	          reader.onloadend = function(){
	            var base64data = reader.result;
	            $("#previewImg").attr("src", reader.result);
	            console.log(base64data);
	            
	            $.ajax({
	              // url:{{ url('upload-profile-image')}} ,
	              url:"{{ url('upload-profile-image')}} ",
	              method:'POST',
	              data:{uploaded_image:base64data},
	              // headers: {
	              //     'Access-Control-Allow-Origin': '*'
	              // },
	              // cache: false,
	              // contentType: false,
	              // processData: false,

	              // dataType: "json",

	              success:function(data)
	              {
	                $modal.modal('hide');
	                $('#uploaded_image').attr('src', data);
	              }
	            });
	          };
	        });
	      });
      
    });

	</script>
@endpush