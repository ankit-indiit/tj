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
Route::get('my-profile', 'UserController@profile')->name('my-profile');
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
Route::post('add-seller-social-link', 'BecomeSellerController@addSellerSocialLink')->name('add.social');
Route::get('edit-social-link', 'BecomeSellerController@editSellerSocialLink')->name('edit.social-link');
Route::post('update-seller-social-link', 'BecomeSellerController@updateSellerSocialLink')->name('update.social-link');
Route::post('add-seller-working-hour', 'BecomeSellerController@addSellerWorkingHour')->name('add.seller-working-hour');
Route::get('edit-working-hour', 'BecomeSellerController@editWorkingHour')->name('edit.working-hour');
Route::post('update-seller-working-hour', 'BecomeSellerController@updateSellerWorkingHour')->name('update.seller-working-hour');
Route::post('add-seller-estimated-delivery', 'BecomeSellerController@addSellerEstimatedDelivery')->name('add.seller-estimated-delivery');
Route::get('edit-estimate-delevery', 'BecomeSellerController@editEstimateDelevery')->name('edit.estimate-delevery');
Route::post('update-seller-estimated-delivery', 'BecomeSellerController@updateEstimateDelevery')->name('update.seller-estimated-delivery');
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
Route::get('inventory', 'InventoryController@index')->name('inventory');
Route::get('seller-order', 'OrderController@sellerOrder')->name('seller.order');
Route::get('friend-follower', 'FriendController@friendFollower')->name('friend.follower');
Route::get('order-history', 'OrderController@orderHistory')->name('order.history');
Route::get('order-history-detail', 'OrderController@orderHistoryDetail')->name('order.history-detail');
Route::get('trending', 'ProductController@trending')->name('trending');
Route::get('best-seller', 'ProductController@bestSeller')->name('best.seller');
Route::get('featured-product', 'ProductController@featuredProduct')->name('featured.product');
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




