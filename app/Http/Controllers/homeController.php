<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class homeController extends Controller
{
    public function index()
    {
        return Inertia::render('home');
    }

    public function article()
    {
        return Inertia::render('article');
    }
}
