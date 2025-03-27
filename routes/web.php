<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Restaurant\KotController;
use App\Http\Controllers\Restaurant\OrderController;
use App\Http\Controllers\Restaurant\StockController;
use App\Http\Controllers\Restaurant\ProductController;
use App\Http\Controllers\Restaurant\CategoryController;
use App\Http\Controllers\Restaurant\RestaurantTablenumberController;
use App\Http\Controllers\Restaurant\HomeController;

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
				
    });
    
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

        // Route::get('/dashboard', function () {
        //     return view('restaurant.dashboard');
        // })->name('restaurant.dashboard');
    });
});
