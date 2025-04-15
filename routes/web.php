<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Restaurant\KotController;
use App\Http\Controllers\Restaurant\HomeController;
use App\Http\Controllers\Restaurant\RoleController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Restaurant\OrderController;
use App\Http\Controllers\Restaurant\StockController;
use App\Http\Controllers\Restaurant\ProductController;
use App\Http\Controllers\Employee\Auth\LoginController;
use App\Http\Controllers\Restaurant\CategoryController;
use App\Http\Controllers\Restaurant\EmployeeController;
use App\Http\Controllers\Restaurant\PurchaseController;
use App\Http\Controllers\Restaurant\PermissionController;
use App\Http\Controllers\Auth\EmployeeResetPasswordController;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Restaurant\RestaurantTablenumberController;

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
//Clear Cache facade value:
Route::get('/clearcache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/test-mail', [App\Http\Controllers\HomeController::class, 'testMail'])->name('testMail');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
//Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

/* ajax json response */
Route::get('/customersearch', [App\Http\Controllers\CommonController::class, 'selectCustomerSearch'])->name('customersearch');
Route::post('/getbalance', [App\Http\Controllers\CommonController::class, 'get_balance'])->name('balance'); 

Auth::routes();
Route::prefix('admin')->group(function () {

    // Admin Forgot Password Routes
    Route::get('/forgot-password', [App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    // Admin Reset Password Routes
    Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('/reset-password', [App\Http\Controllers\Auth\AdminResetPasswordController::class, 'reset'])->name('admin.password.update');
});


Route::prefix('admin')->group(function() {
    //Route::get('/', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('logout/', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function() {
        Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/myprofile', [App\Http\Controllers\Admin\HomeController::class, 'myprofile'])->name('admin.myprofile');
        Route::post('/updateprofile', [App\Http\Controllers\Admin\HomeController::class, 'updateprofile'])->name('admin.updateprofile');
        Route::get('/changepassword', [App\Http\Controllers\Admin\HomeController::class, 'changepassword'])->name('admin.changepassword');
        Route::post('/passwordchange', [App\Http\Controllers\Admin\HomeController::class, 'passwordchange'])->name('admin.passwordchange');

        Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
        Route::get('/add-user', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
        Route::get('/show-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user.show');
        Route::post('/add-user', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/edit-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');        
        Route::get('/delete-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.delete'); 
			        
		Route::get('/restaurants', [App\Http\Controllers\Admin\RestaurantController::class, 'index'])->name('admin.restaurant');
        Route::get('/add-restaurant', [App\Http\Controllers\Admin\RestaurantController::class, 'create'])->name('admin.restaurant.create');
        Route::get('/show-restaurant/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'show'])->name('admin.restaurant.show');
        Route::post('/add-restaurant', [App\Http\Controllers\Admin\RestaurantController::class, 'store'])->name('admin.restaurant.store');

        Route::get('/edit-restaurant/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'edit'])->name('admin.restaurant.edit');
        Route::post('/edit-restaurant/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'update'])->name('admin.restaurant.update');       

        Route::get('/delete-restaurant/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'destroy'])->name('admin.restaurant.delete'); 
		
        // Table Management for Restaurants
        Route::get('/table-numbers', [App\Http\Controllers\Admin\HomeController::class, 'tableNumberIndex'])->name('admin.table_numbers.index');
        Route::get('/table-numbers/create', [App\Http\Controllers\Admin\HomeController::class, 'createTableNumber'])->name('admin.table_numbers.create');
        Route::post('/table-numbers/store', [App\Http\Controllers\Admin\HomeController::class, 'storeTableNumber'])->name('admin.table_numbers.store');
        Route::get('/table-numbers/edit/{id}', [App\Http\Controllers\Admin\HomeController::class, 'editTableNumber'])->name('admin.table_numbers.edit');
        Route::post('/table-numbers/update/{id}', [App\Http\Controllers\Admin\HomeController::class, 'updateTableNumber'])->name('admin.table_numbers.update');

        Route::get('/table-numbers/delete/{id}', [App\Http\Controllers\Admin\HomeController::class, 'deleteTableNumber'])->name('admin.table_numbers.delete');



        //Route::get('/restaurant-kyc/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'kyc'])->name('admin.restaurant.kyc');
        //Route::post('/restaurant-kyc/{id}', [App\Http\Controllers\Admin\RestaurantController::class, 'kycupdate'])->name('admin.restaurant.kyc.update');
        
		Route::get('/admins', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.admins');
        Route::get('/add-admin', [App\Http\Controllers\Admin\AdminController::class, 'create'])->name('admin.admin.create');
        Route::post('/add-admin', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.admin.store');
        Route::get('/edit-admin/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.admin.edit');
        Route::post('/edit-admin/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admin.admin.update');        
        Route::get('/delete-admin/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.admin.delete');
		
        Route::get('/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.roles');
        Route::get('/add-role', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/add-role', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/edit-role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/edit-role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.role.update');
        Route::get('/delete-role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('admin.role.delete');
		Route::get('/permissionlist/{id}', [App\Http\Controllers\Admin\RoleController::class, 'permissionlist'])->name('admin.role.permissionlist');
        Route::post('/update-permission/{id}', [App\Http\Controllers\Admin\RoleController::class, 'updatepermission'])->name('admin.role.updatepermission');

        Route::get('/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('admin.permissions');
        Route::get('/add-permission', [App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('admin.role.permission');
        Route::post('/add-permission', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('/edit-permission/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::post('/edit-permission/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('admin.permission.update');
		
        Route::get('/transactions', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transactions');
		Route::get('/customersettlements', [App\Http\Controllers\Admin\CustomersettlementController::class, 'index'])->name('admin.customersettlements');
        Route::get('/add-customersettlement', [App\Http\Controllers\Admin\CustomersettlementController::class, 'create'])->name('admin.customersettlement.create');
        Route::post('/add-customersettlement', [App\Http\Controllers\Admin\CustomersettlementController::class, 'store'])->name('admin.customersettlement.store');
				
        Route::get('/websiteconfigs', [App\Http\Controllers\Admin\WebsiteconfigController::class, 'index'])->name('admin.websiteconfigs');
        Route::post('/edit-websiteconfig', [App\Http\Controllers\Admin\WebsiteconfigController::class, 'update'])->name('admin.websiteconfig.update');
		
        Route::get('/admincharges', [App\Http\Controllers\Admin\AdminchargeController::class, 'index'])->name('admin.admincharges');
		// Route::get('/tdscharges', [App\Http\Controllers\Admin\TdschargeController::class, 'index'])->name('admin.tdscharges');
        Route::resource('attendance', App\Http\Controllers\Admin\AttendanceController::class)
    ->names([
        'index'   => 'admin.attendance.index',
        'create'  => 'admin.attendance.create',
        'store'   => 'admin.attendance.store',
        'show'    => 'admin.attendance.show',
        'edit'    => 'admin.attendance.edit',
        'update'  => 'admin.attendance.update',
        'destroy' => 'admin.attendance.destroy',
    ]);
        Route::get('attendance-export', [AttendanceController::class, 'export'])->name('admin.attendance.export');	
    });
    
});



Route::prefix('restaurant')->group(function () {
    Route::get('/forgot-password', [App\Http\Controllers\Auth\RestaurantForgotPasswordController::class, 'showLinkRequestForm'])->name('restaurant.password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\RestaurantForgotPasswordController::class, 'sendResetLinkEmail'])->name('restaurant.password.email');
    Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\RestaurantResetPasswordController::class, 'showResetForm'])->name('restaurant.password.reset');
    // Route::post('/reset-password', [App\Http\Controllers\Auth\RestaurantResetPasswordController::class, 'reset'])->name('restaurant.password.update');
    Route::post('/password/reset', [App\Http\Controllers\Auth\RestaurantResetPasswordController::class, 'reset'])
    ->name('restaurant.password.update');

});

Route::prefix('restaurant')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\RestaurantLoginController::class, 'showLoginForm'])->name('restaurant.login');
    Route::post('/login', [App\Http\Controllers\Auth\RestaurantLoginController::class, 'login'])->name('restaurant.login.submit');
    Route::get('/logout', [App\Http\Controllers\Auth\RestaurantLoginController::class, 'logout'])->name('restaurant.logout');

    Route::middleware(['auth:restaurant'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Restaurant\HomeController::class, 'index'])->name('restaurant.dashboard');
        Route::get('/myprofile', [App\Http\Controllers\Restaurant\HomeController::class, 'myprofile'])->name('restaurant.myprofile');
        Route::post('/updateprofile', [App\Http\Controllers\Restaurant\HomeController::class, 'updateprofile'])->name('restaurant.updateprofile');
        Route::get('/changepassword', [App\Http\Controllers\Restaurant\HomeController::class, 'changepassword'])->name('restaurant.changepassword');
        Route::post('/passwordchange', [App\Http\Controllers\Restaurant\HomeController::class, 'passwordchange'])->name('restaurant.passwordchange');

         // KOT Route
        Route::get('/orders/kot', [KotController::class, 'index'])->name('restaurant.kot');
        Route::post('/orders/get-products', [KotController::class, 'getProductsByCategory'])->name('restaurant.getProducts');
        Route::post('/verify-coupon', [KotController::class, 'verifyCoupon'])->name('coupon.verify');
        Route::post('/place-order', [KotController::class, 'place_order'])->name('orders.place');
        Route::get('/generate-token/{id}', [KotController::class, 'generateToken'])->name('restaurant.generateToken');

        Route::get('/orders', [OrderController::class, 'index'])->name('restaurant.orders');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('restaurant.orders.view');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('restaurant.orders.delete');

        //Route::get('/tables', [RestaurantTablenumberController::class, 'index'])->name('restaurant.tables.index');
        Route::resource('/tables', App\Http\Controllers\Restaurant\RestaurantTablenumberController::class)
        ->names([
            'index' => 'restaurant.tables.index',
            'create' => 'restaurant.tables.create',
            'store' => 'restaurant.tables.store',
            'show' => 'restaurant.tables.show',
            'edit' => 'restaurant.tables.edit',
            'update' => 'restaurant.tables.update',
            'destroy' => 'restaurant.tables.destroy',
        ]);

        Route::resource('/categories', CategoryController::class)
        ->names([
            'index' => 'restaurant.categories.index',
            'create' => 'restaurant.categories.create',
            'store' => 'restaurant.categories.store',
            'show' => 'restaurant.categories.show',
            'edit' => 'restaurant.categories.edit',
            'update' => 'restaurant.categories.update',
            'destroy' => 'restaurant.categories.destroy',
        ]);

        Route::resource('/products', ProductController::class)
        ->names([
            'index' => 'restaurant.products.index',
            'create' => 'restaurant.products.create',
            'store' => 'restaurant.products.store',
            'show' => 'restaurant.products.show',
            'edit' => 'restaurant.products.edit',
            'update' => 'restaurant.products.update',
            'destroy' => 'restaurant.products.destroy',
        ]);

        Route::resource('/stocks', App\Http\Controllers\Restaurant\StockController::class)
        ->names([
            'index' => 'restaurant.stocks.index',
        ]);

        // Route::post('/restaurant/stocks/uploadBulk', [StockController::class, 'uploadBulk'])->name('restaurant.stocks.uploadBulk');


        // Route::delete('/restaurant/stocks/{id}', [StockController::class, 'destroy'])->name('restaurant.stocks.destroy');
        Route::get('/restaurant/stocks/downloadSample', [StockController::class, 'downloadSample'])->name('restaurant.stocks.downloadSample');

        Route::get('/stocks/create', [StockController::class, 'create'])->name('restaurant.stocks.create');
        // Route::post('/restaurant/stocks/store', [StockController::class, 'store'])->name('restaurant.stocks.store');
       
        Route::get('/stocks/products/{categoryId}', [StockController::class, 'getProductsByCategory'])
        ->name('restaurant.stocks.getProductsByCategory');

        Route::post('/stocks/uploadBulk', [StockController::class, 'uploadBulk'])->name('restaurant.stocks.uploadBulk');
        Route::delete('/stocks/{id}', [StockController::class, 'destroy'])->name('restaurant.stocks.destroy');

        Route::post('/stocks/updateBulk', [StockController::class, 'updateBulk'])->name('restaurant.stocks.updateBulk');
       
        // Route::get('/stocks/downloadSample', [StockController::class, 'downloadSample'])->name('restaurant.stocks.downloadSample');
        Route::post('/stocks/store', [StockController::class, 'store'])->name('restaurant.stocks.store');


        Route::post('/orders/update-status', [HomeController::class, 'updateOrderStatus'])->name('restaurant.orders.updateStatus');
        Route::post('/orders/change-status', [HomeController::class, 'changeOrderStatus'])->name('restaurant.orders.changeStatus');

        Route::get('/todays_stock', [StockController::class, 'todaysStock'])->name('restaurant.stocks.todays_stock');

        // Route::get('/dashboard', function () {
        //     return view('restaurant.dashboard');
        // })->name('restaurant.dashboard');
    });
});

// Delivery Purchases Management
Route::prefix('restaurant/purchases')->middleware('auth:restaurant')->group(function () {
    Route::get('/dine_in', [PurchaseController::class, 'dineInPurchases'])->name('restaurant.purchases.dine_in');
    Route::get('/home_delivery', [PurchaseController::class, 'homeDeliveryPurchases'])->name('restaurant.purchases.home_delivery');

    // Common Edit, Update, and Delete routes for both
    Route::get('/edit/{id}', [PurchaseController::class, 'edit'])->name('restaurant.purchases.edit');
    Route::post('/update/{id}', [PurchaseController::class, 'update'])->name('restaurant.purchases.update');
    Route::delete('/delete/{id}', [PurchaseController::class, 'destroy'])->name('restaurant.purchases.delete');
});


Route::middleware(['auth:restaurant'])->prefix('restaurant')->name('restaurant.')->group(function () {
    Route::resource('employees', App\Http\Controllers\Restaurant\EmployeeController::class);
});
Route::middleware(['auth:restaurant'])->prefix('restaurant')->name('restaurant.')->group(function () {
    Route::resource('roles', App\Http\Controllers\Restaurant\RoleController::class);
    Route::resource('permissions', App\Http\Controllers\Restaurant\PermissionController::class);
});

Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'login'])->name('login.submit');
    Route::get('/logout', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:employee')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Employee\HomeController::class, 'index'])->name('dashboard');
        Route::get('/myprofile', [App\Http\Controllers\Employee\HomeController::class, 'myprofile'])->name('myprofile');
        Route::post('/updateprofile', [App\Http\Controllers\Employee\HomeController::class, 'updateprofile'])->name('updateprofile');
        Route::get('/changepassword', [App\Http\Controllers\Employee\HomeController::class, 'changepassword'])->name('changepassword');
        Route::post('/passwordchange', [App\Http\Controllers\Employee\HomeController::class, 'passwordchange'])->name('passwordchange');

        Route::get('/orders/kot', [App\Http\Controllers\Employee\KotController::class, 'index'])->name('kot');
        Route::post('/orders/get-products', [App\Http\Controllers\Employee\KotController::class, 'getProductsByCategory'])->name('getProducts');
        Route::post('/verify-coupon', [App\Http\Controllers\Employee\KotController::class, 'verifyCoupon'])->name('coupon.verify');
        Route::post('/place-order', [App\Http\Controllers\Employee\KotController::class, 'placeOrder'])->name('orders.place');
        Route::get('/generate-token/{id}', [App\Http\Controllers\Employee\KotController::class, 'generateToken'])->name('generateToken');

        Route::get('/orders', [App\Http\Controllers\Employee\OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [App\Http\Controllers\Employee\OrderController::class, 'show'])->name('orders.view');
        Route::delete('/orders/{id}', [App\Http\Controllers\Employee\OrderController::class, 'destroy'])->name('orders.delete');

        Route::resource('/tables', App\Http\Controllers\Employee\RestaurantTablenumberController::class)
        ->names([
            'index' => 'tables.index',
            'create' => 'tables.create',
            'store' => 'tables.store',
            'show' => 'tables.show',
            'edit' => 'tables.edit',
            'update' => 'tables.update',
            'destroy' => 'tables.destroy',
        ]);

        Route::resource('/categories', App\Http\Controllers\Employee\CategoryController::class)
        ->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'show' => 'categories.show',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);

        Route::resource('/products', App\Http\Controllers\Employee\ProductController::class)
        ->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);


        Route::get('/stocks', [App\Http\Controllers\Employee\StockController::class, 'index'])->name('stocks.index');
        Route::get('/employee/stocks/downloadSample', [App\Http\Controllers\Employee\StockController::class, 'downloadSample'])->name('stocks.downloadSample');

        Route::get('/stocks/create', [App\Http\Controllers\Employee\StockController::class, 'create'])->name('stocks.create');
     
       
        Route::get('/stocks/products/{categoryId}', [App\Http\Controllers\Employee\StockController::class, 'getProductsByCategory'])
        ->name('stocks.getProductsByCategory');

        Route::post('/stocks/uploadBulk', [App\Http\Controllers\Employee\StockController::class, 'uploadBulk'])->name('stocks.uploadBulk');
        Route::delete('/stocks/{id}', [App\Http\Controllers\Employee\StockController::class, 'destroy'])->name('stocks.destroy');

        Route::post('/stocks/updateBulk', [App\Http\Controllers\Employee\StockController::class, 'updateBulk'])->name('stocks.updateBulk');
       
   
        Route::post('/stocks/store', [App\Http\Controllers\Employee\StockController::class, 'store'])->name('stocks.store');


        Route::post('/orders/update-status', [App\Http\Controllers\Employee\HomeController::class, 'updateOrderStatus'])->name('orders.updateStatus');
        Route::post('/orders/change-status', [App\Http\Controllers\Employee\HomeController::class, 'changeOrderStatus'])->name('orders.changeStatus');

        Route::get('/todays_stock', [App\Http\Controllers\Employee\StockController::class, 'todaysStock'])->name('stocks.todays_stock');
    });
});

Route::prefix('employee')->group(function () {
    Route::get('/forgot-password', [App\Http\Controllers\Auth\EmployeeForgotPasswordController::class, 'showLinkRequestForm'])->name('employee.password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\EmployeeForgotPasswordController::class, 'sendResetLinkEmail'])->name('employee.password.email');
    Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\EmployeeResetPasswordController::class, 'showResetForm'])->name('employee.password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Auth\EmployeeResetPasswordController::class, 'reset'])
    ->name('employee.password.update');

});

Route::prefix('employee/purchases')->middleware('auth:employee')->group(function () {
    Route::get('/dine_in', [App\Http\Controllers\Employee\PurchaseController::class, 'dineInPurchases'])->name('employee.purchases.dine_in');
    Route::get('/home_delivery', [App\Http\Controllers\Employee\PurchaseController::class, 'homeDeliveryPurchases'])->name('employee.purchases.home_delivery');

    // Common Edit, Update, and Delete routes for both
    Route::get('/edit/{id}', [App\Http\Controllers\Employee\PurchaseController::class, 'edit'])->name('employee.purchases.edit');
    Route::post('/update/{id}', [App\Http\Controllers\Employee\PurchaseController::class, 'update'])->name('employee.purchases.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\Employee\PurchaseController::class, 'destroy'])->name('employee.purchases.delete');
});

// Route::prefix('employee')->name('employee.')->middleware('auth:employee')->group(function () {
//     Route::get('/test-auth', function () {
//         return response()->json(['user' => auth()->guard('employee')->user()]);
//     });
// });


