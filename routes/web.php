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

Route::get('test',[
    'as'=> 'trang-chu',
    'uses' =>'PageController@htmlMailTest'
]);


Route::get('mail', 'MailController2@index');



Route::post('postMail', [
    'as'=> 'post-Mail',
    'uses' => 'MailController2@post'
]);




Route::get('index',[
    'as'=> 'trang-chu',
    'uses' =>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
    'as' => 'loaisanpham',
    'uses' => 'PageController@getLoaisanpham'
]);

Route::get('chi-tiet-san-pham/{id}',[
    'as' => 'chitietsanpham',
    'uses' => 'PageController@getChitietsanpham'
]);

Route::get('lien-he',[
    'as' => 'getlienhe',
    'uses' => 'PageController@getLienhe'
]);
Route::post('lien-he',[
    'as' => 'postlienhe',
    'uses' => 'PageController@postLienhe'
]);


Route::get('gioi-thieu',[
    'as' => 'gioithieu',
    'uses' => 'PageController@getGioithieu'
])->middleware('auth');

//route để mua sản phẩm thì cần truyền vào id để biết đó là sản phẩm nào
Route::get('addToCart/{id}',[
    'as' => 'themgiohang',
    'uses' => 'AjaxController@getAddtoCart'
]);


// Route::get('addToCart/{id}',[
//     'as' => 'themgiohang',
//     'uses' => 'AjaxController@getAddtoCart'
// ]);

//Ajax mua san pham
// Route::get('users/{id}', function() {
//     //
// });

//delete Cart

Route::get('del-cart/{id}', [
    'as' => 'xoagiohang',
    'uses' => 'PageController@getDelItemCart'
]);

Route::get('dat-hang', [
    'as' => 'dathang',
    'uses' => 'PageController@getDatHang'
])->middleware('auth');

Route::post('dat-hang', [
    'as' => 'dathang',
    'uses' => 'PageController@postDatHang'
]);


Route::get('dang-nhap', [
    'as' => 'login',
    'uses' =>'PageController@getLogin'
]);
Route::post('dang-nhap', [
    'as'=> 'login',
    'uses' => 'PageController@postLogin'
]);

Route::get('dang-ki', [
    'as' => 'signin',
    'uses' =>'PageController@getSignin'
]);

Route::post('dang-ki', [
    'as' => 'signin',
    'uses' =>'PageController@postSignin'
]);


Route::get('dang-xuat', [
    'as' => 'dangxuat',
    'uses' =>'PageController@postDangXuat'
]);

Route::get('search', [
    'as' => 'search',
    'uses' =>'PageController@getSearch'
]);

//login fb

Route::get('auth/facebook', 'Auth\AuthController@redirectToFacebook')->name('auth.facebook');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookCallback');

//===================ADmin=====================================

Route::get('testAdmin', function() {
    return view('admin.user.danhsach');
});

//nhóm tất cả các router thuộc admin vào 
Route::group(['prefix' => 'admin'],function(){
    //nhóm từng loại bên trong của nó để quản lí tốt hơn
    Route::group(['prefix' => 'user'],function(){
        Route::get('danhsach','UserController@getDanhSach');
        Route::get('sua/{id}','UserController@getSua');
        Route::post('sua/{id}','UserController@postSua');
        Route::get('xoa/{id}','UserController@getXoa');
        Route::get('them','UserController@getThem');
        Route::post('them','UserController@postThem');
    });

    Route::group(['prefix' => 'slide'],function(){
        Route::get('danhsach','SlideController@getDanhSach');
        Route::get('sua/{id}','SlideController@getSua');
        Route::post('sua/{id}','SlideController@postSua');
        Route::get('xoa/{id}','SlideController@getXoa');
        Route::get('them','SlideController@getThem');
        Route::post('them','SlideController@postThem');
    });

    Route::group(['prefix' => 'producttype'],function(){
        Route::get('danhsach','ProductTypeController@getDanhSach');
        Route::get('sua/{id}','ProductTypeController@getSua');
        Route::post('sua/{id}','ProductTypeController@postSua');
        Route::get('xoa/{id}','ProductTypeController@getXoa');
        Route::get('them','ProductTypeController@getThem');
        Route::post('them','ProductTypeController@postThem');
    });

    Route::group(['prefix' => 'product'],function(){
        Route::get('danhsach','ProductController@getDanhSach');
        Route::get('sua/{id}','ProductController@getSua');
        Route::post('sua/{id}','ProductController@postSua');
        Route::get('xoa/{id}','ProductController@getXoa');
        Route::get('them','ProductController@getThem');
        Route::post('them','ProductController@postThem');
    });

    Route::group(['prefix' => 'customer'],function(){
        Route::get('danhsach','CustomerController@getDanhSach');
        Route::get('sua/{id}','CustomerController@getSua');
        Route::post('sua/{id}','CustomerController@postSua');
        Route::get('xoa/{id}','CustomerController@getXoa');
        Route::get('them','CustomerController@getThem');
        Route::post('them','CustomerController@postThem');
    });

    Route::group(['prefix' => 'bill'],function(){
        Route::get('danhsach','BillController@getDanhSach');
        Route::get('sua/{id}','BillController@getSua');
        Route::post('sua/{id}','BillController@postSua');
        Route::get('xoa/{id}','BillController@getXoa');
        Route::get('them','BillController@getThem');
        Route::post('them','BillController@postThem');
    });

});