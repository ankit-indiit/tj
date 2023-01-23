<div class="col-sm-3">
   @php
      $unSerlizeProImage = unserialize($product->image);
      $productImage = reset($unSerlizeProImage);
   @endphp
   <div class="card">
      <div class="card-media h-44">
         <div class="card-media-overly"></div>
         <img src="{{ url("public/images/product/$productImage") }}" alt="">                                       
      </div>
      <div class="card-body">
         <a href="{{ route('product.detail', $product->slug) }}" class="ext-lg font-medium mt-1 t truncate">{{ $product->name }}</a>
         <div class="text-xs font-semibold uppercase text-yellow-500">${{$product->discounted_price}}</div>
         <div class="text-xs font-semibold ven-nam text-yellow-500">
            @foreach ($product->productCategoryId as $proCatId)
            <a href="{{ route('category.show', str_replace(' ', '-', strtolower(getProductCategoryNameById($proCatId->cat_id)))) }}">{{ getProductCategoryNameById($proCatId->cat_id) }}</a>
            @endforeach
         </div>
         <div class="ratings">
            <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
         </div>
      </div>
   </div>
</div>