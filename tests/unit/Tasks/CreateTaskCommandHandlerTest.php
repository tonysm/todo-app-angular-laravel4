<?php

namespace unit;

use App\Task;
use App\Tasks\CreateTaskCommand;
use App\Tasks\CreateTaskCommandHandler;
use Mockery;

class CreateTaskCommandHandlerTest  extends \TestCase {

    private $handler;

    private $tasksRepo;

    public function setUp()
    {
        parent::setUp();

        $this->tasksRepo = Mockery::mock('App\Tasks\TasksRepository');
        $this->handler = new CreateTaskCommandHandler($this->tasksRepo);
    }

    /** @test */
    function it_should_create_task()
    {
        $name = "lorem ipsum";
        $taskMock = new Task;
        $taskMock->name = $name;

        $this->tasksRepo->shouldReceive("create")
            ->with(["name" => $name])
            ->once()
            ->andReturn($taskMock);

        $command = new CreateTaskCommand($name);

        $todo = $this->handler->handle($command);

        $this->assertEquals($todo->name, $name);
    }
} 