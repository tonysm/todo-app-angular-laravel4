<?php

use App\Todo;

class TodosTest extends TestCase {

    /**
     * @param $count
     * @return array
     */
    private function createTodos($count)
    {
        return Laracasts\TestDummy\Factory::times($count)->create("App\\Todo");
    }

    function invalidTodos()
    {
        return [
            [["name" => ""]],
            [[]],
            [["name" => '12']]
        ];
    }

    /** @test */
    function it_should_create_todos()
    {
        $response = $this->callJSON("POST", "api/v1/todos", ["name" => "lorem ipsum"]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertCount(1, Todo::all());
    }

    /**
     * @dataProvider invalidTodos
     * @test
     */
    function it_should_not_allow_creating_a_todo_task_without_name($data)
    {
        $response = $this->callJSON("POST", "api/v1/todos", $data);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertCount(0, Todo::all());
    }

    /** @test */
    function it_should_list_todos()
    {
        $this->createTodos(3);

        $response = $this->callJSON("GET", "api/v1/todos");
        $data = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(3, $data);
    }

    /** @test */
    function it_should_delete_a_todo_task()
    {
        $todos = $this->createTodos(1);

        $response = $this->callJSON("DELETE", "api/v1/todos/" . $todos->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(0, Todo::all());
    }

    /** @test */
    function it_returns_error_when_trying_to_delete_tasks_that_does_not_exist()
    {
        $response = $this->callJSON("DELETE", "api/v1/todos/123");

        $this->assertEquals(400, $response->getStatusCode());
    }
}