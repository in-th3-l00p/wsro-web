<?php

use App\Models\Assignments\Assignment;
use App\Models\User;
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
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->text("description");
            $table->enum("status", [ "assigned", "turned_in" ]);

            $table
                ->foreignIdFor(User::class)
                ->constrained("users");

            $table
                ->foreignIdFor(Assignment::class)
                ->constrained("assignments");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};
