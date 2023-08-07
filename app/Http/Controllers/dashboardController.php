<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class dashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('dashboard', [
            'content' => 'dashboard'
        ]);
    }

    public function route($route)
    {
        $router = ["dashboard", "article", "admin"];

        if (in_array($route, $router)) $content = $route;
        else $content = "dashboard";

        return Inertia::render('dashboard', [
            'content' => $content
        ]);
    }
}
