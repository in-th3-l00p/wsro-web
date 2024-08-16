<?php

use App\Models\Assignments\AssignmentSubmission;
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
        Schema::create('assignment_submission_resources', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table
                ->foreignIdFor(AssignmentSubmission::class)
                ->constrained("assignment_submissions");

            $table->foreignId("assignment_submission_resource_id");
            $table->string("assignment_submission_resource_type");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_submission_resources');
    }
};
