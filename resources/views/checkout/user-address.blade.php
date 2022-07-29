<div class="add{{$form}}AddressForm d-none">
    <div class="row mt-2">
      <div class="col-sm-6">
         <label>First Name:</label>
         <div class="form-group">
            <input type="text" name="{{$form}}_first_name" value="" class="form-control form-control--sm">
         </div>
      </div>
      <div class="col-sm-6">
         <label>Last Name:</label>
         <div class="form-group">
            <input type="text" name="{{$form}}_last_name" value="" class="form-control form-control--sm">
         </div>
      </div>
    </div>
    <div class="row">     
      <div class="col-sm-6">
         <label>Phone no:</label>
         <div class="form-group">
            <input type="text" class="form-control form-control--sm" name="{{$form}}_phone" value="">
         </div>
      </div>
      <div class="col-sm-6">
         <label>zip/postal code:</label>
         <div class="form-group">
            <input type="text" class="form-control form-control--sm" name="{{$form}}_zip_code" value="">
         </div>
      </div>
   </div>   
    <div class="row mt-2">
        <div class="col-sm-6">
            <label>Country:</label>
            <div class="form-group select-wrapper" value="">
                <select class="form-control form-control--sm" name="{{$form}}_country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                      <option value="{{ $country->iso }}">{{ $country->name }}</option>
                    @endforeach                         
                </select>
            </div>            
        </div>
        <div class="col-sm-6">
        <label>City:</label>
           <div class="form-group">
              <input type="text" class="form-control form-control--sm" name="{{$form}}_city" value="">
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label>Address 1:</label>
            <div class="form-group">
              <input type="text" class="form-control form-control--sm" name="{{$form}}_address" value="">
            </div>
        </div>        
    </div>
   <div class="clearfix">
        <input id="formcheckoutCheckbox1" data-id="" name="{{$form}}_form" type="checkbox">
        <label class="t-labl" for="formcheckoutCheckbox1">Save address to my account</label>
   </div>
</div>