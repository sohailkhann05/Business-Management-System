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

Auth::routes();
Route::get('/', 'HomeController@index');

// super-admin routes
Route::prefix('superadmin')->group(function () {

    Route::get('/', 'SuperAdminController@index')->name('superadmin.dashboard');
    Route::get('/login', 'Auth\SuperAdminLoginController@loginView')->name('superadmin.login');
    Route::post('/login', 'Auth\SuperAdminLoginController@login')->name('superadmin.login');
    Route::resource('/admin-profile', 'AdProfileController');
    Route::resource('/admin-business', 'AdBusinessController');
});


// business-admin routes
Route::prefix('businessadmin')->group(function () {

    Route::get('/', 'BusinessAdminController@index')->name('businessadmin.dashboard');
    Route::get('/login', 'Auth\BusinessAdminLoginController@loginView')->name('businessadmin.login');
    Route::post('/login', 'Auth\BusinessAdminLoginController@login')->name('businessadmin.login');
    Route::resource('/business-profile', 'BuProfileController');
    Route::resource('/business-branch', 'BuBranchController');
    Route::resource('/business-branchadmin', 'BuBranchAdminController');
    Route::resource('/business-bank', 'BuBankController');
    Route::resource('/business-employee', 'BuEmployeeController');
    Route::resource('/business-productcategory', 'BuProductCategoryController');
    Route::resource('/business-usercategory', 'BuUserCategoryController');

});

// branch-admin routes
Route::prefix('branchadmin')->group(function () {

    Route::get('/', 'BranchAdminController@index')->name('branchadmin.dashboard');
    Route::get('/login', 'Auth\BranchAdminLoginController@loginView')->name('branchadmin.login');
    Route::post('/login', 'Auth\BranchAdminLoginController@login')->name('branchadmin.login');
    Route::resource('/br-profile', 'BrProfileController');
    Route::resource('/br-cash', 'BrCashController');
    Route::resource('/br-productsetup', 'BrProductSetupController');
    Route::resource('/br-supplier', 'BrClientController');
    Route::resource('/br-customer', 'BrCustomerController');
    Route::resource('/br-stockadjustment', 'BrStockAdjustmentController');
    Route::resource('/br-purchasedorder', 'BrPurchasedOrderController');
    Route::resource('/br-supplierbonus', 'BrBonusController');
    Route::resource('/br-supplierbonusdetail', 'BrBonusDetailController');
    Route::resource('/br-customerorder', 'BrSellOrderController');
    Route::resource('/br-sellorderdetail', 'BrSellOrderDetailController');
    Route::resource('/br-productpurchased', 'BrProductPurchasedController');
    Route::resource('/br-purchasedorderexpanses', 'BrPurchasedOrderExpansesController');
    Route::resource('/br-purchasedorderreturn', 'BrPurchasedOrderReturnController');
    Route::resource('/br-purchasedorderreturndetail', 'BrPurchasedOrderReturnDetailController');
    Route::resource('/br-createorder', 'BrCreateOrderController');
    Route::resource('/br-sellorderreturn', 'BrSellOrderReturnController');
    Route::resource('/br-sellorderreturndetail', 'BrSellOrderReturnDetailController');
    Route::resource('/br-transactionhistory', 'BrTransactionHistoryController');
    Route::resource('/br-orderhistory', 'BrOrderHistoryController');
    Route::resource('/br-onlinecustomer', 'BrOnlineCustomerController');
    Route::resource('/br-supplierclaim', 'BrPurchasedClaimController');
    Route::resource('/br-customerclaim', 'BrSellClaimController');
    Route::resource('/br-supplierreceipt', 'BrPurchasedReceiptController');
    Route::resource('/br-customerreceipt', 'BrSellReceiptController');
    Route::post('/branch-edit-quantity', 'AjaxController@editQuantity');
    Route::post('/branch-update-quantity', 'AjaxController@updateQuantity');
    Route::post('/branch-search-invoice', 'AjaxController@searchInvoice');
    Route::post('/branch-product-details', 'AjaxController@productDetails');
    Route::post('/branch-edit-return-quantity', 'AjaxController@editReturnQuantity');
    Route::post('/branch-update-return-quantity', 'AjaxController@updateReturnQuantity');
    Route::post('/branch-search-sell-invoice', 'AjaxController@searchSellInvoice');
    Route::post('/branch-update-sell-return-quantity', 'AjaxController@updateSellReturnQuantity');

    Route::get('/br-customerbalance', 'ReportsController@customerBalance')->name('customerbalance');
    Route::get('/br-customerledger', 'ReportsController@customerLedger')->name('customerledger');
    Route::get('/br-grossprofileloss', 'ReportsController@grossProfitLoss')->name('grossprofileloss');
    Route::get('/br-openingstock', 'ReportsController@openingStock')->name('openingstock');
    Route::get('/br-productwisestock', 'ReportsController@productWiseStock')->name('productwisestock');
    Route::get('/br-purchaseregister', 'ReportsController@purchaseRegister')->name('purchaseregister');
    Route::get('/br-sellregister', 'ReportsController@sellRegister')->name('sellregister');
    Route::get('/br-supplierbalance', 'ReportsController@supplierBalance')->name('supplierbalance');
    Route::get('/br-supplierledger', 'ReportsController@supplierLedger')->name('supplierledger');
    Route::get('/br-trailbalance', 'ReportsController@trailBalance')->name('trailbalance');
    Route::get('/br-purchaseclaim', 'ReportsController@purchaseClaim')->name('purchaseclaim');
    Route::get('/br-sellclaim', 'ReportsController@sellClaim')->name('sellclaim');


});
//Branch Ajax Routes
Route::post('/branchsellproductdetails', 'AjaxController@sellProductDetails');
Route::post('/branchsearchcustomer', 'AjaxController@searchCustomer');
Route::post('/branch-purchased-unit', 'AjaxController@purchasedUnit');
Route::post('/edit-user-quantity', 'AjaxController@editUserQuantity');
Route::post('/update-user-quantity', 'AjaxController@updateUserQuantity');
Route::post('/searchtype', 'AjaxController@searchType');
Route::post('/searchsupplierbyname', 'AjaxController@searchSupplierByName');
Route::post('/searchsupplierbyphone', 'AjaxController@searchSupplierByPhone');
Route::post('/searchtypecustomer', 'AjaxController@searchTypeCustomer');
Route::post('/searchcustomerbyname', 'AjaxController@searchCustomerByName');
Route::post('/searchcustomerbyphone', 'AjaxController@searchCustomerByPhone');
Route::post('/branchsearchinvoice', 'AjaxController@branchSearchInvoice');
Route::post('/branchsearchproduct', 'AjaxController@productSearch');
Route::post('/purchasedclaimsearch', 'AjaxController@purchasedClaimSearch');
Route::post('/purchasedclaimsupplier', 'AjaxController@purchasedClaimSupplier');
Route::post('/sellclaimcustomer', 'AjaxController@sellClaimCustomer');
Route::post('/sellclaimsearch', 'AjaxController@sellClaimSearch');
Route::post('/getsupplier', 'AjaxController@getSupplier');
Route::post('/getsupplierdata', 'AjaxController@getSupplierData');
Route::post('/getcustomer', 'AjaxController@getCustomer');
Route::post('/getcustomerdata', 'AjaxController@getCustomerData');
Route::post('/productwisereport', 'AjaxController@searchProductWise');
Route::post('/purchaseregister', 'AjaxController@purchaseRegister');
Route::post('/getcustomertype','AjaxController@getCustomerType');
Route::post('/sellregister', 'AjaxController@sellRegister');
Route::post('/purchaseclaim','AjaxController@purchaseClaim');
Route::post('/sellclaim','AjaxController@sellClaim');
Route::post('/grossprofitloss','AjaxController@grossProfitLoss');
Route::post('/trailbalance','AjaxController@trailBalance');
Route::post('/supplierledger','AjaxController@supplierLedger');
Route::post('/customerledger','AjaxController@customerLedger');

// customer routes
Route::resource('/about', 'AboutController');
Route::resource('/checkout', 'CheckoutController');
Route::resource('/contactus', 'ContactusController');
Route::resource('/cart', 'CartController');
Route::resource('/myaccount', 'MyAccountController');
Route::resource('/products', 'ProductController');
Route::resource('/productcategory', 'ProductCategoryController');
Route::resource('/productdetails', 'ProductDetailController');
Route::resource('/shop', 'ShopController');
Route::resource('/wishlist', 'WishlistController');
Route::get('/customerlogin', 'Auth\CustomerLoginController@loginView')->name('customer.login');
Route::post('/customerlogin', 'Auth\CustomerLoginController@login')->name('customer.login');
Route::post('/customerregister', 'Auth\CustomerRegistration@register')->name('customer.register');
Route::post('/edit-customer-quantity', 'AjaxController@editCustomerQuantity');
Route::post('/update-customer-quantity', 'AjaxController@updateCustomerQuantity');
