<?php

use App\Http\Controllers\access;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\cartController;
use App\Models\product;

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
    return view('homepage');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/', [productController::class, "getproduct"]);
//Route::get('redirect', [adminController::class, "redirect"]);


Route::get('itemHome', [access::class, "itemHome"])->name("itemHome");

//Route::get('categorypage', [adminController::class, "categorypage"])->name("category_page");
//Route::get('subcategorypage', [adminController::class, "subcategorypage"])->name('subcategorypage');

Route::group(['middleware' => ['auth','CheckBanned']], function () {
    Route::get('home', [access::class, "access"])->name("home");
    Route::get('confirmOrder/{id}', [access::class, "confirmOrder"])->name("confirmOrder");
    Route::post('checkout', [access::class, "checkout"])->name("checkout");
    Route::get('clientOrder', [access::class, "clientOrder"])->name("clientOrder");
    Route::post('showDetailOrder', [access::class, "showDetailOrder"])->name("showDetailOrder");
    Route::post('showDetailOneOrder', [access::class, "showDetailOneOrder"])->name("showDetailOneOrder");
    //add to cart home page
    Route::get("add-to-cart-home/{id}", [cartController::class, "add_product_to_cart_home"])->name('add-to-cart-home');
    Route::get('remove-from-cart-home/{id}', [cartController::class, 'remove_product_from_cart_home'])->name("remove-from-cart-home");
    //add to cart product page
    Route::get("add-to-cart/{id}", [cartController::class, "add_product_to_cart"])->name('add-to-cart');
    Route::get('remove-from-cart/{id}', [cartController::class, 'remove_product_from_cart'])->name("remove-from-cart");
    Route::get('see-cart-products', [cartController::class, 'see_product_cart'])->name('see-product-cart');
    //Delete product from cart
    Route::get('cartDelete/{id}', [cartController::class, 'cartDelete'])->name('cartDelete');
    Route::get("shopFromCart/{id}",[cartController::class,"shopFromCart"])->name("shopFromCart");
    Route::get("addAddress",function(){
        return view("addressPage");
    })->name("addAddress");
    Route::post("addNewAddress",[cartController::class,"addNewAddress"])->name("addNewAddress");
    Route::post('allincart', [cartController::class, "allincart"])->name("allincart");
    Route::get('clientOrderHasProduct', [access::class, "clientOrderHasProduct"])->name('clientOrderHasProduct');






});

Route::group(['middleware' => ['auth', 'isAdmin','CheckBanned']], function () {
    Route::get('categorypage', [adminController::class, "categorypage"])->name("category_page");
    Route::post('addcategory', [adminController::class, "addcategory"])->name("addcategory");
    Route::get('subcategorypage', [adminController::class, "subcategorypage"])->name('subcategorypage');
    Route::post('addsubcategory', [adminController::class, "addsubcategory"])->name('addsubcategory');
    Route::get('editsubpage/{id}', [adminController::class, "editsubpage"])->name('editsubpage');
    Route::post('editsub/{id}', [adminController::class, "editsub"])->name('editsub');
    Route::get('deletesub/{id}', [adminController::class, "deletesub"])->name('deletesub');
    Route::get('edit/{id}', [adminController::class, "editpage"])->name('edit');
    Route::get('delete/{id}', [adminController::class, "deletecategory"])->name('delete');
    Route::get('update/{id}', [adminController::class, "update"])->name('update');
    Route::get('productpage', [adminController::class, "productpage"])->name('productpage');
    Route::post('addproduct', [adminController::class, "addproduct"])->name('addproduct');
    Route::get('editproduct/{id}', [adminController::class, "editproduct"])->name('editproduct');
    Route::get('deleteproduct/{id}', [adminController::class, "deleteproduct"])->name('deleteproduct');
    Route::post('updateproduct/{id}', [adminController::class, "updateproduct"])->name('updateproduct');
    Route::get('customerorderpage', [adminController::class, "customerorderpage"])->name('customerorderpage');
    Route::get('orderdetail/{id}/{pid}/{aid}', [adminController::class, "orderdetail"])->name('orderdetail');
    Route::get('changestatus/{id}/{status}', [adminController::class, "changestatus"])->name('changestatus');
    Route::get('producttrashed', [adminController::class, "producttrashed"])->name('producttrashed');
    Route::get('orderHasProduct', [adminController::class, "orderHasProduct"])->name('orderHasProduct');
    Route::get('showOrderHasProduct/{id}', [adminController::class, "showOrderHasProduct"])->name('showOrderHasProduct');
    Route::get('changestatusOneOrder/{id}/{status}', [adminController::class, "changestatusOneOrder"])->name('changestatusOneOrder');
    Route::get('ban/{id}',[adminController::class,"banUser"])->name('ban-user');
    Route::get('recovery/{id}',[adminController::class,"recoveryUser"])->name('recovery-user');
});
Route::get('productview/{productId}', [access::class, "productview"])->name('productview');
Route::get('search', [searchController::class, "search"])->name("search");
Route::post('filter', [searchController::class, "filter"])->name("filter");
Route::get('edraak', [access::class, "edraak"])->name("edraak");




// Route::get("add-to-cart/{id}", [cartController::class, "add_product_to_cart_home"])->name('add-to-cart-home');
// Route::get('remove-from-cart-home/{id}', [cartController::class, 'remove_product_from_cart_home'])->name("remove-from-cart-home");
