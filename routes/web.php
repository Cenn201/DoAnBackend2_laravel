<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserCategoryProductController;
use App\Http\Controllers\Admin\CouponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\User\UserAddressController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserOderDetailController;
use App\Models\User;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ProductController;
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
//show Categories
Route::get('show-categories',[CategoryProductController::class,'ListCategroies'])->name("listcategories");
//add Categories
Route::post('add-categories',[CategoryProductController::class,'AddCategories'])->name("addcategories");
//addScreen Categories
Route::get('addScreen-categories',[CategoryProductController::class,'AddScreenCategroies'])->name("addscreencategories");
//edit Categories
Route::post('edit-categories/{id}',[CategoryProductController::class,'EditCategories'])->name("editcategories");
//editScreen Categories
Route::get('editScreen-categories/{id}',[CategoryProductController::class,'EditScreenCategroies'])->name("editscreencategories");
//remove Categories
Route::get('remove-categories/{id}',[CategoryProductController::class,'RemoveCategories'])->name("removecategories");
//seek Categories  
Route::get('seek-category',[CategoryProductController::class,'SeekCategory'])->name("seekcategory");
//show Product
Route::get('show-product',[ProductController::class,'ListProduct'])->name('listProduct');
//addScreen Product
Route::get('addScreen-product',[ProductController::class,'AddScreenProduct'])->name("addscreenproduct");
//add Product
Route::post('add-product',[ProductController::class,'AddProduct'])->name("addproduct");
//editScreen Product
Route::get('editScreen-product/{id}',[ProductController::class,'EditScreenProduct'])->name("editscreenproduct");
//edit Product
Route::post('edit-product/{id}',[ProductController::class,'EditProduct'])->name("editproduct");
//remove Product
Route::get('remove-product/{id}',[ProductController::class,'RemoveProduct'])->name("removeproduct");
//seek Product  
Route::get('seek-product',[ProductController::class,'SeekProduct'])->name("seekproduct");
//arrange Product  
Route::get('arrange-product',[ProductController::class,'ArrangeProduct'])->name("arrangeproduct");//hiển thị đơn hàng
Route::get('manage-order',[OrderController::class,'index'])->name('index');
//Hiển thị chi tiết đơn hàng theo ID
Route::get('view-order/{orderId}',[OrderController::class,'view_order'])->name('view_order');
//update trạng thái đơn hàng
Route::post('update-status/{id}',[OrderController::class,'updateStatus'])->name('updateStatus');
Route::get('cancel-order/{order_id}',[OrderController::class,'cancel_order'])->name('cancel_order');
//in hóa đơn
Route::get('print-order/{order_id}',[OrderController::class,'print_order'])->name('print_order');
//Hiển thị danh sách khuyến mại
Route::get('list-coupon',[CouponController::class,'list_coupon'])->name('list_coupon');
//Hiển thị thêm khuyến mại
Route::get('insert-coupon',[CouponController::class,'insert_coupon'])->name('insert_coupon');
//Thêm khuyến mại
Route::post('add-coupon',[CouponController::class,'insert_coupon_code'])->name('insert_coupon_code');
//Xóa khuyến mại 
Route::get('delete-coupon/{coupon_id}',[CouponController::class,'delete_coupon'])->name('delete_coupon');

// trang thái đang giao
Route::get('/oderDetail/status_dangGiao',  [UserOderDetailController::class, 'status_dangGiao'])->name('oderDetail.status_dangGiao');
// trang thái đã  giao
Route::get('/oderDetail/status_daGiao',  [UserOderDetailController::class, 'status_daGiao'])->name('oderDetail.status_daGiao');