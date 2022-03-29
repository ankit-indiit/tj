<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class InventoryController extends Controller
{
    public function index()
    {
      $products = Product::where('user_id', Auth::user()->id)->get();
      $data = ['page_title' => 'Inventory | TJ', 'products' => $products];        
      return view('inventory.inventory',$data);
    }    
}
