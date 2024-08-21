<?php

namespace App\View\Components\Admin\TestProjects\Attachments;

use App\Models\TestProjects\TestProject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class AttachmentList extends Component
{
    public function __construct(
        public TestProject $testProject,
        public Collection $attachments,
        public ?bool $includeTitle = false,
        public ?bool $includeIndex = false
    ) {
    }

    public function render(): View|Closure|string {
        return view('components.admin.test-projects.attachments.attachment-list');
    }
}
