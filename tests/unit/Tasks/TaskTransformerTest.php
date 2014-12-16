<?php

namespace unit;

use App\Task;
use App\Tasks\TaskTransformer;
use Carbon\Carbon;

class TaskTransformerTest extends \TestCase
{
    /** @test */
    function it_transforms_todos_correctly()
    {
        $todo = Task::create(["name" => "lorem"]);

        $expectedNow = Carbon::now()->format("Y-m-d");
        $expected = [
            "id" => 1,
            "name" => "lorem",
            "created_at" => $expectedNow,
            "updated_at" => $expectedNow,
            "links" => [
                "rel" => "self",
                "uri" => "/api/v1/tasks/1"
            ]
        ];

        $this->assertEquals($expected, (new TaskTransformer())->transform($todo));
    }
} 