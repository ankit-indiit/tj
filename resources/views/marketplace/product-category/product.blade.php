@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              {{ str_replace('-', ' ', ucfirst(Request::segment(2))) }}
            </li>
         </ol>
      </nav>
      <div class="my-2 flex items-center justify-between pb-3">
         <div>
            <h2 class="text-xl font-semibold"> Products</h2>
         </div>
         @if (Auth::user()->hasRole('admin') || Auth::user()->switch_as == 'seller')
           <div>
             <a href="javascript:void(0);" uk-toggle="target: #add-product-category-modal" class="is_link featured-btn pull-right mx-1"> Add Category </a>
           </div>
         @endif
      </div>
      <hr>      
      <div class="row">
         <div class="col-lg-12">
            <div class="relative">
               <div class="uk-slider-container px-1 py-3">
                  <div class="row">
                     @foreach ($products as $product)
                        @php
                           $unSerlizeProImage = unserialize($product->image);
                           $productImage = reset($unSerlizeProImage);
                        @endphp
                        <div class="col-sm-3">
                           <div class="card">
                              <div class="card-media h-44">
                                 <div class="card-media-overly"></div>
                                 <img src="{{ url("public/images/product/$productImage") }}" alt="">
                                 <{{-- div class="product-list"> 
                                    <label class="cont">
                                    <input type="checkbox" class="checkme">
                                    <span class="checkmark"></span>
                                    </label>
                                 </div> --}}
                              </div>
                              <div class="card-body">
                                 <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate"> {{ $product->name }} </a>
                                 <div class="text-xs font-semibold uppercase text-yellow-500">${{ $product->discounted_price }}</div>
                                 <div class="text-xs font-semibold ven-nam text-yellow-500">
                                    @foreach ($product->productCategoryId as $proCatId)
                                       <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">
                                          {{ getProductCategoryNameById($proCatId->cat_id) }}
                                       </a>
                                    @endforeach
                                 </div>
                                 <div class="ratings">
                                    {!! @showProductRating($product->id) !!}
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('customModals')
{{-- Add Product Category Modal --}}
<div id="add-product-category-modal" class="create-post main-post" uk-modal>
   <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
      <div class="text-center py-4 border-b">
         <h3 class="text-lg font-semibold">Add Category</h3>
         <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
      </div>
      <form id="addProductCategoryForm" enctype="multipart/form-data" method="post">
        @csrf
        <div class="flex flex-1 items-start space-x-4 p-5">
            <div class="flex-1 pt-2 small-textarea">
               <textarea name="name" id="name" class="uk-textare text-black shadow-none focus:shadow-none text-xl font-medium resize-none" rows="5" placeholder="Enter Category Name"></textarea>
            </div>
         </div>                   
         <div class="bsolute bottom-0 p-4 space-x-4 w-full">
            <div class="flex bg-gray-50 border border-purple-100 rounded-2xl p-3 shadow-sm items-center">
               <div class="lg:block hidden"> Add Category Image </div>
               <div class="flex flex-1 items-center lg:justify-end justify-center space-x-2">
                  <input type="file" id="feature_image" name="feature_image" style="visibility:hidden;" onchange="ValidateFileUpload('feature_image','product_category_image');">
                  <a href="#" onclick="$('#feature_image').trigger('click'); return false;">
                  <svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  </a>

               </div>
            </div>
            <img id="product_category_image" />
         </div>
         <div class="flex items-center w-full justify-between p-3 border-t">
            <div class="flex space-x-2 pull-right">
               <button type="submit" id="addProductCategoryBtn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                  Add
               </button>
               <a href="javascript:void(0);" onclick="hideCurrentOpenModal('add-product-category-modal');" class="bg-red-100 flex font-medium h-9 items-center justify-center px-5 rounded-md text-red-600 text-sm">
                  Cancel </a>
            </div>
         </div>
      </form>
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
$("#addProductCategoryForm").validate({
  rules: {
     name: {
        required: true
     },
     feature_image: {
        required: true
     }
  },
  messages: {
     name: "Please enter category name",
     feature_image: "Please choose category image"
  },
  submitHandler: function(forms, e) {
     e.preventDefault();
     var form = $('#addProductCategoryForm')[0];
     var serializedData = new FormData(form);
    
     $("#addProductCategoryBtn").attr("disabled", true);
     $('#addProductCategoryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
     $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        enctype: 'multipart/form-data',
        url: "{{ url('add-product-category') }}",
        data: serializedData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
           $("#addProductCategoryBtn").attr("disabled", false);

           $('#addProductCategoryBtn').html('Post');

           if (data.erro == '101') {
              clearImage('product_category_image');
             
              UIkit.modal('#add-product-category-modal').hide();

              swal("", data.message, "success", {
                 button: "close",
              });

              $("#addProductCategoryForm").trigger('reset');
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