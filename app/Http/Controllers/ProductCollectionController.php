<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Product;
use App\ProductCollection;
use App\ProductRelatedCollection;
use Auth;

class ProductCollectionController extends Controller
{
    public function index()
    {
        $collections = ProductCollection::select('feature_image', 'name', 'slug')->get();
        $data = ['page_title' => 'Feed | TJ', 'collections' => $collections];
        return view('collection.collection',$data);
    }

    public function store(Request $request)
    {
        if ($request->file('product_collection_image')) {
            $image = $request->file('product_collection_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/collection');
            $image->move($destinationPath, $imagename);
            $image = $imagename;       
        }

        ProductCollection::create([
            'feature_image' => $image,
            'name' => $request->name,
            'slug' => str_replace(' ', '-', strtolower($request->name)),
            'status' => 1,
        ]);
        $messags['message'] = "Collection has been added!";
        $messags['erro'] = 101;
        return response()->json($messags, 200);
    }

    public function show($slug)
    {
        $collectionId = ProductCollection::where('slug', $slug)->pluck('id')->first();
        $productIds = ProductRelatedCollection::where('product_collection', $collectionId)->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();
        $data = ['page_title' => 'Product Collection | TJ', 'products' => $products];
        return view('collection.collection-product',$data);
    }
}
