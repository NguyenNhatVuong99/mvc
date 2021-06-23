<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('user', 'UserController');
// Route::get('user/getData', 'UserController@getData')->name('users.getData');
Route::get('/','FrontendController@home')->name('home');

Auth::routes(['register'=>false]);
Route::group(['namespace'=>'Auth'],function(){
    Route::get('dang-nhap','LoginController@index')->name('login.get');
Route::post('dang-nhap','LoginController@login')->name('login.post');
Route::get('logout','LoginController@logout')->name('\logout');

Route::get('user/register','RegisterController@register')->name('register.form');
Route::post('user/register','RegisterController@registerSubmit')->name('register.submit');
// Reset password
Route::get('quen-mat-khau', 'ResetPasswordController@index')->name('password.reset.index'); 
Route::post('quen-mat-khau', 'ResetPasswordController@sendMail')->name('password.reset.sendMail');
Route::put('quen-mat-khau/{token}', 'ResetPasswordController@reset')->name('password.reset');
// Socialite 
Route::get('login/{provider}/', 'LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'LoginController@Callback')->name('login.callback');

});


// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/about-us','FrontendController@aboutUs')->name('about-us');
Route::get('/contact','FrontendController@contact')->name('contact');
Route::post('/contact/message','MessageController@store')->name('contact.store');
Route::get('product-detail/{slug}','FrontendController@productDetail')->name('product-detail');
Route::post('/product/search','FrontendController@productSearch')->name('product.search');
Route::get('/product-cat/{slug}','FrontendController@productCat')->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}','FrontendController@productSubCat')->name('product-sub-cat');
Route::get('/product-brand/{slug}','FrontendController@productBrand')->name('product-brand');
// Cart section
// Route::get('/add-to-cart/{slug}','CartController@addToCart')->name('add-to-cart');
Route::post('/add-to-cart','CartController@addCart')->name('add-to-cart');
Route::post('delete-cart','CartController@deleteCart')->name('delete-cart');
Route::post('update-cart','CartController@updateCart')->name('cart.update');
Route::post('cart/order','CartController@order')->name('cart.order');
Route::post('service-ship','CartController@serviceShip');
Route::post('route-ship','CartController@routeShip');
Route::post('add-shipping','CartController@shipping');

Route::get('/cart','CartController@index')->name('cart.index');
Route::get('/checkout','CartController@checkout')->name('checkout')->middleware(['user','auth']);

// Route::post('cart/order','OrderController@store')->name('cart.order');
Route::get('order/pdf/{id}','OrderController@pdf')->name('order.pdf');
Route::get('/income','OrderController@incomeChart')->name('product.order.income');
// Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
Route::get('/product-grids','FrontendController@productGrids')->name('product-grids');
Route::get('/product-lists','FrontendController@productLists')->name('product-lists');
Route::match(['get','post'],'/filter','FrontendController@productFilter')->name('shop.filter');
// Order Track
Route::get('/product/track','OrderController@orderTrack')->name('order.track');
Route::post('product/track/order','OrderController@productTrackOrder')->name('product.track.order');

// NewsLetter
Route::post('/subscribe','FrontendController@subscribe')->name('subscribe');

// Product Review
Route::resource('/review','ProductReviewController');
Route::post('product/{slug}/review','ProductReviewController@store')->name('review.store');

// Post Comment 
Route::post('post/{slug}/comment','PostCommentController@store')->name('post-comment.store');
Route::resource('/comment','PostCommentController');
// Coupon
Route::post('/coupon','CartController@coupon');

Route::post('/coupon-store','CouponController@couponStore')->name('coupon-store');
// Payment
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');

Route::group(['prefix'=>'admin','namespace'=>'Admin','as'=>'admin.','middleware'=>['auth','admin']],function(){

    Route::get('/','AdminController@index')->name('index');
    Route::resource('tai-khoan','UserController', ['names' => 'user'])->except('show');
    Route::resource('nhan-vien','PersonelController', ['names' => 'personel'])->except('show','edit');
    Route::resource('quyen-truy-cap','RoleController', ['names' => 'role'])->except('update');
    Route::resource('ca-lam-viec','ShiftController', ['names' => 'shift'])->except('update');
    Route::resource('ngay-le','HolidayController', ['names' => 'holiday'])->except('update');
    Route::get('tai-khoan/{code}','UserController@show')->name('user.show');
    Route::get('nhan-vien/edit/{code}','PersonelController@edit')->name('personel.edit');

    Route::post('quyen-truy-cap/updatePermission','RoleController@updatePermission')->name('role.updatePermission');
    Route::put('quyen-truy-cap/updateRole','RoleController@update')->name('role.update');
    Route::post('updateStatusOrder','OrderController@updateStatusOrder');

    Route::get('/receipt/PC','ReceiptController@indexPC');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('receipt','ReceiptController');
    Route::resource('supplier','SupplierController');
    Route::get('PC','ReceiptController@PC')->name('PC');
    Route::get('PT','ReceiptController@PT')->name('PT');
    
    // Route::get('getPT','ReceiptController@getPT')->name('getPT');
    // Route::get('getPC','ReceiptController@getPC')->name('getPC');
    // Route::get('receipt/PT','ReceiptController@PT')->name('receipt.PT');
    Route::post('receipt/time-filter','ReceiptController@timeFilter');
    Route::post('receipt/updateStatus','ReceiptController@updateStatus');
    Route::get('receipt/datatable','ReceiptController@datatable')->name('receipt.datatable');
   
    // Route::resource('PC','PCController');
    // Route::resource('users','UserController');
    // Route::resource('PT','PTController');
    Route::resource('debt','DebtController')->except('show');
    Route::resource('chi-nhanh','BranchController', ['names' => 'branch']);
    Route::get('CNPT','DebtController@CNPT')->name('CNPT');
    Route::get('CNPC','DebtController@CNPC')->name('CNPC');
    Route::get('CNPC/{code}','DebtController@CNPCShow')->name('CNPC.show');
    Route::get('CNPT/{code}','DebtController@CNPTShow')->name('CNPT.show');
    Route::post('debt/show','DebtController@show')->name('debt.show');

    // Route::get('CNPT','ReceiptController@CNPT')->name('CNPT');
    // Route::get('CNPC','ReceiptController@CNPC')->name('CNPC');
    Route::get('debt/time-filter','DebtController@timeFilter');

    // Route::get('debt','DebtController@index')->name('debt.index');
    Route::resource('banner','BannerController');
    Route::resource('category-receipt','CategoryReceiptController');
    Route::resource('ban-hang','SaleController', ['names' => 'sale']);

    Route::post('PT/finish','PTController@finish');
    // Route::get('PT/print/{id}','PTController@print');
    Route::get('PC/print/{id}','PCController@print');
    Route::get('cash-book','ReceiptController@index')->name('cash-book');
    // Banner
    //QUẢN LÝ KHO
    Route::get('tui', function(){
        return view('backend.schedule.index');
    });
    
    Route::resource('receipt-stock','ReceiptStockController')->except(['show']);
    // Route::resource('partner','PartnerController');
    Route::get('receipt-stock/{code}','ReceiptStockController@show')->name('receipt-stock.show');
    Route::post('partner','PartnerController@index')->name('partner.index');
    Route::post('partner/show','PartnerController@show')->name('partner.show');
    Route::post('receipt-stock/out-of-stock','ReceiptStockController@outOfStock');
    Route::post('receipt-stock/getDebt','ReceiptStockController@getDebt');
    Route::get('chung-tu-kho/can-doi-kho','ReceiptStockController@stockBalance')->name('receipt-stock.balance');
    Route::resource('ship','ServiceShipController');
    Route::resource('stock','StockController');
    // Route::resource('user','UserController')->except(['show']);;
    // Route::post('user/show','UserController@show')->name('user.show');
    Route::post('/search-supplier','SearchController@searchSupplier');
    Route::resource('receipt-stock','ReceiptStockController');
    Route::get('phieu-nhap-kho','ReceiptStockController@getPN')->name('PN');
    Route::get('phieu-nhap-kho/them-phieu-nhap','ReceiptStockController@createPN')->name('PN.create');
    Route::get('phieu-xuat-kho','ReceiptStockController@getPX')->name('PX');
    Route::get('phieu-xuat-kho/them-phieu-xuat','ReceiptStockController@createPX')->name('PX.create');

    Route::get('can-doi-kho','ReceiptStockController@stockBalance')->name('stockBalance');

    // Brand
    Route::resource('brand','BrandController');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');
    // Category
    Route::resource('/category','CategoryController');
    // Product
    Route::resource('/product','ProductController');
    // Ajax for sub category
    Route::post('/category/{id}/child','CategoryController@getChildByParent');

    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');

    // Order
    Route::resource('/order','OrderController');
    Route::get('/order/show/{order_code}',"OrderController@show")->name('order.show');
    // Route::post('/order/getOrder',"OrderController@getOrder")->name('order.show');

    // Shipping
    Route::resource('/shipping','ShippingController');
    // Coupon
    Route::resource('/coupon','CouponController');
    // Settings
    Route::get('information','InformationController@index')->name('information');
    Route::get('settings','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
});
Route::get('/select',function(){
    return view('backend/select');
});
// Route::group(['prefix'=>'/nhan-vien','as'=>'personel.'],function(){










// User section start
Route::group(['prefix'=>'/user','as'=>'user.','middleware'=>['user']],function(){
    Route::get('/','HomeController@index')->name('index');
    Route::post('/descriptionStatus','HomeController@descriptionStatus');
     // Profile
     Route::get('/profile','HomeController@profile')->name('profile');
     Route::post('/profile/{id}','HomeController@profileUpdate')->name('profile-update');
     Route::resource('/address','UserAddressController');
     Route::post('/address/default','UserAddressController@default');

    //  Order
    Route::get('/order',"HomeController@orderIndex")->name('order.index');
    Route::get('/order/updateStatus',"CartController@updateStatus")->name('order.index');
    Route::get('/order/show/{order_code}',"HomeController@orderShow")->name('order.show');
    Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('order.delete');
    // Product Review
  
    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

});
Route::group(['prefix'=>'nhan-vien','as'=>'staff.','middleware'=>['auth','staff']],function(){
    Route::get('/','StaffController@index')->name('index');
});;
Route::group(['prefix'=>'cham-cong','middleware'=>['auth','staff','cashier']],function(){
    Route::post('/cham-cong','TimesheetController@store')->name('timesheet.store');
});;
Route::group(['prefix'=>'thu-ngan','as'=>'cashier.','middleware'=>['auth','cashier']],function(){
    Route::get('/','CashierController@index')->name('index');
});;
Route::group(['prefix'=>'quan-ly','namespace'=>'Manager','as'=>'manager.','middleware'=>['auth','manager']],function(){
    // Route::get('/','AdminController@index')->name('index');
    Route::resource('tai-khoan','UserController', ['names' => 'user'])->except('show');
    Route::resource('nhan-vien','PersonelController', ['names' => 'personel'])->except('show','edit');
    Route::resource('quyen-truy-cap','RoleController', ['names' => 'role'])->except('update');
    Route::resource('ca-lam-viec','ShiftController', ['names' => 'shift'])->except('update');
    Route::resource('ngay-le','HolidayController', ['names' => 'holiday'])->except('update');
    Route::get('tai-khoan/{code}','UserController@show')->name('user.show');
    Route::get('nhan-vien/edit/{code}','PersonelController@edit')->name('personel.edit');


    Route::post('quyen-truy-cap/updatePermission','RoleController@updatePermission')->name('role.updatePermission');
    Route::put('quyen-truy-cap/updateRole','RoleController@update')->name('role.update');
    Route::post('updateStatusOrder','OrderController@updateStatusOrder');
});;
// Route::get('test',function(){
//     $check_in=strtotime('12:02:00');
//     $check_out=strtotime('16:52:00');
//     $shifts=DB::table('shifts')->get();
//     $min_in=abs(strtotime($shifts[0]->start) - $check_in);
//     $min_out=abs(strtotime($shifts[0]->end) - $check_out);
//     $min_id=$shifts[0]->id;
//     for($i=1 ; $i<count($shifts); $i++){
//         echo $shifts[$i]->start." ";
//         $start=strtotime($shifts[$i]->start);
//         $end=strtotime($shifts[$i]->end);
//         $k_in=abs($start - $check_in);
//         $k_out=abs($end - $check_out);
//         if($k_in<$min_in && $k_out < $min_out){
//             $min_in=$start;
//             $min_out=$end;
//             $min_id=$shifts[$i]->id;
//         }
//     }
//     echo $min_id;
// });
Route::get('calendar',function (){
    return view('calendar');
});
// Route::post('reset-password', 'ResetPasswordController@sendMail');
// Route::put('reset-password/{token}', 'ResetPasswordController@reset');
// Route::get('getInfo-facebook/{social}', 'SocialController@getInfo')->name('login.facebook');
// Route::get('checkInfo-facebook/{social}', 'SocialController@checkInfo');
