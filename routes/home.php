<?php

use App\Http\Controllers\paymentController;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\profile\updateAccount;
use App\Http\Controllers\search\searchActionController;
use App\Http\Livewire\Home\About\Index as AboutIndex;
use App\Http\Livewire\Home\Article\AllArticle;
use App\Http\Livewire\Home\Article\Category;
use App\Http\Livewire\Home\Article\SingleArticle;
use App\Http\Livewire\Home\Article\Subcategory;
use App\Http\Livewire\Home\BankPayment\Index as BankPaymentIndex;
use App\Http\Livewire\Home\Cart\Index as CartIndex;
use App\Http\Livewire\Home\Contact\Index as ContactIndex;
use App\Http\Livewire\Home\Home\Index;
use App\Http\Livewire\Home\Order\Completed;
use App\Http\Livewire\Home\Order\Index as OrderIndex;
use App\Http\Livewire\Home\Product\AllProduct;
use App\Http\Livewire\Home\Product\Category as ProductCategory;
use App\Http\Livewire\Home\Product\Index as ProductIndex;
use App\Http\Livewire\Home\Product\QuickView;
use App\Http\Livewire\Home\Product\Subcategory as ProductSubcategory;
use App\Http\Livewire\Home\Profile\AccountDetails;
use App\Http\Livewire\Home\Profile\Comment;
use App\Http\Livewire\Home\Profile\EditPassword;
use App\Http\Livewire\Home\Profile\Favorite;
use App\Http\Livewire\Home\Profile\ForgetPassword;
use App\Http\Livewire\Home\Profile\Index as ProfileIndex;
use App\Http\Livewire\Home\Profile\Invoice;
use App\Http\Livewire\Home\Profile\Order;
use App\Http\Livewire\Home\Profile\Payment;
use App\Http\Livewire\Home\Profile\VerifyCode;
use App\Http\Livewire\Home\Users\LoginRegister;
use App\Http\Livewire\Home\Users\VerifyPhone;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;
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

// Route::middleware(['auth:sanctum','verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/', Index::class)->name('home.index');

Route::post('/search', [searchActionController::class, 'searchAction'])->name('search');


Route::get('/login', function () {
    return redirect()->route('login.register.index');
})->name('login');

// Route::get('/register', function () {
//     return redirect()->route('login.register.index');
// })->name('login');


//newLatter in footer

Route::post('/newletter', [Postcontroller::class, 'newletter'])->name('post.newletter');

//START ARTICLE

Route::get('blog/{link}', SingleArticle::class)->name('article.single.index');

Route::get('/blogs', AllArticle::class)->name('article.all.index');

Route::get('/blogs/ca/{link}', Category::class)->name('article.category.index');

Route::get('/blogs/su/{link}', Subcategory::class)->name('article.subcategory.index');

//END ARTICLE

// START PRODUCT

Route::get('/product-{id}/{link}', ProductIndex::class)->name('product.single.index')->middleware('web');
Route::get('/products', AllProduct::class)->name('product.all');
Route::get('/category/{category}', ProductCategory::class)->name('product.category.index');
Route::get('/subcategory/{subcategory}', ProductSubcategory::class)->name('product.subcategory.index');

Route::get('/product-quick-view-{id}', QuickView::class)->name('product.quick.view');
//END PRODUCT

// START CART
Route::get('/cart', CartIndex::class)->name('cart.index');
// END CART

// START CART
Route::get('/order/{order}', OrderIndex::class)->name('order.index');
// END CART

//START ABOUT US
Route::get('/about-us', AboutIndex::class)->name('about.index');
//END ABOUT US


//START CONTACT US
Route::get('/contact-us', ContactIndex::class)->name('contact.index');
//END CONTACT US

//
//BANK PAYMENT
Route::get('/payment/order-{order_number}', BankPaymentIndex::class)->name('bank.payment.index')->middleware('auth');
//BANK PAYMENT

// PAY PAMENT
Route::get('/payment/pooshyar', [paymentController::class, 'payment'])->middleware('auth');

Route::get('/pay/pooshyar', [paymentController::class, 'callback'])->middleware('auth');

// PAY PAMENT

//ORDER COMPLETED
Route::get('/order-completed', Completed::class)->name('order.completed')->middleware('auth');
//ORDER COMPLETED

//PROFILE USER
Route::get('/my-account/dashboard', ProfileIndex::class)->name('profile.index')->middleware('auth');

Route::get('/my-account/orders', Order::class)->name('profile.orders')->middleware('auth');

Route::get('/my-account/favorites', Favorite::class)->name('profile.favorites')->middleware('auth');

Route::get('/my-account/comments', Comment::class)->name('profile.comments')->middleware('auth');

Route::get('/my-account/payments', Payment::class)->name('profile.payments')->middleware('auth');

Route::get('/my-account/details', AccountDetails::class)->name('profile.details')->middleware('auth');


Route::post('/update/account-{id}', [updateAccount::class, 'update'])->name('update.account')->middleware('auth');

Route::get('/my-account/order/{id}/invoice', Invoice::class)->name('profile.order.invoice')->middleware('auth');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout.index')->middleware('auth');

Route::get('/forget-password', ForgetPassword::class)->name('profile.forget-password')->middleware('auth');

Route::get('/forget-password/veify-phone', VerifyCode::class)->name('profile.verify.phone')->middleware('auth');

Route::get('/reset-password-user/{poo}', EditPassword::class)->name('profile.reset.passwordd')->middleware('auth');


//PROFILE USER

// REGISTER & LOGIN

Route::get('/login-user', LoginRegister::class)->name('login.register.index')->middleware('throttle:10,1');


Route::get('/verify/phone', VerifyPhone::class)->name('login.verify.phone')->middleware('throttle:10,1');

// REGISTER & LOGIN

//START CREATE SITE MAP
Route::get('/create-sitemap',function(){
    SitemapGenerator::create(env('APP_URL'))->writeToFile(public_path('sitemap.xml'));
     return back();
});

//END CREATE SITE MAP

// Route::get('optimize',function(){
//     Artisan::call('optimize:clear');
//     Artisan::call('view:clear');
//     Artisan::call('view:cache');
//     Artisan::call('route:clear');
//     Artisan::call('route:cache');
//     Artisan::call('config:clear');
//     Artisan::call('config:cache');
//     Artisan::call('cache:clear');

// return 'successfuly';

// });
