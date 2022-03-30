<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function sellerOrder()
    {
        $data = ['page_title' => 'Seller Order | TJ'];        
        return view('order.seller-order', $data);
    }

    public function orderHistory()
    {
        $data = ['page_title' => 'Order History | TJ'];        
        return view('order.order-history', $data);
    }

    public function orderHistoryDetail()
    {
        $data = ['page_title' => 'Order History | TJ'];        
        return view('order.order-history-detail', $data);
    }
}
