<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentSubmissionText extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "text"
    ];

    public function resource() {
        return $this->morphOne(
            AssignmentSubmissionResource::class,
            "resource"
        );
    }
}
