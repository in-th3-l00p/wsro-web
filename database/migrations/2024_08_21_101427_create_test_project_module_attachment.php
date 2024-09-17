<?php

use App\Models\TestProjects\TestProjectAttachment;
use App\Models\TestProjects\TestProjectModule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_project_module_attachment', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(TestProjectModule::class)
                ->constrained("test_project_modules", "id", "id")
                ->onDelete('cascade');

            $table->foreignId('test_project_attachment_id')
                ->constrained('test_project_attachments')
                ->name('fk_test_project_attachment_id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_project_module_attachment');
    }
};
