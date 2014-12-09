<?php

namespace unit;

use App\Todos\CreateTodoTaskCommand;
use App\Todos\CreateTodoTaskCommandHandler;
use Mockery;

class CreateTodoTaskCommandHandlerTest  extends \TestCase {

    private $handler;

    private $validator;

    public function setUp()
    {
        parent::setUp();

        $this->validator = Mockery::mock('Illuminate\Validation\Factory');
        $this->handler = new CreateTodoTaskCommandHandler($this->validator);
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


        $command = new CreateTodoTaskCommand("lorem ipsum");

        $todo = $this->handler->handle($command);

        $this->assertEquals($todo->name, "lorem ipsum");
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