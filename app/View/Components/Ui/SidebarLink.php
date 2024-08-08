<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLink extends Component {
    public function __construct(
        public string $icon,
        public string $route,
    ) { }

    public function render(): View|Closure|string {
        return view('components.ui.sidebar-link');
    }
}
