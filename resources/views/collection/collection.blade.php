@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <div class="flex justify-between relative md:mb-4 mb-3  pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> Collections
            </h2>
         </div>
         @if (Auth::user()->hasRole('admin'))
            <a href="#" class="is_link featured-btn pull-right" data-toggle="modal" data-target="#addProductCollection"> Add Collection </a>         
         @endif
         <!-- Modal -->
         <div class="modal main-prod fade" id="addProductCollection" tabindex="-1" role="dialog" aria-labelledby="addProductCollectionLabel" aria-hidden="true">
            <form id="addProductCollectionForm" enctype="multipart/form-data" method="post">
               @csrf
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="addProductCollectionLabel">Add Collection</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="">Collection Name</label>
                              <input type="text" class="form-control" name="name" placeholder="Enter Collection Name">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="bsolute bottom-0 p-4 space-x-4 w-full">
                              <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
                                 <div class="lg:block hidden"> Add to your post </div>
                                 <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                                    <input type="file" id="product_collection_image" name="product_collection_image" style="visibility:hidden;" onchange="ValidateFileUpload('product_collection_image','output_product_collection_image');">
                                    <a href="#" onclick="$('#product_collection_image').trigger('click'); return false;">
                                    <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    </a>
                                    <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path>
                                    </svg>

                                 </div>
                              </div>
                              <img id="output_product_collection_image" />
                              
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" id="addProductCollectionBtn" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div>
         </div>
      </div>
      <div class="row first-page">
         @foreach ($collections as $collection)
            <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
               <a href="{{ route('collection.show', $collection->slug) }}">
                  <div class="overly">
                     <img src="{{ url("public/collection/$collection->feature_image") }}" class="w-full h-48 rounded-lg shadow-sm object-cover">
                     <div class="pt-2">
                        <h4 class="text-lg font-semibold">{{ $collection->name }}</h4>
                     </div>
                  </div>
               </a>
            </div>
         @endforeach
      </div>
   </div>
</div>
@endsection

@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
function ValidateFileUpload(fileId, previewId) {
     
      var fuData = document.getElementById(fileId);
      var FileUploadPath = fuData.value;

      //To check if user upload any file
      if (FileUploadPath == '') {
         // swal("", 'Please upload an image', "error", {
         //    button: "close",
         // });

      } else {
         var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
         //The file uploaded is an image

         if (Extension == "gif" || Extension == "png" || Extension == "bmp" ||
            Extension == "jpeg" || Extension == "jpg") {

            // To Display
            if (fuData.files && fuData.files[0]) {
               var reader = new FileReader();

               reader.onload = function(e) {
                  var output = document.getElementById(previewId);
                  output.style.height = '150px';
                  output.style.width = '150px';
                  output.style.padding = '10px';
                  output.src = e.target.result;
               }

               reader.readAsDataURL(fuData.files[0]);
            }

         }
         //The file upload is NOT an image
         else {
            swal("", 'Photo only allows file types of GIF, PNG, JPG, JPEG and BMP.', "error", {
               button: "close",
            });
         }
      }
   }

   $("#addProductCollectionForm").validate({      
      rules: {
         name: {
            required: true
         },
         product_collection_image: {
            required: true
         }
      },
      messages: {
         name: "Please enter category name",
         product_collection_image: "Please choose category image"
      },
      submitHandler: function(forms, e) {
         e.preventDefault();
         var form = $('#addProductCollectionForm')[0];
         var serializedData = new FormData(form);

         $("#addProductCollectionBtn").attr("disabled", true);
         $('#addProductCollectionBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
         $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route('collection.store') }}",
            data: serializedData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
               $("#addProductCollectionBtn").attr("disabled", false);

               $('#addProductCollectionBtn').html('Post');

               if (data.erro == '101') {
                  clearImage('output_simple_post_image');
                 
                  UIkit.modal('#addProductCollection').hide();

                  swal("", data.message, "success", {
                     button: "close",
                  });

                  $("#addProductCollectionForm").trigger('reset');
                  $('.swal-button--confirm').on('click', function(){
                     window.location.reload();
                  });
               } else {
                  swal("", data.message, "error", {
                     button: "close",
                  });
               }
            }
         });
         return false;
      }
   });

</script>
@endsection