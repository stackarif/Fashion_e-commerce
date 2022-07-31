<?php
use App\Http\Controllers\Frontend\{
    CartController,
    CompareController,
    ContactController,
    CouponController,
    HomeController,
    OrderController,
    ProductController,
    ReviewController,
    SettingsController,
    ShippingController,
    ShopController,
    WishlistController,
    MessageController
};
use App\Http\Controllers\Frontend\Auth\{
    NewPasswordController,
    VerifyEmailController,
    RegisteredUserController,
    PasswordResetLinkController,
    ConfirmablePasswordController,
    AuthenticatedSessionController,
    EmailVerificationPromptController,
    EmailVerificationNotificationController
};

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
#authentication
Route::middleware('guest:customer')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest:customer')
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest:customer');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest:customer')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest:customer');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest:customer')
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest:customer')
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest:customer')
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest:customer')
        ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth:customer', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth:customer', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware('auth:customer')
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware('auth:customer');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:customer')
        ->name('logout');
});

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');

# Sorting
Route::get('sorting/{query}', [ShopController::class, 'sortingProduct'])->name('sorting');


Route::get('product/{product}', [ProductController::class, 'singleProduct'])->name('single-product');
Route::get('search-product/{query}', [ProductController::class, 'dynamicSearch'])->name('dynamic-search');
Route::get('/category-product/{slug}', [ProductController::class, 'categoryWiseProducts'])->name('category-product');
Route::get('/sub-category-product/{slug}', [ProductController::class, 'subCategoryWiseProducts'])->name('sub-category-product');


# Cart
Route::post('cart/{product}', [CartController::class, 'addToCart'])->name('add-to-cart');


Route::middleware('cart')->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'removeSingleItem'])->name('cart.remove_single');
    Route::put('/cart/{id}', [CartController::class, 'updateSingleItem'])->name('cart.update_single');
});

# Coupon
Route::post('coupon', [CouponController::class, 'checkCouponIsValid'])->name('coupon');
Route::delete('coupon', [CouponController::class, 'removeCoupon'])->name('coupon');


# auth
// Route::middleware('guest:customer')->group(function () {
//     Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
//     Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
//     Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
//     Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
// });


# Social Login
Route::get('/auth/redirect/{provider}', [SocialLoginController::class, 'login'])->name(('social.login'));
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('social.callback');

# Shipping
Route::middleware(['auth:customer', 'cart'])->group(function () {
    Route::get('shipping', [ShippingController::class, 'shipping'])->name('shipping');
    Route::post('shipping', [ShippingController::class, 'storeShippingAndOrder'])->name('shipping');
});


Route::middleware('auth:customer')->group(function () {
    # Order
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('order-details/{id}', [OrderController::class, 'getOrderDetails'])->name('order_details');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    # Review
    Route::post('review', [ReviewController::class, 'store'])->name('review');

    # Wishlist
    Route::post('wishlist', [WishlistController::class, 'store'])->name('wishlist');
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::delete('wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    # compare
    Route::post('compare', [CompareController::class, 'store'])->name('compare');
    Route::get('compare', [CompareController::class, 'index'])->name('compare');
    Route::delete('compare/{compare}', [CompareController::class, 'destroy'])->name('compare.destroy');

    # Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings', [SettingsController::class, 'updateInformation'])->name('settings');
    Route::get('password', [SettingsController::class, 'password'])->name('password');
    Route::post('password', [SettingsController::class, 'updatePassword'])->name('password');


    Route::get('/dashboard', function () {
        $navItem = 'dashboard';
        return view('Frontend.dashboard', compact('navItem'));
    })->name('dashboard');

    # Message
    Route::get('message', [MessageController::class, 'index'])->name('message');
    Route::post('message', [MessageController::class, 'store'])->name('message');
    Route::post('reply/{message}', [MessageController::class, 'storeReply'])->name('reply');
});

# Contact
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])->name('contact');



Route::get('test', function () {

    return Storage::get('public/pdf/23.pdf');
    return view('Frontend.cart.shipping');
});
require __DIR__ . '/admin_auth.php';
require __DIR__ . '/admin.php';
