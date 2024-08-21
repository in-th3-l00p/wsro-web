<?php

use App\Models\TestProjects\TestProject;
use App\Models\TestProjects\TestProjectTag;
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
        Schema::create('test_project_test_project_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TestProject::class)->constrained();
            $table->foreignIdFor(TestProjectTag::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_project_test_project_tag');
    }
};
