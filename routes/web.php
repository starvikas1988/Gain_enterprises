<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Services\XeroService;

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

//use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Restaurant\QrCodeController;
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



// Route::get('/qr', [QrCodeController::class, 'index']);
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

   // Driver Routes
        Route::get('/drivers', [App\Http\Controllers\Admin\DriverController::class, 'index'])->name('admin.drivers');
        Route::get('/add-driver', [App\Http\Controllers\Admin\DriverController::class, 'create'])->name('admin.driver.create');
        Route::post('/add-driver', [App\Http\Controllers\Admin\DriverController::class, 'store'])->name('admin.driver.store');
        Route::get('/show-driver/{id}', [App\Http\Controllers\Admin\DriverController::class, 'show'])->name('admin.driver.show');
        Route::get('/edit-driver/{id}', [App\Http\Controllers\Admin\DriverController::class, 'edit'])->name('admin.driver.edit');
        Route::post('/edit-driver/{id}', [App\Http\Controllers\Admin\DriverController::class, 'update'])->name('admin.driver.update');
        Route::get('/delete-driver/{id}', [App\Http\Controllers\Admin\DriverController::class, 'destroy'])->name('admin.driver.delete');

    
        Route::get('/stores', [App\Http\Controllers\Admin\StoreController::class, 'index'])->name('admin.stores');
        Route::get('/add-store', [App\Http\Controllers\Admin\StoreController::class, 'create'])->name('admin.store.create');
        Route::post('/add-store', [App\Http\Controllers\Admin\StoreController::class, 'store'])->name('admin.store.store');
        Route::get('/show-store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'show'])->name('admin.store.show');
        Route::get('/edit-store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'edit'])->name('admin.store.edit');
        Route::post('/edit-store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'update'])->name('admin.store.update');
        Route::get('/delete-store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'destroy'])->name('admin.store.delete');



			        
		Route::get('/products', [App\Http\Controllers\Admin\RestaurantController::class, 'index'])->name('admin.restaurant');
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



