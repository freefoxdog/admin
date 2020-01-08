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

//Route::get('/', function () {
//    return view('welcome');
//});



Route::middleware(['auth','google2fa'])->group(function(){
    Route::get('/','IndexController@index')->name('index');
    Route::get('/welcome','IndexController@welcome')->name('welcome');
    Route::get('users','UserController@index')->name('users.index');
    Route::get('transactions','TransactionController@index')->name('transactions.index');
    Route::get('transaction/orders','TransactionOrderController@index')->name('transactionOrders.index');
    Route::get('tasks','TaskController@index')->name('tasks.index');
    Route::get('merchants','MerchantController@merchant')->name('merchants.index');
    Route::get('merchants/create','MerchantController@create')->name('merchants.create');
    Route::post('merchants','MerchantController@store')->name('merchants.store');
    Route::get('complaints','ComplaintController@index')->name('complaints.index');
    Route::get('complaints/show','ComplaintController@show')->name('complaints.show');
    Route::get('complaints/hand/order','ComplaintController@hand')->name('complaints.hand');
    Route::post('complaints/{id}','ComplaintController@update')->name('complaints.store');
    Route::get('group/notice','GroupNociteController@index')->name('groupNotice.index');
    Route::get('admin/user/edit','AdminUserController@passEdit')->name('admin.eidt');
    Route::post('admin/user/password','AdminUserController@passWord')->name('admin.password');
    Route::get('admin/user/create','AdminUserController@create')->name('admin.create');
    Route::get('admin/users','AdminUserController@index')->name('admin.index');
    Route::middleware(['amdinRoot'])->group(function(){
        Route::post('admin/user/store','AdminUserController@store')->name('admin.store');
        Route::get('admin/users/destroy/{id}','AdminUserController@destroy')->name('admin.destroy')->where('id','[0-9]+');
        Route::get('admin/users/start/{id}','AdminUserController@startUser')->name('admin.startUser')->where('id','[0-9]+');
     });
    Route::get('send/red/create','MerchantController@sendRed')->name('red.create');
    Route::get('send/red','MerchantController@send')->name('red.store');

    //商户申请列表
    Route::get('task/cash/index','MerchantCashOrderController@index')->name('task.cash.index');
    //商户拒绝
    Route::get('task/cash/refuse','MerchantCashOrderController@refuse')->name('task.cash.refuse');
    //商户同意
    Route::get('task/cash/apply','MerchantCashOrderController@apply')->name('task.cash.apply');


    //谷歌验证

});
Route::middleware(['auth'])->group(function(){
    Route::get('google/show','GoogleController@show')->name('google.show');
    Route::get('google/enable2fa','GoogleController@enable2fa')->name('google.2fa');
});


Route::get('log',function(\Illuminate\Http\Request $request){
    \Illuminate\Support\Facades\Log::info(json_encode($request->all(),256));
});


Auth::routes();

