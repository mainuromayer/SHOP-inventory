<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Web API Routes ----------------------------------------------------
Route::post('/user-signup',[UserController::class,'UserSignup']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
// Token Verify
Route::post('/reset-password',[UserController::class,'ResetPassword'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/user-profile',[UserController::class,'UserProfile'])
    ->middleware(TokenVerificationMiddleware::class);
Route::post('/user-update',[UserController::class,'UpdateProfile'])
    ->middleware(TokenVerificationMiddleware::class);


// User Logout ----------------------------------------------------
Route::get('/logout',[UserController::class, 'UserLogout']);



// Authentication Web Page Routes ----------------------------------------------------
Route::get('/', function () {
    return redirect('/userLogin');
});
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userSignup',[UserController::class,'SignupPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOtpPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])
    ->middleware(TokenVerificationMiddleware::class);



// Dashboard Page Routes ----------------------------------------------------
Route::get('/dashboard',[UserController::class,'DashboardPage'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/userProfile',[UserController::class,'ProfilePage'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/customerPage',[CustomerController::class,'customerPage'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/productPage',[ProductController::class,'ProductPage'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/invoicePage',[InvoiceController::class,'InvoicePage'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/salePage',[InvoiceController::class,'SalePage'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/reportPage',[ReportController::class,'ReportPage'])
    ->middleware(TokenVerificationMiddleware::class);




// Category API Routes ----------------------------------------------------
Route::post('/create-category',[CategoryController::class,'CategoryCreate'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/list-category',[CategoryController::class,'CategoryList'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/update-category',[CategoryController::class,'CategoryUpdate'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/delete-category',[CategoryController::class,'CategoryDelete'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/category-by-id',[CategoryController::class,'CategoryByID'])
    ->middleware(TokenVerificationMiddleware::class); // get method also usable




// Customer API Routes ----------------------------------------------------
Route::post('/create-customer',[CustomerController::class,'CustomerCreate'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/list-customer',[CustomerController::class,'CustomerList'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/update-customer',[CustomerController::class,'CustomerUpdate'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/delete-customer',[CustomerController::class,'CustomerDelete'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/customer-by-id',[CustomerController::class,'CustomerByID'])
    ->middleware(TokenVerificationMiddleware::class); // get method also usable




// Product API Routes ----------------------------------------------------
Route::post('/create-product',[ProductController::class,'CreateProduct'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/list-product',[ProductController::class,'ProductList'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/update-product',[ProductController::class,'ProductUpdate'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/delete-product',[ProductController::class,'ProductDelete'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post("/product-by-id",[ProductController::class,'ProductByID'])
    ->middleware([TokenVerificationMiddleware::class]); // get method also usable




// Invoice API Routes ----------------------------------------------------
Route::post('/invoice-create',[InvoiceController::class,'InvoiceCreate'])
    ->middleware(TokenVerificationMiddleware::class);

Route::get('/invoice-select',[InvoiceController::class,'InvoiceSelect'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/invoice-details',[InvoiceController::class,'InvoiceDetails'])
    ->middleware(TokenVerificationMiddleware::class);

Route::post('/invoice-delete',[InvoiceController::class,'InvoiceDelete'])
    ->middleware(TokenVerificationMiddleware::class);



// SUMMARY & Report
Route::get("/summary",[DashboardController::class,'Summary'])->middleware(TokenVerificationMiddleware::class);
Route::get("/sales-report/{FormDate}/{ToDate}",[ReportController::class,'SalesReport'])->middleware(TokenVerificationMiddleware::class);
