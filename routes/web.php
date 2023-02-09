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
Route::get("/", [UserController::class, "test"])->name("test");
Route::post("/", [UserController::class, "testPost"]);
Route::get("/home", [ProductsController::class, "home"])->name("home");
Route::get("/login", [UserController::class, "loginView"])->name("loginView");
Route::get("/register", [UserController::class, "registerView"])->name("registerView");
Route::post("/login", [UserController::class, "login"])->name("login");
Route::post("/register", [UserController::class, "register"]);
Route::get("logout", [UserController::class, "logout"])->name("logout");
Route::get("/artikelen", [ProductsController::class, "allItems"])->name("artikelen");
Route::get("/artikelen/{artikelId}", [ProductsController::class, "singleItem"])->name("singleItem");
Route::post("/artikelen/{artikelId}", [ProductsController::class, "addToCart"]);
Route::post("/artikelen/{artikelId}/review", [ProductsController::class, "singleItemReview"])->name("singleItemReview");
Route::get("/winkelwagen", [ProductsController::class, "shoppingCartView"])->name("shoppingCartView");
Route::post("/winkelwagen", [ProductsController::class, "removeFromCart"]);
Route::get("/afrekenen", [ProductsController::class, "payView"])->name("payViewGet");
Route::post("afrekenen", [ProductsController::class, "payView"])->name("payView");
Route::get("/afrekenen-details", [ProductsController::class, "payCredentialsView"])->name("payCredentialsView");
Route::post("/afrekenen-details", [ProductsController::class, "checkout"])->name("checkout");
Route::get("/betaling-succes", [ProductsController::class, "success"])->name("success");

Route::get("/algemene-voorwaarden", function(){
    return view("user.algemene-voorwaarden");
})->name("algemene-voorwaarden");

Route::get("/anti-spam-beleid", function(){
    return view("user.anti-spam-beleid");
});

Route::get("/disclaimer", function(){
    return view("user.disclaimer");
})->name("disclaimer");

Route::get("/veel-gestelde-vragen", function(){
    return view("user.veel-gestelde-vragen");
});

Route::get("/magic-truffles", function(){
    return view("user.magic-truffles");
});

Route::get("/betaling-test", function(){
   return view("user.success");
});

Route::get("sendmail", [UserController::class, "sendMail"]);
Route::get("downloadPdf", [UserController::class, "generatePDF"]);

Route::prefix("/admin")->name("admin.")->middleware("admin")->group(function(){
    Route::get("", [ProductsController::class, "index"])->name("dashboard");
    Route::resource("products", ProductsController::class);
    Route::post("products/{productId}/edit/images", [ProductsController::class, "multipleImagesSingleItem"])->name("multipleImages");
    Route::post("products/{productId}/edit/delete", [ProductsController::class, "deleteProductImage"])->name("deleteProductImage");
    Route::get("orders", [UserController::class, "orders"])->name("orders");
    Route::get("archive", [UserController::class, "archive"])->name("archive");
    Route::get("archive/{productId}", [UserController::class, "archiveProduct"])->name("archiveProduct");
});
