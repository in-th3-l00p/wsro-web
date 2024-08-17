<?php

namespace Database\Factories\Assignments;

use App\Models\Assignments\AssignmentSubmissionAttachment;
use App\Models\Assignments\AssignmentSubmissionLink;
use App\Models\Assignments\AssignmentSubmissionText;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignments\AssignmentSubmissionResource>
 */
class AssignmentSubmissionResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = rand(0, 2);
        $resource = null;
        switch ($type) {
            case 0:
                $resource = AssignmentSubmissionLink::factory()->create();
                break;
            case 1:
                $resource = AssignmentSubmissionText::factory()->create();
                break;
            case 2:
                $resource = AssignmentSubmissionAttachment::factory()->create();
                break;
        }

        return [
            "assignment_submission_resource_id" => $resource->id,
            "assignment_submission_resource_type" => $resource::class
        ];
    }

    public function text() {
        $resource = AssignmentSubmissionText::factory()->create();
        return $this->state(fn (array $attributes) => [
            "assignment_submission_resource_id" => $resource->id,
            "assignment_submission_resource_type" => $resource::class
        ]);
    }

    public function link() {
        $resource = AssignmentSubmissionLink::factory()->create();
        return $this->state(fn (array $attributes) => [
            "assignment_submission_resource_id" => $resource->id,
            "assignment_submission_resource_type" => $resource::class
        ]);
    }

    public function attachment() {
        $resource = AssignmentSubmissionAttachment::factory()->create();
        return $this->state(fn (array $attributes) => [
            "assignment_submission_resource_id" => $resource->id,
            "assignment_submission_resource_type" => $resource::class
        ]);
    }
}
