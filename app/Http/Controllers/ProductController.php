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
        $productCollections = ProductCollection::select('name')->get();
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
                ProductRelatedCollection::create([
                    'product_id' => $product->id,
                    'product_collection' => serialize($request->product_collection),
                ]);
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
        $proCat = [];
        foreach ($productDetail->productCategoryId as $productCat) {
            $proCat[] = $productCat->cat_id;
        }
        $relatedProductIds = ProductRelatedCategory::whereIn('cat_id', array_unique($proCat))->pluck('product_id');
        $relatedProducts = Product::whereIn('id', $relatedProductIds)->where('status', 1)->where('slug', '!=', $slug)->get();
        $data = ['page_title' => 'Create Product | TJ', 'productDetail' => $productDetail, 'relatedProducts' => $relatedProducts];
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
        if (!Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->exists()) {
            Wishlist::create($request->all());
            $message['message'] = "Product has been added to wishlist!";
        } else {
            Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->delete();
            $message['message'] = "Product has been removed to wishlist!";
        }
        $message['erro'] = 101;
        return response()->json($message, 200);
    }

    public function trending()
    {
        $products = Product::orderBy('updated_at', 'DESC')->get();
        $data = ['page_title' => 'Shop Product | TJ', 'products' => $products];
        return view('marketplace.trending',$data);
    }
}
