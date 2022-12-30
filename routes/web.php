<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;

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

Route::get("/", [ProductsController::class, "home"])->name("home");
Route::get("/login", [UserController::class, "loginView"])->name("loginView");
Route::get("/register", [UserController::class, "registerView"])->name("registerView");
Route::post("/login", [UserController::class, "login"]);
Route::post("/register", [UserController::class, "register"]);
Route::get("logout", [UserController::class, "logout"])->name("logout");

Route::get("/artikelen", [ProductsController::class, "allItems"])->name("artikelen");

Route::get("/algemene-voorwaarden", function(){
    return view("user.algemene-voorwaarden");
});

Route::get("/anti-spam-beleid", function(){
    return view("user.anti-spam-beleid");
});

Route::get("/disclaimer", function(){
    return view("user.disclaimer");
});

Route::get("/veel-gestelde-vragen", function(){
    return view("user.veel-gestelde-vragen");
});

Route::get("/magic-truffles", function(){
    return view("user.magic-truffles");
});

Route::prefix("/admin")->name("admin.")->middleware("admin")->group(function(){
    Route::get("", [ProductsController::class, "index"])->name("dashboard");
});



Route::resource("products", ProductsController::class);
