<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AssignmentSubmissionResource extends Model
{
    use HasFactory;

    protected $fillable = [
        "assignment_submission_id",
        "assignment_submission_resource_id",
        "assignment_submission_resource_type"
    ];

    public function assignmentSubmission(): BelongsTo {
        return $this->belongsTo(AssignmentSubmission::class);
    }

    public function resource(): MorphTo {
        return $this->morphTo(
            __FUNCTION__,
            "assignment_submission_resource_type",
            "assignment_submission_resource_id"
        );
    }
}
