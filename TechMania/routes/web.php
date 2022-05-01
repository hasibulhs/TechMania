<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;

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

Route::get('/login', function ()
{
    return view('login');
});

Route::post("/login",[UserController::class,'login']);

Route::get("/",[ProductController::class,'index']);

Route::view('/register','register');
Route::post("/register",[UserController::class,'register']);

Route::post("/checkemail",[UserController::class,'checkEmail']);
Route::get("/verify-email/{verification_code}",[UserController::class,'verify_email'])->name('verify_email');

Route::get("detail/{id}",[ProductController::class,'detail']);
Route::get("search",[ProductController::class,'search']);
Route::post("add_to_cart",[ProductController::class,'addToCart']);

Route::get('/logout', function ()
{
    Session::forget('user');
    return redirect('login');
});

Route::get("cartlist",[ProductController::class,'cartList']);
Route::get("removecart/{id}",[ProductController::class,'removeCart']);
Route::get("ordernow",[ProductController::class,'orderNow']);
Route::post("orderplace",[ProductController::class,'orderPlace']);
Route::get("myorders",[ProductController::class,'myOrders']);

Route::get("change-qty/{id}",[ProductController::class,'changeQty']);

Route::post("add",[RatingController::class,'add']);

Route::get("invoice/{id}",[ProductController::class,'invoice']);