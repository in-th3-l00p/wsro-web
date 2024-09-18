<?php

use App\Http\Controllers\Admin\Assignments\AssignmentAttachmentController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/assignments/{assignment}/attachments/delete/{attachment}',
    [AssignmentAttachmentController::class, 'delete']
)
    ->name('admin.assignments.attachments.delete');

Route::get(
    '/assignments/{assignment}/attachments/trash',
    [AssignmentAttachmentController::class, 'trash']
)
    ->name('admin.assignments.attachments.trash');

Route::put(
    '/assignments/{assignment}/attachments/restore/{attachment}',
    [AssignmentAttachmentController::class, 'restore']
)
    ->withTrashed()
    ->name('admin.assignments.attachments.restore');

Route::resource(
    'assignments.attachments',
    AssignmentAttachmentController::class,
    ['as' => 'admin']
);
