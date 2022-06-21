@extends('layouts.app-without-sidebar')
@section('content')
<div class="main_contents checkout-page">
    <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <div class="cart-totals m-0 mt-4">
              <h3>Paypal</h3>
              <form action="{{ route('make.payment') }}" method="get">
                @csrf
                <input type="text" class="border my-2" placeholder="Enter Name">
                <input type="text" class="border my-2" placeholder="Enter card number">
                <input type="text" class="border my-2" placeholder="Expiry date">                 
                <input type="text" class="border my-2" placeholder="CVC">
                <button type="submit" id="checkoutFormBtn" class="default-btn">Submit</button>
              </form>             
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
@endsection
@section('customScripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
@endsection