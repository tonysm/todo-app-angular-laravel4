<?php

namespace unit;

use App\Todos\CreateTodoTaskCommand;
use App\Todos\CreateTodoTaskCommandHandler;
use Mockery;

class CreateTodoTaskCommandHandlerTest  extends \TestCase {

    private $handler;

    private $validator;

    private $todosRepo;

    public function setUp()
    {
        parent::setUp();

        $this->validator = Mockery::mock('Illuminate\Validation\Factory');
        $this->todosRepo = Mockery::mock('App\Todos\TodosRepository');
        $this->handler = new CreateTodoTaskCommandHandler($this->validator, $this->todosRepo);
    }

    /** @test */
    function it_should_create_task()
    {
        $validation = Mockery::mock('\Illuminate\Validation\Validator');
        $validation->shouldReceive("fails")
            ->once()
            ->andReturn(false);
        $this->validator->shouldReceive("make")
            ->once()
            ->andReturn($validation);

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

    /**
     * @expectedException \App\Exceptions\ValidationFailedException
     * @test
     */
    function it_should_fail_when_validation_fails()
    {
        $validation = Mockery::mock('\Illuminate\Validation\Validator');
        $validation->shouldReceive("fails")
            ->andReturn(true);

        $this->validator->shouldReceive("make")
            ->once()
            ->andReturn($validation);

        $command = new CreateTodoTaskCommand("lol");

        $this->handler->handle($command);
    }
} 