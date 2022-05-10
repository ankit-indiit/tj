<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductRelatedCategory;
use App\ProductRelatedSubCategory;
use App\ProductAttr;
use App\ProductRelatedAttr;
use App\ProductRelatedCollection;
use App\ProductCollection;
use App\ProductCategory;
use App\Wishlist;
use App\ProductReview;
use App\FeatureProduct;
use App\Cart;
use Auth;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $data = ['page_title' => 'Feed | TJ'];
        return view('feed',$data);
    }

    public function create()
    {
        $productCollections = ProductCollection::select('id', 'name')->get();
        $data = ['page_title' => 'Create Product | TJ', 'productCollections' => $productCollections];
        return view('seller.add-product',$data);
    }

    public function store(Request $request)
    {
        if ($request->product_status == 'on') {
            $productStatus = 1;
        } else {
            $productStatus = 0;
        }

        $images = [];
        DB::beginTransaction();
        
        try {
            $decoded_images = json_decode($request->product_images);

            if(count($decoded_images) > 0)
            {
                foreach ($decoded_images as $key => $value) {
                    array_push($images, $value->image_name);
                }
            }

            $productImages = serialize($images);
            $product = Product::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'price' => $request->price,
                'discounted_price' => $request->discounted_price,
                'quantity' => $request->quantity,
                'delivery_cost' => $request->delivery_cost,
                'description' => $request->description,
                'status' => $productStatus,
                'image' => $productImages,
                'slug' => str_replace(' ', '-', strtolower($request->name)),
                'sku' => 'SKU_'.time(),
            ]);

            if ($request->product_attr) {
                ProductRelatedAttr::create([
                    'product_id' => $product->id,
                    'product_attr' => serialize($request->product_attr),
                ]);                                
            }
            
            if ($request->product_collection) {
                foreach ($request->product_collection as $productCollection) {
                    ProductRelatedCollection::create([
                        'product_id' => $product->id,
                        'product_collection' => $productCollection,
                    ]);                    
                }
            }                   

            if ($request->category_id) {
                foreach ($request->category_id as $catIds) {
                    ProductRelatedCategory::create([
                        'product_id' => $product->id,
                        'cat_id' => $catIds,
                    ]);

                }
            }

            if ($request->sub_category_id) {
                foreach ($request->sub_category_id as $subCatIds) {
                    ProductRelatedSubCategory::create([
                        'product_id' => $product->id,
                        'sub_cat_id' => $subCatIds,
                    ]);

                }
            }
            
            DB::commit();

        } catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            $message['erro'] = 101;
            return response()->json($message, 200);

        }
        

        $message['message'] = "Product has been added!";
        $message['erro'] = 101;
        return response()->json($message, 200);
    }

    public function edit(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $productCollections = ProductCollection::select('id', 'name')->get();
        $productCat = ProductRelatedCategory::where('product_id', $product->id)->pluck('cat_id')->toArray();
        $productCol = ProductRelatedCollection::where('product_id', $product->id)->pluck('product_collection')->toArray();
        $data = ['page_title' => 'Edit Product | TJ', 'product' => $product, 'productCollections' => $productCollections, 'productCat' => $productCat, 'productCol' => $productCol];
        return view('seller.edit-product', $data);
    }

    public function update(Request $request, $id)
    {
        if ($request->product_status == 'on') {
            $productStatus = 1;
        } else {
            $productStatus = 0;
        }

        $images = [];
        if (!empty($request->productImages)) {
            foreach ($request->productImages as $key => $value) {                      
                array_push($images, $value);
            }
        }
        DB::beginTransaction();
        
        try {
            if (!empty($request->product_images)) {
                $decoded_images = json_decode($request->product_images);

                if(count($decoded_images) > 0)
                {
                    foreach ($decoded_images as $key => $value) {
                        array_push($images, $value->image_name);
                    }
                }

                $productImages = serialize($images);
                $data = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'discounted_price' => $request->discounted_price,
                    'quantity' => $request->quantity,
                    'delivery_cost' => $request->delivery_cost,
                    'description' => $request->description,
                    'status' => $productStatus,
                    'image' => $productImages,
                ];
            } else {
                $data = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'discounted_price' => $request->discounted_price,
                    'quantity' => $request->quantity,
                    'delivery_cost' => $request->delivery_cost,
                    'description' => $request->description,
                    'status' => $productStatus,
                ];
            }

            $product = Product::where('id', $request->id)->update($data);

            if (!empty($request->product_attr)) {
                ProductRelatedAttr::where('product_id', $id)->delete();
                ProductRelatedAttr::create([
                    'product_id' => $id,
                    'product_attr' => serialize($request->product_attr),
                ]);                                
            }
            
            if (!empty($request->product_collection)) {
                ProductRelatedCollection::where('product_id', $id)->delete();
                foreach ($request->product_collection as $productCollection) {
                    ProductRelatedCollection::create([
                        'product_id' => $id,
                        'product_collection' => $productCollection,
                    ]);                    
                }
            }                   

            if (!empty($request->category_id)) {
                ProductRelatedCategory::where('product_id', $id)->delete();
                foreach ($request->category_id as $catIds) {
                    ProductRelatedCategory::create([
                        'product_id' => $id,
                        'cat_id' => $catIds,
                    ]);

                }
            }

            if (!empty($request->sub_category_id)) {
                ProductRelatedSubCategory::where('product_id', $id)->delete();
                foreach ($request->sub_category_id as $subCatIds) {
                    ProductRelatedSubCategory::create([
                        'product_id' => $id,
                        'sub_cat_id' => $subCatIds,
                    ]);

                }
            }
            
            DB::commit();

        } catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            $message['erro'] = 101;
            return response()->json($message, 200);

        }

        $message['message'] = "Product has been updated!";
        $message['erro'] = 101;
        return response()->json($message, 200);
    }

    public function destroy(Request $request, $id)
    {
        Product::where('id', $request->id)->delete();
        ProductRelatedAttr::where('product_id', $request->id)->delete();
        ProductRelatedCollection::where('product_id', $request->id)->delete();
        ProductRelatedCategory::where('product_id', $request->id)->delete();
        ProductRelatedSubCategory::where('product_id', $request->id)->delete();
        $message['message'] = "Product has been deleted!";
        $message['erro'] = 101;
        return response()->json($message, 200);
    }

    public function show(Request $request)
    {
        // echo "working";
    }

    public function storeProductAttr(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        ProductAttr::create($request->all());
        $message['message'] = "Product attribute has been added!";
        $message['erro'] = 101;
        return response()->json($message, 200);
    }

    public function productDetail(Request $request, $slug)
    {
        $productDetail = Product::where('slug', $slug)->first();
        Product::where('id', $productDetail->id)->update([
            'updated_at' => now(),
        ]);
        $productReviews = ProductReview::select('id', 'user_id', 'title', 'rating', 'comment', 'created_at')->where('product_id', $productDetail->id)->orderBy('id', 'DESC')->get();
        $productReviewAverage = ProductReview::avg('rating');
        $proCat = [];
        foreach ($productDetail->productCategoryId as $productCat) {
            $proCat[] = $productCat->cat_id;
        }
        $relatedProductIds = ProductRelatedCategory::whereIn('cat_id', array_unique($proCat))->pluck('product_id');
        $relatedProducts = Product::whereIn('id', $relatedProductIds)->where('status', 1)->where('slug', '!=', $slug)->get();
        $productCollectionIds = ProductRelatedCollection::where('product_id', $productDetail->id)
            ->pluck('product_collection');
        $collections = ProductCollection::select('id', 'name')->whereNotIn('id', $productCollectionIds)->get();
        $data = ['page_title' => 'Create Product | TJ', 'productDetail' => $productDetail, 'relatedProducts' => $relatedProducts, 'productReviews' => $productReviews, 'productReviewAverage' => $productReviewAverage, 'productCollectionIds' => $productCollectionIds, 'collections' => $collections];
        return view('seller.product-detail', $data);
    }

    public function shop()
    {
        $products = Product::get();
        $productCategories = ProductCategory::select('feature_image', 'name', 'slug')->get();
        $data = ['page_title' => 'Shop Product | TJ', 'products' => $products, 'productCategories' => $productCategories];
        return view('marketplace.shop.shop',$data);
    }

    public function addToWishlist(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['product_id'] = $request->productId;
        if (Cart::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->exists()) {
            Cart::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->delete();
            Wishlist::create($request->all());            
        } else {
            Wishlist::create($request->all());            
        }
        $message['message'] = "Product has been added to wishlist!";
        $message['erro'] = 101;
        $message['html'] = '<a href="javascript:void(0);" class="bg-blue-100 absolute right-2 top-2 p-0.5 px-1.5 rounded-full text-blue-500"><i class="icon-feather-heart"></i>';
        return response()->json($message, 200);
    }

    public function trending()
    {
        $products = Product::orderBy('updated_at', 'DESC')->get();
        $data = ['page_title' => 'Trending Product | TJ', 'products' => $products];
        return view('marketplace.trending',$data);
    }

    public function bestSeller()
    {
        $products = Product::orderBy('updated_at', 'DESC')->get();
        $data = ['page_title' => 'Best Seller Product | TJ', 'products' => $products];
        return view('marketplace.best-seller',$data);
    }

    public function featuredProduct()
    {
        $products = Product::where('feature', 1)->orderBy('updated_at', 'DESC')->get();
        $data = ['page_title' => 'Fearured Product | TJ', 'products' => $products];
        return view('marketplace.featured-product',$data);
    }

    public function productReview(Request $request)
    {
        if ($request->rating == 5) {
            $request['title'] = 'Excellent';
            $retingHtml = '<div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>';   
        } elseif ($request->rating == 4) {
            $request['title'] = 'Very Good';
            $retingHtml = '<div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>';    
        } elseif ($request->rating == 3) {
            $request['title'] = 'Average';
            $retingHtml = '<div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>';  
        } elseif ($request->rating == 2) {
            $request['title'] = 'Poor';
            $retingHtml = '<div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>'; 
        } elseif ($request->rating == 1) {
            $request['title'] = 'Terrible';
            $retingHtml = '<div class="rating">
                <i class="fa fa-star"></i>
            </div>';   
        }        
        $productReview = ProductReview::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        $message['message'] = "Review has been added!";
        $message['erro'] = 101;
        $message['data'] = '<div class="review-item">
                '.$retingHtml.'
                <h3>'.$productReview->title.'</h3>
                <span><strong>'.show_user_name($productReview->user_id).'</strong> on <strong>'.$productReview->created_at.'</strong></span>
                <p>Good</p>
                <a href="#" class="review-report-link">Report as Inappropriate</a>
            </div>';
        return response()->json($message, 200);
    }

    public function addFeatureProduct(Request $request)
    {
        Product::whereIn('id', $request->productIds)->update([
            'feature' => 1,
        ]);
        $message['message'] = "Product has been added to feature list!";
        $message['erro'] = 101;
        return response()->json($message, 200);
    }

    public function removeFeatureProduct(Request $request)
    {
        Product::where('id', $request->productId)->update([
            'feature' => NULL,
        ]);
        $message['message'] = "Product has been removed to feature list!";
        $message['erro'] = 101;
        return response()->json($message, 200);
    }

    public function assignCollectionToProduct(Request $request)
    {
        $request['product_id'] = $request->productId;
        $request['product_collection'] = $request->collectionId;
        ProductRelatedCollection::create($request->all());
        $message['message'] = "Collection has been added to product!";
        $message['erro'] = 101;
        return response()->json($message, 200);
    }
}
