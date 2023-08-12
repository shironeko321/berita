<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name("home");
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name("login");
    Route::prefix("auth")->group(function () {
        Route::post('/login', "check")->name("auth_login");
        Route::get('/logout', "logout")->name("auth_logout");
    });
});

Route::prefix("dashboard")->middleware(['auth'])->group(function () {
    Route::get("/", function () {
        return view("dashboard.dashboard");
    })->name("dashboard_home");
    Route::prefix("article")
        ->controller(ArticleController::class)
        ->group(function () {
            Route::get("/", "index")->name("dashboard_article");
            Route::get("/new", "create")->name("new_article");
            Route::post("/new", "store")->name("store_article");
            Route::get("/edit/{id}", "edit")->name("edit_article");
            Route::put("/edit/{id}", "update")->name("update_article");
            Route::get("/{id}", "show")->name("detail_article");
            Route::delete("/{id}", "destroy")->name("delete_article");
        });
    Route::prefix("users")
        ->controller(UsersController::class)
        ->group(function () {
            Route::get("/", "index")->name("dashboard_users");
            Route::get("/new", "create")->name("new_user");
            Route::post("/new", "store")->name("store_user");
            Route::get("/edit/{id}", "edit")->name("edit_user");
            Route::put("/edit/{id}", "update")->name("update_user");
            Route::get("/{id}", "show")->name("detail_user");
            Route::delete("/{id}", "destroy")->name("delete_user");
        });
});
