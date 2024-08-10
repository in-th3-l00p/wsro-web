<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestProject extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "visibility",
        "owner_id"
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function attachments(): HasMany {
        return $this->hasMany(TestProjectAttachment::class);
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(
            TestProjectTag::class,
            "test_project_test_project_tag",
            "test_project_id",
            "test_project_tag_id"
        );
    }
}
