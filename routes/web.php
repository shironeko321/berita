<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TagController;
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

Route::get("/test", function () {
    return view("home.test");
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name("home");
    Route::get('/article', 'article')->name("article");
    Route::get('/article/{slug}', 'detailArticle')->name("article.detail");
    Route::get('/category', 'category')->name("category");
    Route::get('/category/{slug}', 'detailCategory')->name("category.detail");
    Route::get('/tags', 'tags')->name("tags");
    Route::get('/tags/{slug}', 'detailTags')->name("tags.detail");
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

    Route::resources([
        "article" => ArticleController::class,
        "category" => CategoryController::class,
        "users" => UsersController::class,
        "tags" => TagController::class,
        "media" => MediaController::class,
    ]);

    Route::post('/upload-image', [MediaController::class, 'uploadImageArticle'])->name("upload.image.media");
});

Route::put('/update-view-content/{id}', [ArticleController::class, 'updateView'])->name('update.view.content');
