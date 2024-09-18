<?php

use App\Http\Controllers\Admin\TestProjects\TestProjectAttachmentController;
use Illuminate\Support\Facades\Route;

Route::prefix("/test-projects/{test_project}")->group(function () {
    Route::get(
        "/attachments/delete/{attachment}",
        [TestProjectAttachmentController::class, "delete"]
    )
        ->name("admin.test-projects.attachments.delete");
    Route::get(
        "/attachments/trash",
        [TestProjectAttachmentController::class, "trash"]
    )
        ->name("admin.test-projects.attachments.trash");
    Route::put(
        "/attachments/restore/{attachment}",
        [TestProjectAttachmentController::class, "restore"]
    )
        ->withTrashed()
        ->name("admin.test-projects.attachments.restore");
});
Route::resource(
    "test-projects.attachments",
    TestProjectAttachmentController::class,
    ["as" => "admin"]
);
