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

Route::view('/login', 'login');

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
});

Route::prefix("auth")
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('/login', "login");
        Route::get('/logout', "logout");
    });

Route::prefix("dashboard")->group(function () {
    Route::get("/", function () {
        return view("dashboard.dashboard");
    });
    Route::prefix("article")
        ->controller(ArticleController::class)
        ->group(function () {
            Route::get("/", "index");
            Route::get("/editor", "create");
            Route::post("/editor", "store");
            Route::get("/editor/{id}", "edit");
            Route::put("/editor/{id}", "update");
            Route::get("/{id}", "show");
        });
    Route::prefix("users")
        ->controller(UsersController::class)
        ->group(function () {
            Route::get("/", "index");
            Route::get("/new", "create");
            Route::post("/new", "store");
            Route::get("/edit/{id}", "edit");
            Route::put("/edit/{id}", "update");
            Route::get("/{id}", "show");
        });
});
