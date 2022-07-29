<div class="row mt-4">
   <div class="col-12">
      <h4 class="text-2xl mb-3 font-semibold">About</h4>
        
        <span id="err_mess" style="color: red;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
	    <span id="succes_mess" style="color: green;font-weight: 700;padding: 5px 5px 5px 5px;"></span>
        <form method="POST" action="{{ url('update-profile') }}" id="updateProfileForm">
                @csrf
          <div class="name-info">
             <div class="row">
                <div class="col-sm-1">
                    <i class="fas fa-user"></i> 
                </div>
                <div class="col-sm-10 pull-right">
                    <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
                </div>
             </div>
          </div>
          <div class="name-info">
             <div class="row">
                <div class="col-sm-1">
                   <i class="fa fa-envelope" aria-hidden="true"></i>
                </div>
                <div class="col-sm-10 pull-right">
                   <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
                </div>
             </div>
          </div>

          <div class="name-info">
             <div class="row">
                <div class="col-sm-1">
                   <i class="fa fa-phone" aria-hidden="true"></i>
                </div>
                <div class="col-sm-10 pull-right">
                    <input id="phone" type="tel" name="phone" value="{{ Auth::user()->phone_no }}" style="padding-left: 52px  !important;">
                    <input type="hidden" id="country_code" name="country_code" value="{{ Auth::user()->country_code }}"/>
                </div>
             </div>
          </div>
          
            <div class="row">
              <div class="col-sm-12">
                    <button type="submit" id="upd_profile_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        {{ __('Save Changes') }}
                    </button>
                 
                    <a href="{{ url('my-profile') }}" class="flex text-center items-center justify-center gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        Cancel
                    </a>
              </div>
           </div>
         </form>    
   </div>
</div>
<div class="row mt-4">
   <div class="col-12">
      <h4 class="text-xl mb-3 font-semibold">Addresses</h4>

      <div class="name-info" id="addressList">
        
         @if(count($address) > 0)

         @foreach($address as $addr)
         <div id="editAddress_{{ $addr->id }}">
         <div class="row" style="margin-top: 14px;">
            <div class="col-sm-12"><span class="badge badge-secondary">{{  $addr->title }}</span></div>
         </div>
         <div class="row">
            <div class="col-sm-4">
               <a href="#" class="name-fld"><b>{{  $addr->first_name }} {{  $addr->last_name }}</b></a>
            </div>
            <div class="col-sm-8 pull-right">
               <a href="#" class="pull-right" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
               <div
                  class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop"
                  uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small"
               >
                  <ul class="space-y-1">
                     <li></li>
                     <li>
                        <a href="javascript:void(0);"  onclick="openEditAddressModal({{ $addr->id }})" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800"> <i class="uil-edit-alt mr-1"></i> Edit Address </a>
                     </li>

                     <li>
                        <hr class="-mx-2 my-2 dark:border-gray-800" />
                     </li>
                     <li>
                        <a href="javascript:void(0);" onclick="deleteAddress({{ $addr->id }})" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"> <i class="uil-trash-alt mr-1"></i> Delete </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-sm-4">
               <a href="javascript:void(0);" class="name-fld">{{  $addr->phone_no }}</a>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-4">
               <a href="javascript:void(0);" class="name-fld">{{  $addr->Address }}, {{  $addr->nicename }}</a>
            </div>
         </div>
         <hr />
       </div>
        
         
         
         @endforeach
         @endif


      </div>
   </div>
</div>
<div id="accordion">
   <div class="card">
      <div class="card-header" id="headingOne">
         <h5 class="mb-0">
            <button id="addAddressButton" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa-plus"></i> Add a New Address</button>
         </h5>
      </div>

      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
         <div class="card-body">

            <form method="POST" action="{{ url('add-address') }}" id="addAddressForm" > 
            @csrf
            <div class="row">
               <div class="col-sm-12">
                  <div class="profile-inp">
                     <input type="text"  name="address_title" class="form-control" id="address_title"  placeholder="Enter Address Title here" />
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="profile-inp">
                     <input type="text"  name="address_first_name" class="form-control" id="address_first_name"  placeholder="Enter Your First Name" />
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="profile-inp">
                     <input type="text" name="address_last_name" class="form-control" id="address_last_name"  placeholder="Enter Your Last Name" />
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="profile-inp">
                     <input type="text" class="form-control" id="address_pincode" name="address_pincode"  placeholder="Pincode" />
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="profile-inp">
                     <input type="text" class="form-control" name="address_locality" id="address_locality"  placeholder="Locality" />
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="profile-inp">
                     <textarea class="form-control" id="address_address" name="address_address" rows="2" placeholder="Address"></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="profile-inp">
                     <input type="text" class="form-control" id="address_city" name="address_city"   placeholder="City" />
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="profile-inp">
                     <select name="address_country" class="form-control" id="address_country" placeholder="Country">
                        <option value="">-Country-</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" >{{ $country->name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="profile-inp">
                     <input type="text" name="address_landmark" class="form-control" id="address_landmark"  placeholder="Landmark(optional)" />
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="profile-inp">
                        <input id="address_phone" type="tel" name="address_phone" style="padding-left: 52px  !important;">
                        <input type="hidden" id="address_country_code" name="address_country_code" />
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                   <button type="submit" id="add_address_btn" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        {{ __('Save Changes') }}
                    </button>
                 
                    <a href="{{ url('my-profile') }}" class="flex text-center items-center justify-center gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        Cancel
                    </a>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>

   <!----div class="row mt-4">
      <div class="col-12">
         <h4 class="text-xl mb-3 font-semibold">Saved Cards</h4>

         <div class="name-info">
            <div class="row">
               <div class="col-sm-4">
                  <a href="#" class="name-fld"><b>State Bank of India Debit Card</b></a>
               </div>
               <div class="col-sm-8 pull-right">
                  <a href="#" class="pull-right" aria-expanded="false"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                  <div
                     class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop"
                     uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small"
                  >
                     <ul class="space-y-1">
                        <li></li>
                        <li>
                           <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800"> <i class="uil-edit-alt mr-1"></i> Edit Address </a>
                        </li>

                        <li>
                           <hr class="-mx-2 my-2 dark:border-gray-800" />
                        </li>
                        <li>
                           <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600"> <i class="uil-trash-alt mr-1"></i> Delete </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-sm-4">
                  <a href="#" class="name-fld">232-43434-323</a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div id="accordion">
      <div class="card">
         <div class="card-header" id="headingtwo">
            <h5 class="mb-0">
               <button class="btn btn-link" data-toggle="collapse" data-target="#collapsetne" aria-expanded="true" aria-controls="collapsetne"><i class="fa-plus"></i> Add a new Card</button>
            </h5>
         </div>

         <div id="collapsetne" class="collapse" aria-labelledby="headingtwo" data-parent="#accordion">
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Card Number" />
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="profile-inp">
                        <select class="form-control" id="exampleFormControlSelect1">
                           <option>MM</option>
                           <option></option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="profile-inp">
                        <select class="form-control" id="exampleFormControlSelect1">
                           <option>YY</option>
                           <option></option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name on Card" />
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="profile-inp">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name this card for future use" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <a href="timeline-page.html" class="flex text-center items-center justify-center w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        Save Changes
                     </a>
                     <a href="{{ url('profile') }}" class="flex text-center items-center justify-center gray-bg w-16 h-9 px-4 rounded-md bg-gray-200 font-semibold">
                        Cancel
                     </a>
                  </div>
               </div>


            </div>
         </div>
      </div>
   </div--->
</div>
       