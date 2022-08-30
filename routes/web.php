<?php

use App\Http\Controllers\Admin\NexmoController;
use App\Http\Controllers\Blog\{
    BlogCategoryController,
    BlogContactController,
    BlogDashboardController,
    BlogFrontendController,
    BlogpostController,
    BlogsettingController,
    BlogSubCategoryController,
    BlogUserController,
    TagController,
};
use App\Http\Controllers\Frontend\{
    CartController,
    CompareController,
    ContactController,
    CouponController,
    DashboardController,
    HomeController,
    OrderController,
    ProductController,
    ReviewController,
    SettingsController,
    ShippingController,
    ShopController,
    WishlistController,
    MessageController,
    NexmoController as FrontendNexmoController
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
use App\Models\Blogcontact;
use Illuminate\Support\Facades\Auth;
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

    Route::get('/verify',[FrontendNexmoController::class,'verify'])->name('verify');
        //->middleware('auth:customer');
    
    Route::post('/verify',[NexmoController::class,'post_verify']);
       // ->middleware('auth:customer');    
        

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

#otp
Route::get('/otp',[NexmoController::class,'otp'])->name('otp');
Route::post('/otp',[NexmoController::class,'otp_mail']);

#Home
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
    #dashboard
    Route::get('dashboard', [DashboardController::class, 'dash'])->name('dashboard')
    ->middleware(['auth:customer']);

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
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'updateInformation'])->name('settings');
    Route::get('/password', [SettingsController::class, 'password'])->name('password');
    Route::post('/password', [SettingsController::class, 'updatePassword'])->name('password');

    # Message
    Route::get('message', [MessageController::class, 'index'])->name('message');
    Route::post('message', [MessageController::class, 'store'])->name('message');
    Route::post('reply/{message}', [MessageController::class, 'storeReply'])->name('reply');
});

# Contact
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])->name('contact');

//blog start
Route::get('blog_website',function(){
    return view('layouts.website');

});



//Blog start 

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Front End Routes
Route::get('/home_blog', [BlogFrontendController::class,'home'])->name('website');
Route::get('/about', [BlogFrontendController::class,'about'])->name('website.about');
Route::get('/category/{slug}', [BlogFrontendController::class,'category'])->name('website.category');
Route::get('/tag/{slug}', [BlogFrontendController::class,'tag'])->name('website.tag');
Route::get('/blog_contact', [BlogFrontendController::class,'contact'])->name('website.contact');
Route::get('/post/{slug}',[BlogFrontendController::class,'post'])->name('website.post');

Route::post('/contact', [BlogFrontendController::class,'home'])->name('website.contact');
// Admin Panel Routes

Route::group(['prefix' => 'blogadmin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard',[BlogDashboardController::class,'index'])->name('dashboard');

    Route::resource('category', BlogCategoryController::class);
    Route::resource('sub_category', BlogSubCategoryController::class);
    Route::resource('tag', TagController::class);
    Route::resource('post', BlogpostController::class);
    Route::resource('user', BlogUserController::class);
    Route::get('/profile', [BlogUserController::class,'profile'])->name('user.profile');
    Route::post('/profile',[BlogUserController::class,'profile_update'])->name('user.profile.update');
    
    // setting
    Route::get('setting', [BlogsettingController::class,'edit'])->name('setting.index');
    Route::post('setting', [BlogsettingController::class,'update'])->name('setting.update');

    // Contact message
    Route::get('/contact',[BlogContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/show/{id}', 'ContactController@show')->name('contact.show');
    Route::delete('/contact/delete/{id}', 'ContactController@destroy')->name('contact.destroy');
});




Route::get('test', function () {

    return Storage::get('public/pdf/23.pdf');
    return view('Frontend.cart.shipping');
});
require __DIR__ . '/admin_auth.php';
require __DIR__ . '/admin.php';
