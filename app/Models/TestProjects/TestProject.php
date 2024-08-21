<?php

namespace App\Models\TestProjects;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "visibility",
        "owner_id"
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TestProjectAttachment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            TestProjectTag::class,
            "test_project_test_project_tag",
            "test_project_id",
            "test_project_tag_id"
        );
    }

    public function modules()
    {
        return $this->hasMany(TestProjectModule::class);
    }
}
