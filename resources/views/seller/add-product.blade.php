@extends('layouts.app')
@section('content')
<div class="main_content timeline-page">
   <div class="mcontainer">
      <div class="profile user-profile bg-white rounded-2xl -mt-4">
         <div class="profiles_banner">
            <img id="coverImageUpdate" src="{{ url('public/profile/cover/') }}/{{ Auth::user()->cover_image ? Auth::user()->cover_image : 'download.png' }}" alt="" />
            <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex">
               <a href="javascript:void(0);" onclick="coverImageForm();" class="flex items-center justify-center h-8 px-3 rounded-md bg-gray-700 bg-opacity-70 text-white space-x-1.5">
                  <ion-icon name="create-outline" class="text-xl md hydrated" role="img" aria-label="create outline"></ion-icon>
                  <span> Edit </span>
               </a>
            </div>
         </div>
         <div class="profiles_content">
            <div class="profile_avatar">
               <div class="profile_avatar_holder">
                  <img class="user_profile_image" src="{{ show_user_image() }}" alt="" />
               </div>
               <!--div class="user_status status_online"></div-->
               <div class="icon_change_photo" onclick="profileImageForm();">
                  <ion-icon name="create-outline" class="text-xl md hydrated" role="img" aria-label="camera"></ion-icon>
               </div>

            </div>

            <div class="profile_info">
               <h1>{{ Auth::user()->name }}</h1>

            </div>
         </div>
      </div>
      <div class="row mt-4 main-pr">
         <div class="col-lg-12 col-sm-12">
            <form action="#" id="addProductForm" class="" method="post" >
                  <div class="col-lg-12">
                     <div class="d-flex align-items-center justify-content-between">
                        <h4 class="text-xl mb-3 font-semibold">Add Product</h4>
                        <a href="#" class="btn btn-primary pull-right  mb-3 bctp" uk-toggle="target: #add-product-attribute-modal">Product Attributes</a>
                        <a href="{{ route('my-profile') }}?tab=product" class="btn btn-primary pull-right  mb-3 bctp">Back To Products</a>
                     </div>
                  </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="">Categories</label>                        
                        <select class="selectpicker1" id="selectedCategoryId" multiple="" name="category_id[]" id="selectedProductCategory">
                           @foreach (getAllProductCagetories() as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               
                  <div class="col-lg-6 d-none" id="subCatDiv">
                     <div class="form-group">
                        <label for="">Sub Categories</label>
                        <select class="form-control" id="subCategory" name="sub_category_id[]">
                           
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter Price">
                     </div>
                  </div> 
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="">Discounted Price</label>
                        <input type="text" class="form-control" name="discounted_price" placeholder="Enter Discounted Price">
                     </div>
                  </div>                                                
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="text" class="form-control" name="quantity" placeholder="Enter Quantity">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="">Delivery Cost</label>
                        <input type="text" class="form-control" name="delivery_cost" placeholder="Enter Delivery Cost">
                     </div>
                  </div>
                  @foreach (getAllProductAttributes() as $productAttr)
                     @php
                        $productAttrOptions = explode("|", $productAttr->option);
                     @endphp                     
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="">{{$productAttr->name}}</label>
                           <select class="form-control selectpicker1" multiple="" name="product_attr[{{ strtolower($productAttr->name) }}][]">
                              @foreach ($productAttrOptions as $productAttrOption)
                                 <option value="{{ strtolower($productAttrOption) }}">{{ $productAttrOption }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  @endforeach                  
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="">Collection</label>                        
                        <select class="form-control selectpicker1" multiple="" name="product_collection[]">
                          @foreach ($productCollections as $productCollection)
                            <option value="{{ $productCollection->id }}">{{ $productCollection->name }}</option>
                          @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="">Add Description</label>
                        <textarea class="form-control" style="height: 90px" placeholder="Add Description" name="description" rows="5"></textarea>
                     </div>
                  </div>
                <div class="col-lg-12">
                  <div action="{{url('/upload-product-files')}}" id="myDropzone" class="dropzone pictures_dropzone cs-upload" style="color:red;">
                       <div class="dz-message" data-dz-message>
                           <i class="fa fa-cloud-upload"></i>
                           <span class="cs-msg">Upload Product images here..</span>
                       </div>
                       <div class="fallback">
                           <input name="uplod-img" id="uplod-img" type="file" multiple />
                       </div>
                  </div>
                </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="">Status</label>
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="product_status" id="customCheck1">
                           <label class="custom-control-label" for="customCheck1">Active</label>
                        </div>
                     </div>
                  </div>
               
                  <div class="col-12 text-left">
                     <button type="submit" id="addProductBtn" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Add Product</button>
                     <button type="button" class="btn btn-secondary gray" data-dismiss="modal">Cancel</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>

   <div id="add-product-attribute-modal" class="create-post main-post" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical rounded-lg p-0 lg:w-5/12 relative shadow-2xl uk-animation-slide-bottom-small">
         <div class="text-center py-4 border-b">
            <h3 class="text-lg font-semibold">Add Product Attributes</h3>
            <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 m-1 right-2" type="button" uk-close uk-tooltip="title: Close ; pos: bottom ;offset:7"></button>
         </div>
         <form id="addProductAttrForm" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mx-4 my-4">
               <input type="text" class="form-control border" placeholder="Enter attribute name" name="name">
            </div>
            <div class="mx-4 my-4">
               <input type="text" class="form-control border" placeholder="Enter attribute value sepreated by XL | L | M" name="option">
               {{-- <p class="text-danger px-4">Enter attribute value sepreated by "XL | L | M"</p> --}}
            </div>
            <div class="mx-4 my-4">
               <button type="submit" id="addProductAttrBtn" class="form-control">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<script type="text/javascript">
var all_uploaded_files=[];
Dropzone.options.myDropzone = {
  url: _baseURL +"/upload-product-files",
  acceptedFiles: ".jpeg,.jpg,.png,.gif",

  addRemoveLinks: true,
 removedfile: function(file) {
     const index = all_uploaded_files.findIndex(img => img.orignalName === file.name)
     all_uploaded_files.splice(index,1);
     var _ref;
     return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
 },
  // maxFiles: 1,

  error: function(file, response){
     if(response == 'Upload canceled.'){
         swal("Error!", 'Please increase maxmum number of images limit.', "error");
     }else{
         swal("Error!", "Some error occured. Please try again." , "error");  
     }
     Dropzone.forElement('#myDropzone').removeFile(file);
  },
  success: function(file, response){
        var res = JSON.parse(response);
        if(res.status == 1){
            var img_index = all_uploaded_files.length;
            all_uploaded_files.push({
                orignalName: file.name,
                image_name : res.image_name,
                caption : '',
                is_cover : img_index == 0 ? '1' : '0'
            });
        }
    }
};



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
$(document).on('change', '#selectedCategoryId', function(){
   var selectCategory = $('#selectedCategoryId').val();
    $.ajax({        
      type: 'get',
      url: _baseURL + "/get-sub-cat",
      data: { selectCategory: selectCategory },
      success: function (data) {
         if (data.id) {
          $('#subCatDiv').removeClass('d-none');
          $("#subCategory").append("<option value='"+data.id+"' selected>"+data.name+"</option>");         
         }
      }
   });
});

$(".selectpicker1").chosen();
$(".productColorAttr").chosen();
$(".productSizeAttr").chosen();
$("#addProductForm").validate({
  rules: {
     name: {
        required: true
     },
     category_id: {
        required: true,
     },
     sub_category_id: {
        required: true
     },
     price: {
        required: true
     },
     size: {
        required: true
     },
     color: {
        required: true
     },
     quantity: {
        required: true
     },
     delivery_cost: {
        required: true
     },
     collection_id: {
        required: true
     },
     description: {
        required: true
     },
     file: {
        required: true
     }
  },
  messages: {
      name: "Please enter category name",
      category_id: "Please choose category",
      sub_category_id: "Please choose sub category",
      price: "Please enter price",
      size: "Please chosen price",
      color: "Please choose color",
      quantity: "Please enter quantity",
      delivery_cost: "Please enter delivery cost",
      collection_id: "Please choose collection",
      description: "Please enter description",
      file: "Please select product image",
  },
  submitHandler: function(forms, e) {
     e.preventDefault();
     var form = $('#addProductForm')[0];
     var serializedData = new FormData(form);
    serializedData.append('product_images', JSON.stringify(all_uploaded_files));
    
    
     $("#addProductBtn").attr("disabled", true);
     $('#addProductBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
     $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        enctype: 'multipart/form-data',
        url: "{{ route('product.store') }}",
        data: serializedData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
            console.log(data);
           $("#addProductBtn").attr("disabled", false);

           $('#addProductBtn').html('Post');

           if (data.erro == '101') {
              swal("", data.message, "success", {
                 button: "close",
              });

              $("#addProductForm").trigger('reset');
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

$("#addProductAttrForm").validate({
  rules: {
     name: {
        required: true
     },
     option: {
        required: true
     }
  },
  messages: {
      size: "Please enter product name",
      color: "Please enter name option"      
  },
  submitHandler: function(forms, e) {
     e.preventDefault();
     var form = $('#addProductAttrForm')[0];
     var serializedData = new FormData(form);
    
     $("#addProductAttrBtn").attr("disabled", true);
     $('#addProductAttrBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
     $.ajax({
        headers: {
           'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        enctype: 'multipart/form-data',
        url: "{{ route('product-attr.store') }}",
        data: serializedData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
            console.log(data);
           $("#addProductAttrBtn").attr("disabled", false);

           $('#addProductAttrBtn').html('Post');

           if (data.erro == '101') {
              swal("", data.message, "success", {
                 button: "close",
              });

              $("#addProductAttr").trigger('reset');
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