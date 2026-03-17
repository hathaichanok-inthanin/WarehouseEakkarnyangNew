<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
	Artisan::call('config:cache');
    return 'DONE';
});


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// แอดมินผู้ดูแลระบบ
Route::group(['prefix' => '/'], function(){
    Route::get('register',[App\Http\Controllers\AuthAdmin\RegisterController::class, 'ShowRegisterForm']);
    Route::post('register',[App\Http\Controllers\AuthAdmin\RegisterController::class, 'register']);

    Route::get('login',[App\Http\Controllers\AuthAdmin\LoginController::class, 'ShowLoginForm'])->name('admin.login');
    Route::post('login',[App\Http\Controllers\AuthAdmin\LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('logout',[App\Http\Controllers\AuthAdmin\LoginController::class, 'logout'])->name('admin.logout');

    // Dashboard หลัก
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // จัดการบัญชีผู้ดูแลระบบ
    Route::get('register-admin',[App\Http\Controllers\Backend\AdminController::class, 'registerAdmin']);
    Route::get('account-admin',[App\Http\Controllers\Backend\AdminController::class, 'accountAdmin']);
    Route::get('delete-account-admin/{id}',[App\Http\Controllers\Backend\AdminController::class, 'deleteAccountAdmin']);
    Route::get('edit-account-admin/{id}',[App\Http\Controllers\Backend\AdminController::class, 'editAccountAdmin']);
    Route::post('update-account-admin',[App\Http\Controllers\Backend\AdminController::class, 'updateAccountAdmin']);

    // จัดการบัญชีสาขา
    Route::get('register-branch-account',[App\Http\Controllers\Backend\AdminController::class, 'registerBranchAccount']);
    Route::post('register-branch-account',[App\Http\Controllers\Backend\AdminController::class, 'registerBranchAccountPost']);
    Route::get('account-branch',[App\Http\Controllers\Backend\AdminController::class, 'accountBranch']);
    Route::get('delete-account-branch/{id}',[App\Http\Controllers\Backend\AdminController::class, 'deleteAccountBranch']);
    Route::get('edit-account-branch/{id}',[App\Http\Controllers\Backend\AdminController::class, 'editAccountBranch']);
    Route::post('update-account-branch',[App\Http\Controllers\Backend\AdminController::class, 'updateAccountBranch']);

    // จัดการธุรกิจค้าส่ง
    Route::get('register-wholesale-business',[App\Http\Controllers\Backend\AdminController::class, 'registerWholesaleBusiness']);
    Route::post('register-wholesale-business',[App\Http\Controllers\Backend\AdminController::class, 'registerWholesaleBusinessPost']);
    Route::get('account-wholesale-business',[App\Http\Controllers\Backend\AdminController::class, 'accountWholesaleBusiness']);
    Route::get('delete-account-wholesale-business/{id}',[App\Http\Controllers\Backend\AdminController::class, 'deleteAccountWholesaleBusiness']);
    Route::get('edit-account-wholesale-business/{id}',[App\Http\Controllers\Backend\AdminController::class, 'editAccountWholesaleBusiness']);
    Route::post('update-account-wholesale-business',[App\Http\Controllers\Backend\AdminController::class, 'updateAccountWholesaleBusiness']);

    // คลังสินค้า
    Route::get('create-warehouse',[App\Http\Controllers\Backend\AdminController::class, 'createWarehouse']);
    Route::post('create-warehouse',[App\Http\Controllers\Backend\AdminController::class, 'createWarehousePost']);
    Route::get('warehouse',[App\Http\Controllers\Backend\AdminController::class, 'warehouse']);
    Route::get('delete-warehouse/{id}',[App\Http\Controllers\Backend\AdminController::class, 'deleteWarehouse']);
    Route::get('edit-warehouse/{id}',[App\Http\Controllers\Backend\AdminController::class, 'editWarehouse']);
    Route::post('update-warehouse',[App\Http\Controllers\Backend\AdminController::class, 'updateWarehouse']);

    Route::get('tyre-warehouse-main',[App\Http\Controllers\Backend\WarehouseMainController::class, 'tyreWarehouseMain']);
    Route::get('create-tyre-warehouse-main',[App\Http\Controllers\Backend\WarehouseMainController::class, 'createTyreWarehouseMain']);
    Route::post('create-tyre-warehouse-main',[App\Http\Controllers\Backend\WarehouseMainController::class, 'createTyreWarehouseMainPost']);

    Route::get('tyre-warehouse-khokkloi',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'tyreWarehouseKhokkloi']);
    Route::get('create-tyre-warehouse-khokkloi',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'createTyreWarehouseKhokkloi']);
    Route::post('create-tyre-warehouse-khokkloi',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'createTyreWarehouseKhokkloiPost']);

    Route::get('tyre-warehouse-thalang',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'tyreWarehouseThalang']);
    Route::get('create-tyre-warehouse-thalang',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'createTyreWarehouseThalang']);
    Route::post('create-tyre-warehouse-thalang',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'createTyreWarehouseThalangPost']);
    
    Route::get('tyre-warehouse-chaofa',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'tyreWarehouseChaofa']);
    Route::get('create-tyre-warehouse-chaofa',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'createTyreWarehouseChaofa']);
    Route::post('create-tyre-warehouse-chaofa',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'createTyreWarehouseChaofaPost']);

    Route::get('tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'tyreWarehouseThaiwatsadu']);
    Route::get('create-tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'createTyreWarehouseThaiwatsadu']);
    Route::post('create-tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'createTyreWarehouseThaiwatsaduPost']);

    Route::get('tyre-warehouse-bypass',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'tyreWarehouseBypass']);
    Route::get('create-tyre-warehouse-bypass',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'createTyreWarehouseBypass']);
    Route::post('create-tyre-warehouse-bypass',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'createTyreWarehouseBypassPost']);

    Route::get('tyre-warehouse-phangnga',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'tyreWarehousePhangnga']);
    Route::get('create-tyre-warehouse-phangnga',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'createTyreWarehousePhangnga']);
    Route::post('create-tyre-warehouse-phangnga',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'createTyreWarehousePhangngaPost']);

    Route::get('tyre-warehouse-suratthani',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'tyreWarehouseSuratthani']);
    Route::get('create-tyre-warehouse-suratthani',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'createTyreWarehouseSuratthani']);
    Route::post('create-tyre-warehouse-suratthani',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'createTyreWarehouseSuratthaniPost']);

    // จัดการข้อมูลสินค้า
    Route::get('tyre-brand',[App\Http\Controllers\Backend\DashboardController::class, 'tyreBrand']);
    Route::post('create-tyre-brand',[App\Http\Controllers\Backend\DashboardController::class, 'createTyreBrand']);
    Route::get('delete-tyre-brand/{id}' ,[App\Http\Controllers\Backend\DashboardController::class, 'deleteTyreBrand']);
    Route::get('edit-tyre-brand/{id}',[App\Http\Controllers\Backend\DashboardController::class, 'editTyreBrand']);
    Route::post('update-tyre-brand', [App\Http\Controllers\Backend\DashboardController::class, 'updateTyreBrand']);

    Route::get('tyre-model',[App\Http\Controllers\Backend\DashboardController::class, 'tyreModel']);
    Route::post('create-tyre-model',[App\Http\Controllers\Backend\DashboardController::class, 'createTyreModel']);
    Route::get('delete-tyre-model/{id}' ,[App\Http\Controllers\Backend\DashboardController::class, 'deleteTyreModel']);
    Route::get('edit-tyre-model/{id}',[App\Http\Controllers\Backend\DashboardController::class, 'editTyreModel']);
    Route::post('update-tyre-model', [App\Http\Controllers\Backend\DashboardController::class, 'updateTyreModel']);


    Route::group(['prefix' => 'main'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehouseMainController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehouseMainController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehouseMainController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehouseMainController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehouseMainController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'khokkloi'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'thalang'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'chaofa'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'thaiwatsadu'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'bypass'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'phangnga'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'suratthani'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'deleteStockTyre']);

        // แก้ไข ลบรายการสินค้า
        Route::get('delete-tyre/{id}',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'deleteTyre']);
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'search'], function(){ 
        Route::post('tyre-warehouse-main',[App\Http\Controllers\Backend\WarehouseMainController::class, 'searchTyreWarehouseMain']);        
        Route::post('tyre-warehouse-khokkloi',[App\Http\Controllers\Backend\WarehouseKhokkloiController::class, 'searchTyreWarehouseKhokkloi']);
        Route::post('tyre-warehouse-thalang',[App\Http\Controllers\Backend\WarehouseThalangController::class, 'searchTyreWarehouseThalang']);
        Route::post('tyre-warehouse-chaofa',[App\Http\Controllers\Backend\WarehouseChaofaController::class, 'searchTyreWarehouseChaofa']);
        Route::post('tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Backend\WarehouseThaiwatsaduController::class, 'searchTyreWarehouseThaiwatsadu']);
        Route::post('tyre-warehouse-bypass',[App\Http\Controllers\Backend\WarehouseBypassController::class, 'searchTyreWarehouseBypass']);
        Route::post('tyre-warehouse-phangnga',[App\Http\Controllers\Backend\WarehousePhangngaController::class, 'searchTyreWarehousePhangnga']);
        Route::post('tyre-warehouse-suratthani',[App\Http\Controllers\Backend\WarehouseSuratthaniController::class, 'searchTyreWarehouseSuratthani']);
    });

    // เลือกยี่ห้อยางรถยนต์
    Route::get('brand-tyre/{brand_name}',[App\Http\Controllers\Backend\WarehouseMainController::class, 'brandTyreName']);

});

// พนักงาน
Route::group(['prefix' => 'staff'], function(){
    Route::get('/login',[App\Http\Controllers\AuthStaff\LoginController::class, 'ShowLoginForm'])->name('staff.login');
    Route::post('/login',[App\Http\Controllers\AuthStaff\LoginController::class, 'login'])->name('staff.login.submit');
    Route::post('/logout', [App\Http\Controllers\AuthStaff\LoginController::class, 'logout'])->name('staff.logout');

    Route::get('tyre-warehouse-main',[App\Http\Controllers\Staff\WarehouseMainController::class, 'tyreWarehouseMain'])->name('staff.home');
    Route::get('create-tyre-warehouse-main',[App\Http\Controllers\Staff\WarehouseMainController::class, 'createTyreWarehouseMain']);
    Route::post('create-tyre-warehouse-main',[App\Http\Controllers\Staff\WarehouseMainController::class, 'createTyreWarehouseMainPost']);

    Route::get('tyre-warehouse-khokkloi',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'tyreWarehouseKhokkloi']);
    Route::get('create-tyre-warehouse-khokkloi',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'createTyreWarehouseKhokkloi']);
    Route::post('create-tyre-warehouse-khokkloi',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'createTyreWarehouseKhokkloiPost']);

    Route::get('tyre-warehouse-thalang',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'tyreWarehouseThalang']);
    Route::get('create-tyre-warehouse-thalang',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'createTyreWarehouseThalang']);
    Route::post('create-tyre-warehouse-thalang',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'createTyreWarehouseThalangPost']);

    Route::get('tyre-warehouse-chaofa',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'tyreWarehouseChaofa']);
    Route::get('create-tyre-warehouse-chaofa',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'createTyreWarehouseChaofa']);
    Route::post('create-tyre-warehouse-chaofa',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'createTyreWarehouseChaofaPost']);

    Route::get('tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'tyreWarehouseThaiwatsadu']);
    Route::get('create-tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'createTyreWarehouseThaiwatsadu']);
    Route::post('create-tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'createTyreWarehouseThaiwatsaduPost']);

    Route::get('tyre-warehouse-bypass',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'tyreWarehouseBypass']);
    Route::get('create-tyre-warehouse-bypass',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'createTyreWarehouseBypass']);
    Route::post('create-tyre-warehouse-bypass',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'createTyreWarehouseBypassPost']);

    Route::get('tyre-warehouse-phangnga',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'tyreWarehousePhangnga']);
    Route::get('create-tyre-warehouse-phangnga',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'createTyreWarehousePhangnga']);
    Route::post('create-tyre-warehouse-phangnga',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'createTyreWarehousePhangngaPost']);

    Route::get('tyre-warehouse-suratthani',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'tyreWarehouseSuratthani']);
    Route::get('create-tyre-warehouse-suratthani',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'createTyreWarehouseSuratthani']);
    Route::post('create-tyre-warehouse-suratthani',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'createTyreWarehouseSuratthaniPost']);

    Route::group(['prefix' => 'search'], function(){ 
        Route::post('tyre-warehouse-main',[App\Http\Controllers\Staff\WarehouseMainController::class, 'searchTyreWarehouseMain']);  
        Route::post('tyre-warehouse-khokkloi',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'searchTyreWarehouseKhokkloi']);
        Route::post('tyre-warehouse-thalang',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'searchTyreWarehouseThalang']);
        Route::post('tyre-warehouse-chaofa',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'searchTyreWarehouseChaofa']);
        Route::post('tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'searchTyreWarehouseThaiwatsadu']);
        Route::post('tyre-warehouse-bypass',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'searchTyreWarehouseBypass']);
        Route::post('tyre-warehouse-phangnga',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'searchTyreWarehousePhangnga']);
        Route::post('tyre-warehouse-suratthani',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'searchTyreWarehouseSuratthani']);
    });

    Route::group(['prefix' => 'khokkloi'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'deleteStockTyre']);

        // แก้ไขรายการสินค้า
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Staff\WarehouseKhokkloiController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'thalang'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'deleteStockTyre']);

        // แก้ไขรายการสินค้า
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Staff\WarehouseThalangController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'chaofa'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'deleteStockTyre']);

        // แก้ไขรายการสินค้า
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Staff\WarehouseChaofaController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'thaiwatsadu'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'deleteStockTyre']);

        // แก้ไขรายการสินค้า
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Staff\WarehouseThaiwatsaduController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'bypass'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'deleteStockTyre']);

        // แก้ไขรายการสินค้า
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Staff\WarehouseBypassController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'phangnga'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'deleteStockTyre']);

        // แก้ไขรายการสินค้า
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Staff\WarehousePhangngaController::class, 'updateTyre']);
    });

    Route::group(['prefix' => 'suratthani'], function(){
        // อัพเดต เพิ่ม-ลด สินค้าในคลัง
        Route::post('add-stock-tyre',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'addStockTyre']);
        Route::post('delete-stock-tyre',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'deleteStockTyre']);

        // แก้ไขรายการสินค้า
        Route::get('edit-tyre/{id}',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'editTyre']);
        Route::post('update-tyre',[App\Http\Controllers\Staff\WarehouseSuratthaniController::class, 'updateTyre']);
    });

});

// ธุรกิจค้าส่ง
Route::group(['prefix' => 'customer'], function(){
    Route::get('/login',[App\Http\Controllers\AuthCustomer\LoginController::class, 'ShowLoginForm'])->name('customer.login');
    Route::post('/login',[App\Http\Controllers\AuthCustomer\LoginController::class, 'login'])->name('customer.login.submit');
    Route::post('/logout', [App\Http\Controllers\AuthCustomer\LoginController::class, 'logout'])->name('customer.logout');

    Route::get('tyre-warehouse-main',[App\Http\Controllers\Customer\WarehouseMainController::class, 'tyreWarehouseMain'])->name('customer.home');
    Route::get('tyre-warehouse-khokkloi',[App\Http\Controllers\Customer\WarehouseKhokkloiController::class, 'tyreWarehouseKhokkloi']);
    Route::get('tyre-warehouse-thalang',[App\Http\Controllers\Customer\WarehouseThalangController::class, 'tyreWarehouseThalang']);
    Route::get('tyre-warehouse-chaofa',[App\Http\Controllers\Customer\WarehouseChaofaController::class, 'tyreWarehouseChaofa']);
    Route::get('tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Customer\WarehouseThaiwatsaduController::class, 'tyreWarehouseThaiwatsadu']);
    Route::get('tyre-warehouse-bypass',[App\Http\Controllers\Customer\WarehouseBypassController::class, 'tyreWarehouseBypass']);
    Route::get('tyre-warehouse-phangnga',[App\Http\Controllers\Customer\WarehousePhangngaController::class, 'tyreWarehousePhangnga']);
    Route::get('tyre-warehouse-suratthani',[App\Http\Controllers\Customer\WarehouseSuratthaniController::class, 'tyreWarehouseSuratthani'])->name('customer.suratthani');
    Route::get('stock-all-warehouse',[App\Http\Controllers\Customer\WarehouseController::class, 'stockAllWarehouse']);

    Route::group(['prefix' => 'search'], function(){ 
        Route::post('tyre-warehouse-main',[App\Http\Controllers\Customer\WarehouseMainController::class, 'searchTyreWarehouseMain']);        
        Route::post('tyre-warehouse-khokkloi',[App\Http\Controllers\Customer\WarehouseKhokkloiController::class, 'searchTyreWarehouseKhokkloi']);
        Route::post('tyre-warehouse-thalang',[App\Http\Controllers\Customer\WarehouseThalangController::class, 'searchTyreWarehouseThalang']);
        Route::post('tyre-warehouse-chaofa',[App\Http\Controllers\Customer\WarehouseChaofaController::class, 'searchTyreWarehouseChaofa']);
        Route::post('tyre-warehouse-thaiwatsadu',[App\Http\Controllers\Customer\WarehouseThaiwatsaduController::class, 'searchTyreWarehouseThaiwatsadu']);
        Route::post('tyre-warehouse-bypass',[App\Http\Controllers\Customer\WarehouseBypassController::class, 'searchTyreWarehouseBypass']); 
        Route::post('tyre-warehouse-phangnga',[App\Http\Controllers\Customer\WarehousePhangngaController::class, 'searchTyreWarehousePhangnga']);
        Route::post('tyre-warehouse-suratthani',[App\Http\Controllers\Customer\WarehouseSuratthaniController::class, 'searchTyreWarehouseSuratthani']);
    });
});