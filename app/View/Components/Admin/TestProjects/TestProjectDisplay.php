<?php

namespace App\View\Components\Admin\TestProjects;

use App\Models\TestProject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestProjectDisplay extends Component
{
    public function __construct(
        public TestProject $testProject
    ) {
    }

    public function render(): View|Closure|string {
        return view('components.admin.test-projects.test-project-display');
    }
}
