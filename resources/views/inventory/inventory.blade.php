@extends('layouts.app')
@section('content')
<div class="main_content">
   <div class="mcontainer">
      <div class="flex items-center justify-between">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
               <li class="breadcrumb-item"><a href="shop-1.html">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Inventory</li>
            </ol>
         </nav>
      </div>
      <div class="box_shop" style="display:none;">
         <div class="my-2 flex items-center justify-between pb-3">
            <div>
               <h2 class="text-xl font-semibold"> Shops</h2>
               <p class="font-medium text-gray-500 leading-6"></p>
            </div>
         </div>
         <hr>
         <div>          
            <div class="uk-slider-container px-1 first-page py-3">
               <div class="row">
                  <div class="col-sm-3">
                     <div class="overly">
                        <a href="timeline-page.html">
                           <img src="assets/images/c4.jpg" class="w-full h-48 rounded-lg shadow-sm object-cover">
                           <div class="pt-2">
                              <h4 class="text-lg font-semibold"> Step Villa Fashion  </h4>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="overly">
                        <a href="timeline-page.html">
                           <img src="assets/images/c1.jpg" class="w-full h-48 rounded-lg shadow-sm object-cover">
                           <div class="pt-2">
                              <h4 class="text-lg font-semibold"> Forever 21 </h4>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="overly">
                        <a href="shop-sec.html">
                           <img src="assets/images/c2.jpg" class="w-full h-48 rounded-lg shadow-sm object-cover">
                           <div class="pt-2">
                              <h4 class="text-lg font-semibold"> AND Store </h4>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="overly">
                        <a href="timeline-page.html">
                           <img src="assets/images/c3.jpg" class="w-full h-48 rounded-lg shadow-sm object-cover">
                           <div class="pt-2">
                              <h4 class="text-lg font-semibold">Asees Creations</h4>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="overly">
                        <a href="timeline-page.html">
                           <img src="assets/images/c4.jpg" class="w-full h-48 rounded-lg shadow-sm object-cover">
                           <div class="pt-2">
                              <h4 class="text-lg font-semibold">Cloth Palace </h4>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="box_products">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header">
                     <h5>Inventory </h5>
                  </div>
                  <div class="card-body">
                     <div class="order-datatable">
                        <table style="
                           width: 100%;
                           ">
                           <thead class="thead-dark">
                              <tr>
                                 <th>Product </th>
                                 <th>SKU </th>
                                 <th>Total Quantity</th>
                                 <th>In Stock</th>
                                 <th>Sold</th>
                                 <th>Available</th>
                                 <th>Alert level</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($products as $product)
                                @php
                                   $unSerlizeProImage = unserialize($product->image);
                                   $productImage = reset($unSerlizeProImage);
                                @endphp
                                <tr>
                                   <td class="tableproduct">
                                      <div class="img-prd">
                                         <span><img src="{{ url("public/images/product/$productImage") }}"></span>
                                         <h5>{{ $product->name }}</h5>
                                      </div>
                                   </td>
                                   <td>{{ $product->sku }}</td>
                                   <td class="table-action-btn">
                                      <div class="updatequantity">
                                         <input type="number" name="qty" class="qty" maxlength="12" value="{{ $product->quantity }}">
                                      </div>
                                   </td>
                                   <td>{{ $product->quantity }}</td>
                                   <td>0</td>
                                   <td>{{ $product->quantity }}</td>
                                   <td><span class="badge badge-success" style="
                                      background: #81ba00;
                                      ">Most Stocked</span> <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="If the quantity of a product is more than 5, it will count in the Most stocked"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                   </td>
                                   <td id="">
                                     
                                   </td>
                                </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
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