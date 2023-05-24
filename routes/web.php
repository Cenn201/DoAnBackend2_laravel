<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserCategoryProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\User\UserAddressController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserOderDetailController;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});
//group customer user
Route::group(['prefix' => 'customer'], function () {
    //login view
    Route::get('/login', [CustomAuthController::class, 'showLogin'])->name('showLogin');
    //login submit
    Route::post('/login-request', [CustomAuthController::class, 'handleLogin'])->name('handleLogin.custom');
    //register view
    Route::get('/register', [CustomAuthController::class, 'showRegister'])->name('showRegister');;
    //register submit
    Route::post('/register-request', [CustomAuthController::class, 'handleRegister'])->name('handleRegister.custom');
    //signout
    Route::get('/signout', [CustomAuthController::class, 'signOut'])->name('signout');
    //change password view
    Route::get('/forget-password', [CustomAuthController::class, 'changePasswordShow'])->name('customer.showChangePassword');
    //change password
    Route::post('/change-password', [CustomAuthController::class, 'editPassword'])->name('customer.changepassword');
});
//dashboard 
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
//group product type user
Route::group(['prefix' => 'usercategory'], function(){
    //show list product by category
    Route::resource('usercategoryProduct', UserCategoryProductController::class);

});
// group cart user
Route::group(['prefix' => 'usercart'], function(){
    Route::resource('usercarts',UserCartController::class);
    Route::post('deleteProduct',[UserCartController::class,'destroy'])->name('carts.destroy');
});
// group product user
Route::group(['prefix' => 'userproducts'], function () {
    //show product
    Route::resource('userproduct', UserProductController::class);
    //show detail product
    Route::get('/product-detail/{id}', [UserProductController::class, 'show'])->name('showProductDetail');
    Route::post('cart/add', [UserCartController::class, 'store'])->name('cart.add');
});
//group order product user
Route::group(['oder-product'=>'useroder'],function(){
    Route::resource('userorders', UserOrderController::class);
    Route::post('userorder/product', [UserOrderController::class,'create'])->name('userorders.create');
    Route::get('order-product/{product_ids}/{quantity}',[UserOrderController::class,'index'])->name('useroderproducts.index');
    // Route::post('order-product/product',[UserOrderController::class,'index'])->name('useroderproducts.index');
});


//group user
Route::resource('users',UserController::class);
Route::resource('diachi',UserAddressController::class);
Route::resource('loaisanpham',TypeProductController::class);
Route::resource('donhang',UserOderDetailController::class);
//show ra toàn bộ địa chỉ ủa user có id đã đăng nhập
Route::get('/user/{id}/address', [UserAddressController::class, 'address'])->name('user.address');

//sau khi sửa xong địa chỉ
Route::put('/user/{id}/address',  [UserAddressController::class, 'update'])->name('diachi.update');

// trang thái đang giao
Route::get('/oderDetail/status_dangGiao',  [UserOderDetailController::class, 'status_dangGiao'])->name('oderDetail.status_dangGiao');
// trang thái đã  giao
Route::get('/oderDetail/status_daGiao',  [UserOderDetailController::class, 'status_daGiao'])->name('oderDetail.status_daGiao');