<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        "assignment_user_id",
        "description",
        "status"
    ];

    public function assignment() {
        return $this->hasOneThrough(
            Assignment::class,
            "assignment_user",
            "assignment_user_id",
            "assignment_id"
        );
    }
}
