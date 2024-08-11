<?php

namespace App\View\Components\Admin\TestProjects;

use App\Models\TestProjectTag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagDisplay extends Component
{
    public function __construct(
        public TestProjectTag $tag
    ) { }

    public function render(): View|Closure|string {
        return view('components.admin.test-projects.tag-display');
    }
}
