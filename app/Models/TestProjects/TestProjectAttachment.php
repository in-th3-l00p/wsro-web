<?php

namespace App\Models\TestProjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestProjectAttachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "path",
        "test_project_id"
    ];

    public function testProject(): BelongsTo {
        return $this->belongsTo(TestProject::class);
    }
}
