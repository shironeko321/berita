<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class homeLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $article = false,
        public bool $category = false,
        public bool $tags = false,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home-layout');
    }
}
