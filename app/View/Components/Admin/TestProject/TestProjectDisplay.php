<?php

namespace App\View\Components\Admin\TestProject;

use App\Models\TestProject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestProjectDisplay extends Component
{
    public function __construct(
        public TestProject $testProject
    ) {
        //
    }

    public function render(): View|Closure|string {
        return view('components.admin.test-project.test-project-display');
    }
}
