<?php

namespace App\View\Components\Admin\TestProjects\Attachments;

use App\Models\TestProjects\TestProjectAttachment;
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
        return view('components.admin.test-projects.attachments.attachment');
    }
}
