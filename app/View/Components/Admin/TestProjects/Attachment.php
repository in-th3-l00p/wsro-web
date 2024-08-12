<?php

namespace App\View\Components\Admin\TestProjects;

use App\Models\TestProjectAttachment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Attachment extends Component
{
    public function __construct(
        public TestProjectAttachment $attachment
    ) {
    }

    public function render(): View|Closure|string {
        return view('components.admin.test-projects.attachment');
    }
}
