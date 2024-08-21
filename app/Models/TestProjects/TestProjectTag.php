<?php

namespace App\Models\TestProjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TestProjectTag extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "test_project_id"
    ];

    public function testProjects(): BelongsToMany {
        return $this->belongsToMany(
            TestProject::class,
            "test_project_test_project_tag",
            "test_project_tag_id",
            "test_project_id"
        );
    }
}
