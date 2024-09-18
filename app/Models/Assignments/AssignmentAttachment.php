<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentAttachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "path",
        "assignment_id"
    ];

    public function assignment(): BelongsTo {
        return $this->belongsTo(Assignment::class);
    }
}
