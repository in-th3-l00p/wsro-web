<?php

namespace App\Http\Requests;

use App\Models\TestProjects\TestProject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class TestProjectRequest extends FormRequest
{
    public function authorize(): bool {
        return Gate::check("create", TestProject::class);
    }

    public function rules(): array
    {
        return [
            "title" => "required|max:255|unique:test_projects,title",
            "description" => "required",
            "visibility" => "required|in:public,private,draft"
        ];
    }
}
