<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class DashboardLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $dashboard = false,
        public bool $article = false,
        public bool $users = false,
        public bool $category = false,
        public bool $tags = false,
        public bool $media = false,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $first_name = isset(Auth::user()->first_name) ? Auth::user()->first_name : "guest";
        $last_name = isset(Auth::user()->last_name) ? Auth::user()->last_name : "";

        return view('components.dashboard-layout', [
            "firstname" => $first_name,
            "lastname" => $last_name,
        ]);
    }
}
