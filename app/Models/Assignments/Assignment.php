<?php

namespace App\Models\Assignments;

use App\Models\TestProjects\TestProject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "description",
        "deadline",
        "owner_id"
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(
            User::class,
            "assignment_user",
            "assignment_id",
            "user_id"
        );
    }

    public function testProjects(): BelongsToMany {
        return $this->belongsToMany(
            TestProject::class,
            "assignment_test_project"
        );
    }

    public function attachments(): HasMany {
        return $this->hasMany(AssignmentAttachment::class);
    }

    public function submissions() {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
