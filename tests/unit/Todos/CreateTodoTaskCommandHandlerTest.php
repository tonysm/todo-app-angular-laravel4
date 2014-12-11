<?php

namespace unit;

use App\Todos\CreateTodoTaskCommand;
use App\Todos\CreateTodoTaskCommandHandler;
use Mockery;

class CreateTodoTaskCommandHandlerTest  extends \TestCase {

    private $handler;

    private $todosRepo;

    public function setUp()
    {
        parent::setUp();

        $this->todosRepo = Mockery::mock('App\Todos\TodosRepository');
        $this->handler = new CreateTodoTaskCommandHandler($this->todosRepo);
    }

    /** @test */
    function it_should_create_task()
    {
        $name = "lorem ipsum";
        $taskMock = new \App\Todo;
        $taskMock->name = $name;

        $this->todosRepo->shouldReceive("create")
            ->with(["name" => $name])
            ->once()
            ->andReturn($taskMock);

        $command = new CreateTodoTaskCommand($name);

        $todo = $this->handler->handle($command);

        $this->assertEquals($todo->name, $name);
    }
} 