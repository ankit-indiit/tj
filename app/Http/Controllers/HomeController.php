<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    
}
