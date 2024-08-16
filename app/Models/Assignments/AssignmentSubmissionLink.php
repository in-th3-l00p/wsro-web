<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmissionLink extends Model
{
    use HasFactory;

    protected $fillable = [
        "link"
    ];

    public function resource() {
        return $this->morphOne(
            AssignmentSubmissionResource::class,
            "resource"
        );
    }
}
