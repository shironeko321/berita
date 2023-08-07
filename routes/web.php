<?php

use App\Http\Controllers\articleController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\homeController;
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

Route::inertia('/login', 'login');

Route::controller(homeController::class)->group(function () {
    Route::get('/', "index");
});

Route::controller(articleController::class)->group(function () {
    route::get('/article', 'index');
    route::get('/article/{id}', 'show');
    route::get('/dashboard/editor', 'create');
    // route::post('/dashboard/editor', 'store');
    route::get('/dashboard/editor/{id}', 'edit');
    // route::put('/dashboard/editor/{id}', 'update');
    // route::delete('/dashboard/post/{id}', 'destroy');
});

Route::controller(dashboardController::class)->group(function () {
    route::get('/dashboard', "index");
    route::get('/dashboard/{route}', "route");
});
