<?php

namespace App\Models\Assignments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "path",
        "attachment_id"
    ];

    public function assignment(): BelongsTo {
        return $this->belongsTo(Assignment::class);
    }
}
