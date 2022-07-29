<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Product;
use App\ProductCategory;
use App\User;
use Auth;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = ['page_title' => 'Home | TJ'];
        if (Auth::user()) {
            return redirect('feed');
        }
        return view('home',$data);
    }
    
    public function privacyPolicy()
    {
        $data = ['page_title' => 'Privacy Policy | TJ'];
        return view('privacy-policy',$data);
    }
    
    public function termsConditions()
    {
        $data = ['page_title' => 'Terms & Conditions | TJ'];
        return view('terms-conditions',$data);
    }
    
    public function search(Request $request)
    {
        $searchBy = $request->search_option;
        if ($request->search_option == 'category') {
            $filteredData = ProductCategory::where('name', 'like', '%' . $request->search . '%')
                ->get();
        } elseif ($request->search_option == 'product') {
            $filteredData = Product::where('name', 'like', '%' . $request->search . '%')
                ->get();
        } elseif ($request->search_option == 'people') {            
            $filteredData = User::select('id', 'name', 'profile_image')
                ->where('name', 'like', '%' . $request->search . '%')
                ->where('privacy', '!=', 'only_me')
                ->get();
        } else {
            $filteredData = (new Search())
                ->registerModel(ProductCategory::class, 'name')
                ->registerModel(Product::class, 'name')
                ->registerModel(User::class, 'name')
                ->perform($request->search);    
        }
        $data = ['page_title' => 'Search | TJ', 'searchBy' => $searchBy, 'filteredData' => $filteredData];
        return view('search', $data);
    }

    public function help()
    {
        $data = ['page_title' => 'Help | TJ'];
        return view('help',$data);
    }
}
