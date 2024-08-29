<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\landingPage\HomeController;
use App\Http\Controllers\landingPage\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
//     return view('template-landingPage.master');
// });



Route::group(['middleware' => ['auth', 'checkRole:admin', 'revalidateBackHistory']], function(){
    // dashboard admin
    Route::get('/dashboard-admin',[DashboardController::class,'index'])->name('dashboard-admin');
    // end

    // product
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::get('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
    // end

    // user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // end

    // brand
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');;
    Route::get('/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    // end

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    // end

    // flow approval pesanan di admin
    Route::get('/admin/waiting-to-payment',[AdminController::class,'waitToPayment'])->name('admin.waitingToPayment');
    Route::get('/admin/packed',[AdminController::class,'packed'])->name('admin.packed');
    Route::get('/admin/in-delivery',[AdminController::class,'inDelivery'])->name('admin.inDelivery');
    Route::get('/admin/finish',[AdminController::class,'finish'])->name('admin.finish');
    Route::get('/admin/update-status',[AdminController::class,'updateStatus'])->name('admin.updateStatus');
    Route::get('/admin/show',[AdminController::class,'showData'])->name('admin.showData');
    // end

    // laporan admin
    Route::get('/admin/laporan',[AdminController::class,'laporan'])->name('admin.laporan');
    Route::post('/admin/generate-pdf', [AdminController::class, 'generatePDF'])->name('generate.pdf');
    Route::post('/admin/pdf-topSelling', [DashboardController::class, 'generatePDFSelling'])->name('generate.pdf-topSelling');
    // end
});

Route::group(['middleware' => ['auth', 'checkRole:customer', 'revalidateBackHistory']], function(){
    // dashboard user auth
    Route::get('/dashboard',[DashboardController::class,'indexCustomer'])->name('dashboard');
    // end

    // flow pesanan
    Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout');
    Route::get('/cart',[HomeController::class,'cart'])->name('cart');
    Route::get('/cart/add',[ShopController::class,'addCart'])->name('cart.add');
    Route::post('/cart/{id}',[ShopController::class,'storeCart'])->name('cart.store');
    Route::get('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout');
    Route::post('/place-order',[ShopController::class,'placeOrder'])->name('placeOrder');
    Route::get('/selectPayment/{processcode}',[HomeController::class,'selectPayment'])->name('selectPayment');
    // end

    // status pesanan
    Route::get('/waiting-to-payment',[TransactionController::class,'waitToPayment'])->name('waitingToPayment');
    Route::get('/packed',[TransactionController::class,'packed'])->name('packed');
    Route::get('/in-delivery',[TransactionController::class,'inDelivery'])->name('inDelivery');
    Route::get('/finish',[TransactionController::class,'finish'])->name('finish');
    Route::get('/update-status',[TransactionController::class,'updateStatus'])->name('updateStatus');
    Route::get('/update-transaction-status/{transactionID}',[HomeController::class,'goToPackedWithReturn'])->name('goToPackedWithReturn');
    // end

    // invoice
    Route::get('/invoice',[InvoiceController::class,'invoiceCustomer'])->name('invoice');
    // end
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});
// auth
Route::get('/login',[AuthController::class,'getLogin'])->name('login');
Route::post('/postlogin',[AuthController::class,'postLogin'])->name('postlogin');
Route::get('/register',[AuthController::class,'getRegister'])->name('register');
Route::post('/postregister',[AuthController::class,'postRegister'])->name('postregister');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

// end

// landingPage no auth
Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/shop',[HomeController::class,'shop'])->name('shop');
Route::get('/shop/detail/{id}',[HomeController::class,'shopDetail'])->name('shop.detail');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
// end

Route::get('/forgot-password', function () {
    return view('auths.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auths.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

 
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');