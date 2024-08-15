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
        Schema::create('assignment_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreignIdFor(Assignment::class)
                ->constrained("assignments");

            $table
                ->foreignIdFor(User::class)
                ->constrained("users");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_user');
    }
};
