<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentSubmissionAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "path"
    ];

    public function resource() {
        return $this->morphOne(
            AssignmentSubmissionResource::class,
            "resource"
        );
    }
}
