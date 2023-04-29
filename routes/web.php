<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageRouteController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\WelcomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\User\AddToCartController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\User\ProductPageController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\User\ProductDetailController;
use App\Http\Controllers\User\ProductSearchController;
use App\Http\Controllers\User\RateAndReviewController;

// Routes allowed with login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Admin
    Route::middleware('admin.auth')->group(function () {
        // Admin Pages
        Route::prefix('admin')->name('admin.')->group(function () {
            // Admin Dashboard
            Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

            // Category CRUD
            Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
                Route::get('/', 'categoryPage')->name('page');
                Route::post('create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('update', 'update')->name('update');
                // Route::get('/delete/{id}', 'delete')->name('delete');
            });

            // Product CRUD
            Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
                Route::get('/', 'productPage')->name('page');
                Route::get('/create', 'createPage')->name('create.page');
                Route::post('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::get('/delete/{id}', 'delete')->name('delete');
            });

            // Admin Contact
            Route::prefix('contact')->name('contact.')->controller(AdminContactController::class)->group(function() {
                Route::get('/', 'contactList')->name('list');
                Route::get('/delete/{id}', 'contactDelete')->name('delete');
            });

            // Admin Order
            Route::controller(AdminOrderController::class)->group(function() {
                Route::get('/order', 'orderList')->name('order');
                Route::post('/order/action', 'orderAction')->name('order.action');
                Route::get('/delete/{id}', 'orderDelete')->name('order.delete');
            });

            // Admin subscriber control
            Route::controller(SubscriberController::class)->group(function() {
                Route::get('/subscribers/list', 'subscriberList')->name('subscribers.list');
                Route::get('/subscribers/delete/{id}', 'delete')->name('subscribers.delete');
            });

            // Admin Profile Data RUD
            Route::prefix('profile')->name('profile.')->controller(AdminUserController::class)->group(function () {
                Route::get('/', 'adminProfilePage')->name('page');
                Route::post('/update/{id}', 'update')->name('update');
            });

            //Admin Password Changing
            Route::post('profile/changepassword/{id}', [AuthController::class, 'changePassword'])->name('profile.changepassword');
        });
    });

    // User
    // user profile Data RUD
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'userProfilePage')->name('user.profile.page');
        Route::post('/profile/update/{id}', 'update')->name('user.profile.update');
    });

    //User Password Changing
    Route::post('profile/changepassword/{id}', [AuthController::class, 'changePassword'])->name('user.profile.changepassword');

    // Cart
    Route::prefix('cart')->controller(AddToCartController::class)->group(function () {
        Route::get('/', 'cartPage')->name('cartpage');
        Route::get('/ajax', 'addToCart')->name('addtocart.ajax');
        Route::post('/add', 'addToCartByForm')->name('addtocart');
        Route::get('/ajax/list', 'cartList')->name('cartlist');
        Route::get('/delete/{id}', 'cartDelete')->name('cart.delete');
        Route::post('checkout', 'checkout')->name('checkout');
    });

    // Wishlist
    Route::prefix('wishlist')->controller(WishlistController::class)->group(function() {
        Route::get('/', 'wishlistPage')->name('wishlistpage');
        Route::get('/ajax', 'addToWishlist')->name('addtowishlist.ajax');
        Route::post('/add', 'addToWishlistByForm')->name('addtowishlist');
        Route::get('/ajax/list', 'wishlistList')->name('wishlist.list');
    });

    // Review And Rate create
    Route::post('/review/create', [RateAndReviewController::class, 'reviewCreate'])->name('review.create');

    // Order
    Route::post('/order', [OrderController::class, 'order'])->name('order');
});

// Routes without login
Route::controller(WelcomeController::class)->group(function() {
    Route::get('/', 'welcomePage')->name('welcome');
});

// subscribe
Route::post('subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');

// product detail page
Route::controller(ProductDetailController::class)->group(function () {
    Route::get('/product-detail/{id}', 'productDetailPage')->name('productdetail');
});

// product
Route::controller(ProductPageController::class)->group(function() {
    Route::get('/product', 'productPage')->name('productpage');
    Route::get('/product/ajax', 'productAjax')->name('product.ajax');
    Route::get('/product/ajax/all', 'productAjaxAll')->name('product.ajax.all');
});

// product review page
Route::get('/review/{id}', [RateAndReviewController::class, 'reviewPage'])->name('reivew.page');

// product search
Route::controller(ProductSearchController::class)->group(function() {
    Route::post('/search', 'search')->name('search');
});

// contact page
Route::prefix('contact')->name('contact.')->controller(ContactController::class)->group(function() {
    Route::get('/', 'contactPage')->name('page');
    Route::post('/create', 'contactCreate')->name('create');
});
