@extends('layouts.app')
@section('content')
<div class="main_content order-h-d-p">
   <div class="mcontainer">
      <div class="flex justify-between relative md:mb-4 mb-3 border-b pb-3">
         <div class="flex-1">
            <h2 class="text-xl font-semibold"> My Orders
            </h2>
         </div>
         <div>
         </div>
      </div>
      <div class="">
         <div class="full-w">
            <div class="full-w ">
               <div class="job-list">
                  <!-- job 1 -->
                  <div class="job-details">
                     <div class="job-description">
                        <h3>  Delivery Address</h3>
                        <hr>
                        <div class="inner-info">
                           <div class="row">
                              <div class="col-sm-12">
                                 <h5 class="name">  John Doe</h5>
                                 <h4>2405  Augusta Park, Kingsport, Tennessee </h4>
                                 <h5 class="name">  434-4345-324</h5>
                              </div>
                              <div class="job-tags">
                                 <br><br>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- job 1 -->
                  <div class="job-details timeline-order">
                     <a href="job-details.html" class="job-logo">
                     <img src="{{ url('public/assets/images/tshrt.png') }}" alt="">
                     </a>
                     <div class="job-description">
                        <div class="inner-info">
                           <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-3">
                                 <h3>  White  Embroidered  T-shirt</h3>
                                 <h4>#3435456 </h4>
                                 <b class="color-black">$122.33</b>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-6">
                                 <ul class="timeline" id="timeline">
                                    <li class="li complete">
                                       <div class="timestamp">
                                          <span class="date">Tue, 14th Jul<span>
                                          </span></span>
                                       </div>
                                       <div class="status">
                                          <h4> Ordered</h4>
                                       </div>
                                    </li>
                                    <li class="li complete">
                                       <div class="timestamp">
                                          <span class="date">Wed, 15th Jul<span>
                                          </span></span>
                                       </div>
                                       <div class="status">
                                          <h4> Packed </h4>
                                       </div>
                                    </li>
                                    <li class="li complete">
                                       <div class="timestamp">
                                          <span class="date">Thu, 16th Jul<span>
                                          </span></span>
                                       </div>
                                       <div class="status">
                                          <h4>Shipped </h4>
                                       </div>
                                    </li>
                                    <li class="li">
                                       <div class="timestamp">
                                          <span class="date"><b>Fri, 16th Jul<b><span>
                                          </span></b></b></span>
                                       </div>
                                       <b>
                                          <b>
                                             <div class="status">
                                                <h4> Delivered </h4>
                                             </div>
                                          </b>
                                       </b>
                                    </li>
                                    <b><b>
                                    </b></b>
                                 </ul>
                                 <b><b>                   
                                 </b></b>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-3">
                                 <b>
                                    <b>
                                       <div class="job-tags">
                                          <h4>
                                             <div class="green-dot"></div>
                                             Delivered
                                             On Fri, 16th Jul 
                                          </h4>
                                       </div>
                                    </b>
                                 </b>
                              </div>
                              <b><b>
                              </b></b>
                           </div>
                           <b><b> </b></b>
                        </div>
                        <b><b> </b></b>
                     </div>
                     <b><b>
                     </b></b>
                  </div>
                  <b><b>
                  </b></b>
               </div>
               <b>
                  <b>
                     <!-- job 1 -->
                     <!-- job 1 -->
                  </b>
               </b>
            </div>
            <b><b>
            </b></b>
         </div>
         <b><b>
         </b></b>
      </div>
      <b><b>
      </b></b>
   </div>
   <b><b> </b></b>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"></script>
@endsection