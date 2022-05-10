<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
Route::get('terms-conditions', 'HomeController@termsConditions')->name('terms-conditions');
Route::get('feed', 'FeedController@index')->name('feed');

Auth::routes();

Route::get('change-password', 'UserController@changePassword')->name('change-password');
Route::post('update-password', 'UserController@updatePassword')->name('update-password');
Route::get('my-profile/{collectionSlug?}', 'UserController@profile')->name('my-profile');
Route::post('update-profile', 'UserController@updateProfile')->name('update-profile');
Route::post('add-address', 'UserController@addAddress')->name('add-address');
Route::post('update-address', 'UserController@updateAddress')->name('update-address');
Route::post('get-single-address', 'UserController@getSingleAddress')->name('get-single-address');
Route::post('remove-address', 'UserController@removeAddress')->name('remove-address');
Route::post('updateProfileCoverImage', 'UserController@updateProfileCoverImage')->name('updateProfileCoverImage');
Route::post('updateProfileImage', 'UserController@updateProfileImage')->name('updateProfileImage');
Route::post('update-user-bio', 'UserController@updateUserBio')->name('update-user-bio');
Route::get('become-seller', 'BecomeSellerController@index')->name('become.seller');
Route::post('seller-signup', 'BecomeSellerController@sellerSignup')->name('seller.signup');
Route::get('switch-as', 'BecomeSellerController@switchAs')->name('switch-as');
Route::post('add-shop-image', 'BecomeSellerController@addShopImage')->name('add.shop-image');
Route::post('add-shop-category', 'BecomeSellerController@addShopCategory')->name('add.shop-category');
Route::get('edit-shop-category', 'BecomeSellerController@editShopCategory')->name('edit.shop-category');
Route::post('update-shop-category', 'BecomeSellerController@updateShopCategory')->name('update.shop-category');
Route::post('add-seller-social-link', 'BecomeSellerController@addSellerSocialLink')->name('add.social');
Route::get('edit-social-link', 'BecomeSellerController@editSellerSocialLink')->name('edit.social-link');
Route::post('update-seller-social-link', 'BecomeSellerController@updateSellerSocialLink')->name('update.social-link');
Route::post('add-seller-working-hour', 'BecomeSellerController@addSellerWorkingHour')->name('add.seller-working-hour');
Route::get('edit-working-hour', 'BecomeSellerController@editWorkingHour')->name('edit.working-hour');
Route::post('update-seller-working-hour', 'BecomeSellerController@updateSellerWorkingHour')->name('update.seller-working-hour');
Route::post('add-seller-estimated-delivery', 'BecomeSellerController@addSellerEstimatedDelivery')->name('add.seller-estimated-delivery');
Route::get('edit-estimate-delevery', 'BecomeSellerController@editEstimateDelevery')->name('edit.estimate-delevery');
Route::post('update-seller-estimated-delivery', 'BecomeSellerController@updateEstimateDelevery')->name('update.seller-estimated-delivery');
Route::post('apply-coupon', 'CartController@applyCoupon')->name('apply-coupon');
Route::post('add-discount-coupon', 'BecomeSellerController@addDiscountCoupon')->name('add.discount-coupon');
Route::get('edit-discount-coupon', 'BecomeSellerController@editDiscountCoupon')->name('edit.discount-coupon');
Route::post('update-discount-coupon', 'BecomeSellerController@updateDiscountCoupon')->name('update.discount-coupon');
Route::post('add-product-category', 'ProductCategoryController@store')->name('add.product-category');
Route::get('get-sub-cat', 'ProductCategoryController@getSubCat')->name('get.sub-cat');
Route::post('product-attr-create', 'ProductController@storeProductAttr')->name('product-attr.store');
Route::post('upload-product-files', 'ProductController@upload_files')->name('upload.product-files');
Route::get('product-detail/{slug}', 'ProductController@productDetail')->name('product.detail');
Route::get('shop', 'ProductController@shop')->name('shop');
Route::post('add-to-wishlist', 'ProductController@addToWishlist')->name('add-to-wishlist');
Route::get('wishlist', 'WishlistController@index')->name('wishlist');
Route::post('delete-product-from-wishlist', 'WishlistController@deleteProductFromWishlist')->name('delete-product-from-wishlist');
Route::get('cart', 'CartController@index')->name('cart');
Route::post('add-to-cart', 'CartController@store')->name('add-to-cart');
Route::post('update-cart', 'CartController@update')->name('update-cart');
Route::post('move-to-wihlist', 'CartController@moveToWihlist')->name('remove-to-cart');
Route::post('remove-to-cart', 'CartController@delete')->name('move-to-wihlist');
Route::get('inventory', 'InventoryController@index')->name('inventory');
Route::get('seller-order', 'OrderController@sellerOrder')->name('seller.order');
Route::get('friend-follower', 'FriendController@friendFollower')->name('friend.follower');
Route::get('user-time-line/{id}', 'FriendController@timeLine')->name('time.line');
Route::get('order-history', 'OrderController@orderHistory')->name('order.history');
Route::get('order-history-detail', 'OrderController@orderHistoryDetail')->name('order.history-detail');

// User Friendship Routes 
Route::post('add-to-friend-list', 'FriendController@addToFriendList')->name('add-to-friend-list');
Route::post('cancel-follow-request', 'FriendController@cancelFollowRequest')->name('cancel-follow-request');
Route::post('cancel-or-follow-request', 'FriendController@canvelOrUnFollowFriend')->name('cancel-or-follow-request');
Route::post('block-friend', 'FriendController@blockFriend')->name('block-friend');
Route::post('un-block-friend', 'FriendController@unBlockFriend')->name('un-block-friend');
Route::post('follow-back', 'FriendController@followBack')->name('follow.back');
Route::post('delete-follow-request', 'FriendController@deleteFollowRequest')->name('delete.follow-request');
Route::get('see-all-friend-follower/{status}', 'FriendController@seeAllFriendFollower')->name('see.all-friendFollower');
Route::get('search-user', 'FriendController@searchUser')->name('search.user');
Route::post('follow-shop', 'SellerShopController@followShop')->name('follow.shop');
Route::post('un-follow-shop', 'SellerShopController@unFollowhop')->name('un.follow-shop');
Route::get('seller-shop', 'SellerShopController@sellerShop')->name('seller.shop');
Route::get('shop-detail/{id}', 'SellerShopController@shopDetail')->name('shop.detail');
Route::get('shop-follower/{id}', 'SellerShopController@shopFollower')->name('shop.follower');
Route::get('chat', 'MessageController@index')->name('chat');
Route::get('user-chat', 'MessageController@getUserChat')->name('user-chat');
Route::post('send-message', 'MessageController@sendMessage')->name('send-message');
Route::get('search-user-for-chat', 'MessageController@searchUserForChat')->name('search-user-for-chat');
Route::post('delete-conversation', 'MessageController@deleteConversation')->name('delete-conversation');


Route::get('notification', 'NotificationController@index')->name('notification');
Route::get('trending', 'ProductController@trending')->name('trending');
Route::get('best-seller', 'ProductController@bestSeller')->name('best.seller');
Route::get('featured-product', 'ProductController@featuredProduct')->name('featured.product');
Route::post('add-feature-product', 'ProductController@addFeatureProduct')->name('add.feature-product');
Route::post('remove-feature-product', 'ProductController@removeFeatureProduct')->name('remove.feature-product');
Route::post('product-review', 'ProductController@productReview')->name('product-review');
Route::post('assign-collection-to-product', 'ProductController@assignCollectionToProduct')->name('assign-collection-to-product');
Route::post('search', 'HomeController@search')->name('search');
Route::resource('category', ProductCategoryController::class);
Route::resource('collection', ProductCollectionController::class);
Route::resource('product', ProductController::class);

Route::post('add-simple-post', 'PostController@store')->name('add-simple-post');
Route::get('edit-simple-post', 'PostController@edit')->name('edit-simple-post');
Route::post('update-simple-post', 'PostController@update')->name('update-simple-post');
Route::get('enable-post-comment', 'PostController@enableComment')->name('enable-post-comment');
Route::get('disable-post-comment', 'PostController@disableComment')->name('disable-post-comment');
Route::get('like-comment', 'PostController@likeComment')->name('like-comment');
Route::get('delete-post', 'PostController@delete')->name('delete-post');
Route::post('add-poll-post', 'PostController@store')->name('add-poll-post');
Route::post('add-product-post', 'PostController@store')->name('add-product-post');
Route::post('add-suggestion-post', 'PostController@store')->name('add-suggestion-post');
Route::post('like-post', 'PostController@likePost')->name('like-post');
Route::post('unlike-post', 'PostController@unLikePost')->name('unlike-post');
Route::post('update-poll', 'PostController@updatePoll')->name('update-poll');
Route::post('post-comment', 'PostController@postComment')->name('post-comment');




