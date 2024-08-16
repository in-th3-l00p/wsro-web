<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        "assignment_user_id",
        "description",
        "status"
    ];

    public function assignment(): HasOneThrough {
        return $this->hasOneThrough(
            Assignment::class,
            "assignment_user",
            "id",
            "id",
            "assignment_user_id",
            "assignment_id"
        );
    }

    public function resources(): HasMany {
        return $this->hasMany(AssignmentSubmissionResource::class);
    }
}
