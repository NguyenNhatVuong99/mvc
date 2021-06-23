<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
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
    Route::get('tai-khoan/{code}','UserController@show')->name('user.show');
    Route::resource('quyen-truy-cap','RoleController', ['names' => 'role'])->except('update');
    Route::resource('nhan-vien','PersonelController', ['names' => 'personel'])->except('show','edit');
    Route::get('nhan-vien/edit/{code}','PersonelController@edit')->name('personel.edit');
    Route::post('quyen-truy-cap/updatePermission','RoleController@updatePermission')->name('role.updatePermission');
    Route::put('quyen-truy-cap/updateRole','RoleController@update')->name('role.update');
    Route::get('san-pham/them-san-pham','ProductController@create')->name('product.create');
    Route::post('san-pham/getPriceDefault','ProductController@getPriceDefault')->name('product.getPriceDefault');
    Route::resource('/san-pham','ProductController', ['names' => 'product'])->except('create','show');
    Route::resource('/nha-cung-cap','SupplierController', ['names' => 'supplier'])->except('create');
    // Route::get('nhap-hang/them-phieu-nhap','ProductImportController@create')->name('productImport.create');
    Route::group(['prefix' => 'nhap-hang'], function () {
        Route::get('them-phieu-nhap','ProductImportController@create')->name('productImport.create');
        Route::post('chi-tiet','ProductImportController@show')->name('productImport.show');
        Route::post('phieu-chi','ProductImportController@receipt')->name('productImport.receipt');
        Route::post('them-phieu-chi','ProductImportController@createCashflow')->name('productImport.createCashflow');
        Route::post('getProduct','ProductImportController@getProduct')->name('productImport.getProduct');
        Route::post('getCostPrice','ProductImportController@getCostPrice')->name('productImport.getCostPrice');
        Route::post('hoan-thanh','ProductImportController@complete')->name('productImport.complete');
    });
    
    Route::resource('/nhap-hang','ProductImportController', ['names' => 'productImport'])->except('create','show');
    Route::resource('/dong-tien','CashflowController', ['names' => 'cashflow'])->except('create','show');
    Route::resource('/don-vi','UnitController', ['names' => 'unit']);
    Route::resource('/thuong-hieu','BrandController', ['names' => 'brand']);
    Route::post('doi-tac/','PartnerController@index')->name('partner.index');

    Route::get('danh-muc-san-pham/them-danh-muc','CategoryController@create')->name('category.create');
    Route::get('danh-muc-san-pham/child','CategoryController@childCategory')->name('category.child');
    Route::resource('danh-muc-san-pham','CategoryController',['names' => 'category'])->except('create');
    Route::group(['prefix' => 'anh-bia'], function () {
        Route::post('trang-thai','BannerController@updateStatus')->name('banner.updateStatus');
        Route::post('destroy','BannerController@destroy')->name('banner.destroy');
        Route::get('onlyTrashed','BannerController@onlyTrashed')->name('banner.onlyTrashed');
        Route::post('restore','BannerController@restore')->name('banner.restore');
        Route::put('update','BannerController@update')->name('banner.update');
    });

    Route::resource('anh-bia','BannerController',['names' => 'banner'])->except('create','destroy','update');
    Route::group(['prefix' => 'bang-gia'], function () {
        Route::post('chi-tiet','PriceListController@detail')->name('priceList.detail');
        Route::post('show','PriceListController@show')->name('priceList.show');
        Route::get('default','PriceListController@default')->name('priceList.default');
        Route::post('getFormat','PriceListController@getFormat')->name('priceList.getFormat');
        Route::post('updateFormat','PriceListController@updateFormat')->name('priceList.updateFormat');
        Route::post('getProduct','PriceListController@getProduct')->name('priceList.getProduct');
        Route::post('destroy','PriceListController@destroy')->name('priceList.destroy');
        Route::post('deleteProduct','PriceListController@deleteProduct')->name('priceList.deleteProduct');
        Route::post('updateDetail','PriceListController@updateDetail')->name('priceList.updateDetail');
        Route::post('updatePrice','PriceListController@updatePrice')->name('priceList.updatePrice');
        // Route::post('update','PriceListController@update')->name('priceList.update');
    });
    Route::resource('bang-gia','PriceListController',['names' => 'priceList'])->except('show','destroy');
    // Route::resource('dinh-dang','PriceListFormatController',['names' => 'priceListFormat'])->except('show');
    Route::get('bang-luong/them-bang-luong','SalaryController@create')->name('salary.create');

    Route::resource('/bang-luong','SalaryController', ['names' => 'salary'])->except('show','create','update');
    Route::get('/{code}','SalaryController@show')->name('salary.show');


    Route::get('information','InformationController@index')->name('information');
    Route::get('settings','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');
    Route::get('/notification/{id}','NotificationController@show')->name('notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');

    
});
// Route::group(['prefix'=>'/nhan-vien','as'=>'personel.'],function(){










// // User section start
// Route::group(['prefix'=>'/user','as'=>'user.','middleware'=>['user']],function(){
//     Route::get('/','HomeController@index')->name('index');
//     Route::post('/descriptionStatus','HomeController@descriptionStatus');
//      // Profile
//      Route::get('/profile','HomeController@profile')->name('profile');
//      Route::post('/profile/{id}','HomeController@profileUpdate')->name('profile-update');
//      Route::resource('/address','UserAddressController');
//      Route::post('/address/default','UserAddressController@default');

//     //  Order
//     Route::get('/order',"HomeController@orderIndex")->name('order.index');
//     Route::get('/order/updateStatus',"CartController@updateStatus")->name('order.index');
//     Route::get('/order/show/{order_code}',"HomeController@orderShow")->name('order.show');
//     Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('order.delete');
//     // Product Review
  
//     // Password Change
//     Route::get('change-password', 'HomeController@changePassword')->name('change.password.form');
//     Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

// });
// Route::get('/ban-hang',function(){
//     dd('ok');
// });
Route::group(['prefix'=>'ban-hang','namespace'=>'Sell','as'=>'sell.','middleware'=>['auth','sell']],function(){
    Route::get('/','SellController@index')->name('index');
    
});