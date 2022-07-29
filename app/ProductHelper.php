<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\ProductReview;

if (!function_exists('showProductRating')) {
    function showProductRating($proId = '')
    {
        $productReview = ProductReview::where('product_id', $proId)->pluck('rating')->avg();
        $productReviewCount = ProductReview::where('product_id', $proId)->count();
        switch ($productReview) {
            case 1:
            return '<div class="rating">
                   <i class="fa fa-star"></i>
                </div>
                <a href="#" class="rating-count">'.$productReviewCount.' reviews</a>';
        break;
            case 2:
            return '<div class="rating">
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                </div>
                <a href="#" class="rating-count">'.$productReviewCount.' reviews</a>';
        break;
            case 3:
            return '<div class="rating">
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                </div>
                <a href="#" class="rating-count">'.$productReviewCount.' reviews</a>';
        break;
            case 4:
            return '<div class="rating">
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                </div>
                <a href="#" class="rating-count">'.$productReviewCount.' reviews</a>';
        break;
            case 5:
            return '<div class="rating">
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                   <i class="fa fa-star"></i>
                </div>
                <a href="#" class="rating-count">'.$productReviewCount.' reviews</a>';
            default:

        }
    }
}