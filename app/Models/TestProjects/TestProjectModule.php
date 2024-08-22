<?php

namespace App\Models\TestProjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestProjectModule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "description",
        "test_project_id"
    ];

    public function testProject(): BelongsTo
    {
        return $this->belongsTo(TestProject::class);
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(
            TestProjectAttachment::class,
            "test_project_module_attachment",
            "test_project_module_id",
            "test_project_attachment_id"
        );
    }
}
