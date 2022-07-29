<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\ProductRelatedCategory;
use App\Product;
use Auth;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::all();
        $data = ['page_title' => 'Feed | TJ', 'productCategories' => $productCategories];
        return view('marketplace.product-category.category',$data);
    }

    public function show(Request $request, $slug)
    {
        $categoryId = ProductCategory::where('slug', $slug)->pluck('id')->first();
        $productId = ProductRelatedCategory::where('cat_id', $categoryId)->pluck('product_id');
        $products = Product::whereIn('id', $productId)
            ->where('user_id', '!=', Auth::id())
            ->where('status', 1)
            ->get();
        $data = ['page_title' => 'Feed | TJ', 'products' => $products];
        return view('marketplace.product-category.product',$data);
    }

    public function create()
    {
        $data = ['page_title' => 'Create Product Category | TJ'];
        return view('seller.add-product',$data);
    }

    public function store(request $request)
    {
        if ($request->file('feature_image')) {
            $image = $request->file('feature_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/category');
            $image->move($destinationPath, $imagename);
            $image = $imagename;       
        }

        ProductCategory::create([
            'feature_image' => $image,
            'name' => $request->name,
            'slug' => str_replace(' ', '-', strtolower($request->name)),
            'parent_id' => 0,
            'status' => 1,
        ]);
        $messags['message'] = "Category has been added!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function getSubCat(request $request)
    {
        $subCat = [];
        foreach ($request->selectCategory as $catId) {
            return ProductCategory::where('parent_id', $catId)->select('id', 'name')->first();            
            $subCat[] = $getSubCat;
        }
        return $subCat;
    }
}
