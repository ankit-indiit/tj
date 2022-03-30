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
                  <!-- job 1 -->
                  <div class="job-detai ">
                     <div class="main-head">
                        <div class="row">
                           <div class="col-sm-2">
                              <h3>ORDER PLACED</h3>
                              <h6>16 july 2021</h6>
                           </div>
                           <div class="col-sm-6">
                              <h3>TOTAL</h3>
                              <h6>$ 6.99</h6>
                           </div>
                           <div class="col-sm-4 text-right">
                              <h3>ORDER #DFR-4546567677</h3>
                              <h6><a href="">View order details</a> <a href="">Invoice</a></h6>
                           </div>
                        </div>
                     </div>
                     <div class="maind-bgf">
                        <div class="row">
                           <div class="col-sm-9">
                              <div class="job-details">
                                 <a href="job-details.html" class="job-logo">
                                 <img src="{{ url('public/assets/images/tshrt.png') }}" alt="">
                                 </a>
                                 <div class="job-description">
                                    <div class="inner-info">
                                       <div class="">
                                          <h3>  White  Embroidered  T-shirt</h3>
                                          <h4>Forever 21</h4>
                                          <!--h4>#3435456 </h4-->
                                       </div>
                                       <div class="job-tags">
                                          <br><br>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <p class="payment-details yellow">Pending</p>
                              <div class="ac-bt"><a class="accet-green" href="">Accept</a> <a class="accet-red" href="">Reject</a>
                              </div>
                              <div class="right">
                                 <a class="filters" href="{{ route('order.history-detail') }}" aria-expanded="false">
                                 View Order Details</a><br>
                              </div>
                           </div>
                        </div>
                        <div class="row"> </div>
                     </div>
                  </div>
                  <!-- job 1 -->
                  <div class="job-detai ">
                     <div class="main-head">
                        <div class="row">
                           <div class="col-sm-2">
                              <h3>ORDER PLACED</h3>
                              <h6>15 july 2021</h6>
                           </div>
                           <div class="col-sm-6">
                              <h3>TOTAL</h3>
                              <h6>$ 6.99</h6>
                           </div>
                           <div class="col-sm-4 text-right">
                              <h3>ORDER #DFR-4546567677</h3>
                              <h6><a href="">View order details</a> <a href="">Invoice</a></h6>
                           </div>
                        </div>
                     </div>
                     <div class="maind-bgf">
                        <div class="row">
                           <div class="col-sm-9">
                              <div class="job-details">
                                 <a href="job-details.html" class="job-logo">
                                 <img src="{{ url('public/assets/images/tshrt.png') }}" alt="">
                                 </a>
                                 <div class="job-description">
                                    <div class="inner-info">
                                       <div class="">
                                          <h3>  White  Embroidered  T-shirt</h3>
                                          <h4>Forever 21</h4>
                                          <!--h4>#3435456 </h4-->
                                       </div>
                                       <div class="job-tags">
                                          <br><br>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <p class="payment-details red">Rejected</p>
                              <div class="ac-bt accepts"><a class="accet-green disable" href="">Accept </a> <a class="accet-red rejt" href="">Rejected</a>
                              </div>
                              <div class="right">
                                 <a class="filters" href="{{ route('order.history-detail') }}" aria-expanded="false">
                                 View Order Details</a><br>
                              </div>
                           </div>
                        </div>
                        <div class="row"> </div>
                     </div>
                  </div>
                  <!-- job 1 -->
                  <div class="job-detai ">
                     <div class="main-head">
                        <div class="row">
                           <div class="col-sm-2">
                              <h3>ORDER PLACED</h3>
                              <h6>13 july 2021</h6>
                           </div>
                           <div class="col-sm-6">
                              <h3>TOTAL</h3>
                              <h6>$ 6.99</h6>
                           </div>
                           <div class="col-sm-4 text-right">
                              <h3>ORDER #DFR-4546567677</h3>
                              <h6><a href="">View order details</a> <a href="">Invoice</a></h6>
                           </div>
                        </div>
                     </div>
                     <div class="maind-bgf">
                        <div class="row">
                           <div class="col-sm-9">
                              <div class="job-details">
                                 <a href="job-details.html" class="job-logo">
                                 <img src="{{ url('public/assets/images/dress.png') }}" alt="">
                                 </a>
                                 <div class="job-description">
                                    <div class="inner-info">
                                       <div class="">
                                          <h3>  V Neck Floral A Line Dress - Grey</h3>
                                          <h4>Forever 21</h4>
                                          <!--h4>#3435456 </h4-->
                                       </div>
                                       <div class="job-tags">
                                          <br><br>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <p class="payment-details green">Accepted</p>
                              <div class="ac-bt accepts"><a class="accet-green acpt" href="">accepted </a> <a class="accet-red disable" href="">Reject</a>
                              </div>
                              <div class="right">
                                 <a class="filters" href="{{ route('order.history-detail') }}" aria-expanded="false">
                                 View Order Details</a><br>
                              </div>
                           </div>
                        </div>
                        <div class="row"> </div>
                     </div>
                  </div>
                  <!-- job 1 -->
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