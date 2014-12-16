<?php

use App\Task;
use Laracasts\TestDummy\Factory;

class TasksTest extends TestCase {

    /**
     * @param $count
     * @return array
     */
    private function createTasks($count)
    {
        return Factory::times($count)->create("App\\Task");
    }

    /**
     * @return array
     */
    function invalidTasks()
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
        $response = $this->callJSON("POST", "api/v1/tasks", ["name" => "lorem ipsum"]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertCount(1, Task::all());
    }

    /**
     * @dataProvider invalidTasks
     * @test
     */
    function it_should_not_allow_creating_a_todo_task_without_name($data)
    {
        $response = $this->callJSON("POST", "api/v1/tasks", $data);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertCount(0, Task::all());
    }

    /** @test */
    function it_should_list_todos()
    {
        $this->createTasks(3);

        $response = $this->callJSON("GET", "api/v1/tasks");
        $data = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(3, $data->data);
    }

    /** @test */
    function it_should_delete_a_todo_task()
    {
        $tasks = $this->createTasks(1);

        $response = $this->callJSON("DELETE", "api/v1/tasks/" . $tasks->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(0, Task::all());
    }

    /** @test */
    function it_returns_error_when_trying_to_delete_tasks_that_does_not_exist()
    {
        $response = $this->callJSON("DELETE", "api/v1/tasks/123");

        $this->assertEquals(400, $response->getStatusCode());
    }
}