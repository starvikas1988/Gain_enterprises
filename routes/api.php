<?php

use Illuminate\Support\Facades\Route;


Route::post('v1/webconfig', [App\Http\Controllers\Api\HomeController::class, 'webconfig']);
Route::post('v1/forgotPassword', [App\Http\Controllers\Api\HomeController::class, 'forgotPassword']);

Route::post('v1/customer/login', [App\Http\Controllers\Api\CustomerAuthController::class, 'customlogin']);
Route::post('v1/customer/register', [App\Http\Controllers\Api\CustomerAuthController::class, 'customregistration']);
Route::post('v1/customer/mobilevalidate', [App\Http\Controllers\Api\CustomerAuthController::class, 'mobilevalidate']);

Route::post('v1/getAllCategories', [App\Http\Controllers\Api\HomeController::class, 'getAllCategories']);
Route::post('v1/getAllRestaurant', [App\Http\Controllers\Api\HomeController::class, 'getAllRestaurant']);
Route::post('v1/getAllRestaurantByCategoryId', [App\Http\Controllers\Api\HomeController::class, 'getAllRestaurantByCategoryId']);
Route::get('v1/getAllProductByRestaurantIdWithFilter', [App\Http\Controllers\Api\HomeController::class, 'getAllProductByRestaurantIdWithFilter']);
Route::post('v1/getAllProductByCategoryId', [App\Http\Controllers\Api\HomeController::class, 'getAllProductByCategoryId']);
Route::post('v1/searchProductOrRestaurant', [App\Http\Controllers\Api\HomeController::class, 'searchProductOrRestaurant']);
Route::post('v1/getRecommendedProduct', [App\Http\Controllers\Api\HomeController::class, 'getRecommendedProduct']);

//Route::get('v1/customer/getAllProductByRestaurantIdWithFilter', [App\Http\Controllers\Api\CustomerController::class, 'getAllProductByRestaurantIdWithFilter']);

Route::prefix('v1/')->group(function () {	
	Route::middleware(['auth:sanctum', 'type.customer'])->group(function () {
	    
		Route::post('customer/profile', [App\Http\Controllers\Api\CustomerController::class, 'profile']);
		Route::post('customer/change-password', [App\Http\Controllers\Api\CustomerController::class, 'changePassword']);
		Route::post('customer/updateprofile', [App\Http\Controllers\Api\CustomerController::class, 'updateprofile']);
		Route::post('customer/updateprofileimg', [App\Http\Controllers\Api\CustomerController::class, 'updateprofileimg']);
		Route::post('customer/addUserAddress', [App\Http\Controllers\Api\CustomerController::class, 'addUserAddress']);
		Route::post('customer/getUserAddressList', [App\Http\Controllers\Api\CustomerController::class, 'getUserAddressList']);
		Route::post('customer/updateUserAddress', [App\Http\Controllers\Api\CustomerController::class, 'updateUserAddress']);
		Route::post('customer/deleteUserAddress', [App\Http\Controllers\Api\CustomerController::class, 'deleteUserAddress']);
		Route::post('customer/logout', [App\Http\Controllers\Api\CustomerController::class, 'logout']);
	
		Route::post('customer/addToCart', [App\Http\Controllers\Api\CustomerController::class, 'addToCart']);
		Route::post('customer/getCartCount', [App\Http\Controllers\Api\CustomerController::class, 'getCartCount']);
		Route::post('customer/getCartList', [App\Http\Controllers\Api\CustomerController::class, 'getCartList']);
		Route::post('customer/deleteCartById', [App\Http\Controllers\Api\CustomerController::class, 'deleteCartById']);
		Route::post('customer/deleteCartByProductId', [App\Http\Controllers\Api\CustomerController::class, 'deleteCartByProductId']);
		Route::post('customer/placeOrder', [App\Http\Controllers\Api\CustomerController::class, 'placeOrder']);
		Route::post('customer/getorderValueByCart', [App\Http\Controllers\Api\CustomerController::class, 'getorderValueByCart']);
		
		Route::post('customer/paymentAdd', [App\Http\Controllers\Api\CustomerController::class, 'paymentAdd']);
		Route::post('customer/verifyPayments', [App\Http\Controllers\Api\CustomerController::class, 'verifyPayments']);
		Route::post('customer/applyCoupon', [App\Http\Controllers\Api\CustomerController::class, 'applyCoupon']);
		Route::post('customer/getOrderList', [App\Http\Controllers\Api\CustomerController::class, 'getOrderList']);
		Route::post('customer/getOrderDetailById', [App\Http\Controllers\Api\CustomerController::class, 'getOrderDetailById']);
		
		Route::get('customer/getAllProductByRestaurantIdWithFilter', [App\Http\Controllers\Api\CustomerController::class, 'getAllProductByRestaurantIdWithFilter']);
		Route::post('customer/getCartProductQuantityByRestaurantId', [App\Http\Controllers\Api\CustomerController::class, 'getCartProductQuantityByRestaurantId']);
		
		
		Route::post('customer/report/transaction', [App\Http\Controllers\Api\ReportController::class, 'transaction']);	
		Route::post('customer/updatedevicetoken', [App\Http\Controllers\Api\CustomerController::class, 'updatedevicetoken']);
		Route::post('customer/allnotification', [App\Http\Controllers\Api\CustomerController::class, 'notificationlist']);
	});	
});
