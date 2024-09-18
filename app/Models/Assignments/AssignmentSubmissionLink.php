<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentSubmissionLink extends Model
{
    use HasFactory, SoftDeletes;

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
