<?php

use App\Http\Controllers\Admin\Assignments\AssignmentSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/assignments/{assignment}/submissions/delete/{submission}',
    [AssignmentSubmissionController::class, 'delete'
])
    ->name('admin.assignments.submissions.delete');

Route::get(
    '/assignments/{assignment}/submissions/trash',
    [AssignmentSubmissionController::class, 'trash']
)
    ->name('admin.assignments.submissions.trash');

Route::put(
    '/assignments/{assignment}/submissions/restore/{id}',
    [AssignmentSubmissionController::class, 'restore']
)
    ->withTrashed()
    ->name('admin.assignments.submissions.restore');

Route::resource(
    'assignments.submissions',
    AssignmentSubmissionController::class,
    ['as' => 'admin.assignments']
);
