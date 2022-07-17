<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/danh-muc/{slug}',[HomePageController::class,'category'])->name('category');
Route::get('/thuong-hieu/{slug}',[HomePageController::class,'brand'])->name('brand');
Route::get('/san-pham', [HomePageController::class, 'product'])->name('product');
Route::get('/san-pham/{slug}', [HomePageController::class, 'detail'])->name('detail');
Route::get('/tat-ca-san-pham', [HomePageController::class, 'all_product'])->name('all_product');
Route::get('/lien-he', [HomePageController::class, 'contact'])->name('contact');

Route::get('/login', [HomePageController::class, 'login'])->name('login');
Route::post('/login', [HomePageController::class, 'customer_login'])->name('customer_login');
Route::post('/add-customer', [HomePageController::class, 'add_customer'])->name('add_customer');

Route::get('/logout', [HomePageController::class, 'logout'])->name('logout');

Route::get('/send-mail',[HomePageController::class,'send_mail']);


//Search
Route::post('/search', [HomePageController::class, 'search'])->name('search');
Route::post('/autocomplete-ajax', [HomePageController::class, 'autocomplete_ajax']);


//Quickview
Route::post('/quickview', [HomePageController::class, 'quickview'])->name('quickview');
// comment
Route::post('/load-comment', [HomePageController::class, 'load_comment'])->name('load_comment');
Route::post('/send-comment', [HomePageController::class, 'send_comment'])->name('send_comment');
Route::post('insert-rating', [HomePageController::class, 'insert_rating']);


Route::post('/save-product', [CartController::class, 'save_product'])->name('save.product');
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
//Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart'])->name('delete.cart');
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity'])->name('update.quantity');


//Cart ajax
Route::post('/add-cart-ajax',[CartController::class, 'add_cart_ajax']);
//Delete session
Route::get('/delete-all', [CartController::class, 'delete_all_cart']);
Route::get('/delete-product/{session_id}', [CartController::class, 'delete_product'])->name('delete.product');
Route::post('/update-cart', [CartController::class, 'update_cart'])->name('update.cart');
//Route::post('/check-coupon', [CartController::class, 'check_coupon'])->name('checkcoupon');
Route::post('/check-coupon-ajax', [CartController::class, 'check_coupon_ajax']);


//Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
//Route::post('/payment', [CheckoutController::class, 'payment'])->name('payment');
Route::post('/coupon', [CheckoutController::class, 'coupon'])->name('coupon');
Route::post('/select-delivery', [CheckoutController::class, 'select_delivery']);
Route::post('/calculate-delivery', [CheckoutController::class, 'calculate_delivery']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);



//Admin
//Route::get('/admin/login', [AdminController::class, 'loginAdmin']);
//Route::post('/admin/login', [AdminController::class, 'postLogin'])->name('admin.login');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/register-admin', [AuthController::class, 'register_admin'])->name('admin.register_admin');
Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register');
Route::get('/admin/login', [AuthController::class, 'loginAdmin']);
Route::post('/admin/login', [AuthController::class, 'postLogin'])->name('admin.login');


//Category
Route::resource('/admin/category', CategoryController::class);
Route::post('category-status', [CategoryController::class, 'category_status']);


//Brand
//Route::resource('/admin/brand', BrandController::class);
//Route::post('brand-status', [BrandController::class, 'brand_status']);


//Product
Route::resource('/admin/product', ProductController::class);
Route::post('product-status', [ProductController::class, 'product_status']);
Route::get('/admin/create_product_price/{product_id}', [ProductController::class,'create_product_price'])->name('admin.create_product_price');
Route::get('/admin/edit_product_price/{product_id}', [ProductController::class,'edit_product_price'])->name('admin.edit_product_price');
Route::post('product-price-store/{product_id}', [ProductController::class, 'product_price_store'])->name('product_price.store');
Route::post('product-price-update/{product_id}', [ProductController::class, 'product_price_update'])->name('product_price.update');
Route::post('import-csv', [ProductController::class, 'import_csv'])->name('import-csv');
Route::post('export-csv', [ProductController::class, 'export_csv'])->name('export-csv');

//Gallery
Route::get('/admin/create_gallery/{product_id}', [GalleryController::class,'add_gallery'])->name('admin.create_gallery');
Route::post('/admin/select-gallery', [GalleryController::class, 'select_gallery']);
Route::post('/admin/insert-gallery/{product_id}', [GalleryController::class, 'insert_gallery'])->name('admin.insert_gallery');
Route::post('/admin/update-gallery-name', [GalleryController::class, 'update_gallery_name']);
Route::post('/admin/delete-gallery', [GalleryController::class, 'delete_gallery']);


//Manage_order
Route::get('/admin/order', [OrderController::class, 'manage_order'])->name('admin.order');
Route::get('/admin/view-order/{order_code}', [OrderController::class, 'view_order'])->name('view_order');
Route::post('/admin/delete-order/{id}', [OrderController::class, 'destroy_order'])->name('manage_order.destroy');
Route::post('order-status', [OrderController::class, 'order_status']);
//In file pdf
Route::get('/admin/print-details/{checkout_code}', [OrderController::class, 'print_details'])->name('admin.print_details');


//Coupon
Route::resource('/admin/coupon', CouponController::class);
Route::post('coupon-status', [CouponController::class, 'coupon_status']);


//Delivery
Route::get('/admin/delivery', [DeliveryController::class, 'index'])->name('admin.delivery');

Route::post('/admin/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/admin/create-delivery', [DeliveryController::class, 'add_delivery']);

Route::post('/admin/load-delivery', [DeliveryController::class, 'load_delivery']);
Route::post('/admin/update-delivery', [DeliveryController::class, 'update_delivery']);


//Slider
Route::resource('/admin/slider', SliderController::class);
Route::post('slider-status', [SliderController::class, 'slider_status']);


//Comment
Route::get('/admin/comment', [CommentController::class, 'index'])->name('admin.comment');
Route::post('comment-status', [CommentController::class, 'comment_status']);
Route::post('reply-comment', [CommentController::class, 'reply_comment']);
Route::get('/admin/delete-comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');


//Thong ke
Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);
Route::post('/dashboard-filter', [AdminController::class, 'dashboard_filter']);
Route::post('/days-order', [AdminController::class, 'days_order']);


//User
Route::resource('/admin/user', UserController::class);
Route::post('user-status', [UserController::class, 'user_status']);
