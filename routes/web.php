<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ShouravController;
use App\Http\Controllers\SubCategoryController as ControllersSubCategoryController;
use App\Models\SubCategory;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/',[HomeController::class,'index'])->name('home');
//Product show and details route here/// 
Route::prefix('shop')->group(function(){
    Route::get('/all_product',[ShouravController::class,'shopAll'])->name('shop.all');
    Route::get('/cat/{slug}',[ShouravController::class,'showCatWiseProduct'])->name('shop.cat_wise');
    Route::get('/sub_cat/{slug}',[ShouravController::class,'showSubCatWiseProduct'])->name('shop.subcat_wise');
    Route::get('/details/{slug}',[ShouravController::class,'productDetails'])->name('shop.details');
});
//Shopping cart//
Route::prefix('cart')->group(function(){
    Route::post('/store',[CartController::class,'store'])->name('cart.store');
    Route::get('/view',[CartController::class,'viewShoppingCart'])->name('cart.view_shopping_cart');
    Route::get('/delete/{id}',[CartController::class,'delete'])->name('cart.delete');
    Route::post('/update/{id}',[CartController::class,'update'])->name('cart.update');
    
});
    Route::get('/signin',[CheckoutController::class,'signInUp'])->name('signin_up');
    Route::post('/singup_store',[CheckoutController::class,'signUpStore'])->name('singup_store');
    Route::get('/signup',[CheckoutController::class,'signInUp'])->name('signup');
    Route::get('/signup/email_verify',[CheckoutController::class,'emailVerify'])->name('email_verify');
    Route::post('/signup/email_verify/store',[CheckoutController::class,'emailVerifyStore'])->name('email_verify_store');


//Route::get('/',[HomeController::class,'index'])->name('home');
Route::middleware(['auth','isCustomer'])->group(function(){
    // Route::get('/show',[HomeController::class,'show'])->name('show');
    Route::prefix('customer')->group(function(){
        Route::get('/info', [DashboardController::class, 'index'])->name('customer.info');
        Route::get('/password_change', [DashboardController::class, 'index'])->name('customer.password_change');
        Route::get('/order_list', [DashboardController::class, 'index'])->name('customer.order_list');
        Route::get('/order_list/order_details/{id}', [DashboardController::class, 'orderDestails'])->name('customer.order_details');
        Route::post('/passwordUpdate', [DashboardController::class, 'passwordUpdate'])->name('customer.passwordUpdate');
        
    });
    
        Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::post('/checkout_store', [CheckoutController::class, 'checkoutStore'])->name('checkout_store');
        Route::get('/checkout/diferent_address', [CheckoutController::class,'checkout'])->name('checkout_active');
        
    

});

Route::middleware('auth','isAdmin')->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
    Route::prefix('user')->group(function(){
        Route::get('/add',[UserController::class,'add'])->name('user.add');
        Route::post('/store',[UserController::class,'store'])->name('user.store');
        Route::get('/view/verified',[UserController::class,'verifiedUser'])->name('user.view_verified');
        Route::get('/active/{id}',[UserController::class,'active'])->name('user.active');
        Route::get('/deactive/{id}',[UserController::class,'deactive'])->name('user.deactive');
        Route::get('/profile',[UserController::class,'viewOwnProfile'])->name('user.profile');
        Route::get('/view/unverified',[UserController::class,'UnverifiedUser'])->name('user.view_unverified');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('user.edit');
        Route::get('/delete/{id}',[UserController::class,'deletePermanently'])->name('user.delete');
        Route::post('/update/{id}',[UserController::class,'update'])->name('user.update');
        Route::get('/password/change',[UserController::class,'passwordChange'])->name('user.password_change');
        Route::post('/password/change/store',[UserController::class,'passwordChangeStore'])->name('user.password_change.store');
    });
    Route::prefix('contract')->group(function(){
        Route::get('/add',[ContactController::class,'add'])->name('contact.add');
        Route::post('/store',[ContactController::class,'store'])->name('contact.store');
        Route::get('/view',[ContactController::class,'view'])->name('contact.view');
        Route::get('/delete_trash/{id}',[ContactController::class,'trashDelete'])->name('contact.delete_trash');
        Route::get('/recycle_bin',[ContactController::class,'viewTrash'])->name('contact.recycle_bin');
        Route::get('/edit/{id}',[ContactController::class,'edit'])->name('contact.edit');
        Route::get('/delete/{id}',[ContactController::class,'deletePermanently'])->name('contact.delete');
        Route::post('/update/{id}',[ContactController::class,'update'])->name('contact.update');
        Route::get('/restore/{id}',[ContactController::class,'restore'])->name('contact.restore');
    });
    Route::prefix('banner')->group(function(){
        Route::get('/add',[BannerController::class,'add'])->name('banner.add');
        Route::post('/store',[BannerController::class,'store'])->name('banner.store');
        Route::get('/view',[BannerController::class,'view'])->name('banner.view');
        Route::get('/active/{id}',[BannerController::class,'active'])->name('banner.active');
        Route::get('/deactive/{id}',[BannerController::class,'deactive'])->name('banner.deactive');
        Route::get('/details/{id}',[BannerController::class,'details'])->name('banner.details');
        Route::get('/delete_trash/{id}',[BannerController::class,'trashDelete'])->name('banner.delete_trash');
        Route::get('/recycle_bin',[BannerController::class,'viewTrash'])->name('banner.recycle_bin');
        Route::get('/edit/{id}',[BannerController::class,'edit'])->name('banner.edit');
        Route::get('/delete/{id}',[BannerController::class,'deletePermanently'])->name('banner.delete');
        Route::post('/update/{id}',[BannerController::class,'update'])->name('banner.update');
        Route::get('/restore/{id}',[BannerController::class,'restore'])->name('banner.restore');
    });
    ///Category Route..///
    Route::prefix('category')->group(function(){
        Route::get('/add',[CategoryController::class,'add'])->name('category.add');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/view',[CategoryController::class,'view'])->name('category.view');
        Route::get('/delete_trash/{id}',[CategoryController::class,'trashDelete'])->name('category.delete_trash');
        Route::get('/recycle_bin',[CategoryController::class,'viewTrash'])->name('category.recycle_bin');
        Route::get('/edit/{slug}',[CategoryController::class,'edit'])->name('category.edit');
        Route::get('/delete/{id}',[CategoryController::class,'deletePermanently'])->name('category.delete');
        Route::post('/update/{id}',[CategoryController::class,'update'])->name('category.update');
        Route::get('/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
    });
    ///Sub Category Route...//
    Route::prefix('subCategory')->group(function(){
        Route::get('/add',[SubCategoryController::class,'add'])->name('subCategory.add');
        Route::post('/store',[SubCategoryController::class,'store'])->name('subCategory.store');
        Route::get('/view',[SubCategoryController::class,'view'])->name('subCategory.view');
        Route::get('/delete_trash/{id}',[SubCategoryController::class,'trashDelete'])->name('subCategory.delete_trash');
        Route::get('/recycle_bin',[SubCategoryController::class,'viewTrash'])->name('subCategory.recycle_bin');
        Route::get('/edit/{slug}',[SubCategoryController::class,'edit'])->name('subCategory.edit');
        Route::get('/delete/{id}',[SubCategoryController::class,'deletePermanently'])->name('subCategory.delete');
        Route::post('/update/{id}',[SubCategoryController::class,'update'])->name('subCategory.update');
        Route::get('/restore/{id}',[SubCategoryController::class,'restore'])->name('subCategory.restore');
    });
    Route::prefix('section')->group(function(){
        Route::get('/add',[SectionController::class,'add'])->name('section.add');
        Route::post('/store',[SectionController::class,'store'])->name('section.store');
        Route::get('/view',[SectionController::class,'view'])->name('section.view');
        Route::get('/active/{id}',[SectionController::class,'active'])->name('section.active');
        Route::get('/deactive/{id}',[SectionController::class,'deactive'])->name('section.deactive');
        //Route::get('/details/{slug}',[SectionController::class,'details'])->name('section.details');
        Route::get('/delete_trash/{id}',[SectionController::class,'trashDelete'])->name('section.delete_trash');
        Route::get('/recycle_bin',[SectionController::class,'viewTrash'])->name('section.recycle_bin');
        Route::get('/edit/{slug}',[SectionController::class,'edit'])->name('section.edit');
        Route::get('/delete/{id}',[SectionController::class,'deletePermanently'])->name('section.delete');
        Route::post('/update/{id}',[SectionController::class,'update'])->name('section.update');
        Route::get('/restore/{slug}',[SectionController::class,'restore'])->name('section.restore');
    });
    //Color Route..//
    Route::prefix('color')->group(function(){
        Route::get('/add',[ColorController::class,'add'])->name('color.add');
        Route::post('/store',[ColorController::class,'store'])->name('color.store');
        Route::get('/view',[ColorController::class,'view'])->name('color.view');
        Route::get('/delete_trash/{id}',[ColorController::class,'trashDelete'])->name('color.delete_trash');
        Route::get('/recycle_bin',[ColorController::class,'viewTrash'])->name('color.recycle_bin');
        Route::get('/edit/{id}',[ColorController::class,'edit'])->name('color.edit');
        Route::get('/delete/{id}',[ColorController::class,'deletePermanently'])->name('color.delete');
        Route::post('/update/{id}',[ColorController::class,'update'])->name('color.update');
        Route::get('/restore/{id}',[ColorController::class,'restore'])->name('color.restore');
    });
    ///Size Route....///
    Route::prefix('size')->group(function(){
        Route::get('/add',[SizeController::class,'add'])->name('size.add');
        Route::post('/store',[SizeController::class,'store'])->name('size.store');
        Route::get('/view',[SizeController::class,'view'])->name('size.view');
        Route::get('/delete_trash/{id}',[SizeController::class,'trashDelete'])->name('size.delete_trash');
        Route::get('/recycle_bin',[SizeController::class,'viewTrash'])->name('size.recycle_bin');
        Route::get('/edit/{id}',[SizeController::class,'edit'])->name('size.edit');
        Route::get('/delete/{id}',[SizeController::class,'deletePermanently'])->name('size.delete');
        Route::post('/update/{id}',[SizeController::class,'update'])->name('size.update');
        Route::get('/restore/{id}',[SizeController::class,'restore'])->name('size.restore');
    });
    Route::prefix('product')->group(function(){
        Route::get('/add',[ProductController::class,'add'])->name('product.add');
        Route::get('/get-category-id-by-category-id/{id}', [ProductController::class, 'getSubCategoryId'])->name('product.get-category-id-by-category-id');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');
        Route::get('/view',[ProductController::class,'view'])->name('product.view');
        Route::get('/active/{slug}',[ProductController::class,'active'])->name('product.active');
        Route::get('/deactive/{slug}',[ProductController::class,'deactive'])->name('product.deactive');
        Route::get('/details/{slug}',[ProductController::class,'details'])->name('product.details');
        Route::get('/delete_trash/{slug}',[ProductController::class,'trashDelete'])->name('product.delete_trash');
        Route::get('/recycle_bin',[ProductController::class,'viewTrash'])->name('product.recycle_bin');
        Route::get('/edit/{slug}',[ProductController::class,'edit'])->name('product.edit');
        Route::get('/delete/{slug}',[ProductController::class,'deletePermanently'])->name('product.delete');
        Route::post('/update/{id}',[ProductController::class,'update'])->name('product.update');
        Route::get('/restore/{slug}',[ProductController::class,'restore'])->name('product.restore');
    });
    Route::prefix('orders')->group(function(){
        Route::get('/pending_list',[OrderController::class,'pendingList'])->name('orders.pending_list');
        Route::get('/approved_list',[OrderController::class,'approvedList'])->name('orders.approved_list');
        Route::get('/approve/{id}',[OrderController::class,'approve'])->name('orders.approve');
        Route::get('/details/{id}',[OrderController::class,'details'])->name('orders.details');
    
    });
});



