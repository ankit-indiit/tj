@if (Auth::user()->switch_as == 'seller')
    @include('feed.seller-feed')
@else
    @include('feed.buyer-feed')
@endif 