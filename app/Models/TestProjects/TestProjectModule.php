<?php

namespace App\Models\TestProjects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestProjectModule extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "test_project_id"
    ];

    public function testProject()
    {
        return $this->belongsTo(TestProject::class);
    }

    public function attachments()
    {
        return $this->belongsToMany(
            TestProjectAttachment::class,
            "test_project_module_attachment",
            "test_project_module_id",
            "test_project_attachment_id"
        );
    }
}
