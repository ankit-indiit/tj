@extends('layouts.app')
@section('content')
<div class="main_content order-his oredr-pag">
   <div class="mcontainer">
      <div class="flex justify-between relative md:mb-4 mb-3 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold d-inline"> All Orders
            </h2>
            <div class="filter-select pull-right d-inline m-all">
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter value
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                     <ul class="space-y-1">
                        <li> 
                           <label class="cont">Unprocessed Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Open Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Delivered  Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Accepted   Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                        <li> 
                           <label class="cont">Rejected    Orders
                           <input type="checkbox">
                           <span class="checkmark"></span>
                           </label>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div>
         </div>
      </div>
      <div class="full-w">
         <div class="full-w">
            <div class="sel-ord">
               <div class="job-list">
                  <h4>Your order has been placed successfully</h4>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection