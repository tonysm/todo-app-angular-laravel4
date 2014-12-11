<?php

namespace unit;

use App\Todo;
use App\Todos\TodoTransformer;
use Carbon\Carbon;

class TodoTransformerTest extends \TestCase
{
    /** @test */
    function it_transforms_todos_correctly()
    {
        $todo = Todo::create(["name" => "lorem"]);

        $expectedNow = Carbon::now()->format("Y-m-d");
        $expected = [
            "id" => 1,
            "name" => "lorem",
            "created_at" => $expectedNow,
            "updated_at" => $expectedNow,
            "links" => [
                "rel" => "self",
                "uri" => "/api/v1/todos/1"
            ]
        ];

        $this->assertEquals($expected, (new TodoTransformer())->transform($todo));
    }
} 