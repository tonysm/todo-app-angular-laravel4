<?php

namespace unit;

use App\Todos\DestroyTodoCommand;
use App\Todos\DestroyTodoCommandHandler;
use Mockery;

class DestroyTodoCommandHandlerTest extends \PHPUnit_Framework_TestCase {

    private $todosRepo;

    private $handler;

    public function setUp()
    {
        $this->todosRepo = Mockery::mock('App\Todos\TodosRepository');
        $this->handler = new DestroyTodoCommandHandler($this->todosRepo);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    function it_should_delete_task()
    {
        $mockTodo = Mockery::mock('App\Todo[delete]');

        $this->todosRepo->shouldReceive("find")
            ->once()
            ->andReturn($mockTodo);

        $mockTodo->shouldReceive("delete")
            ->once();

        $command = new DestroyTodoCommand(1);

        $this->assertEquals($mockTodo, $this->handler->handle($command));
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     * @test */
    function it_should_throw_model_not_found()
    {
        $this->todosRepo->shouldReceive("find")
            ->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException());

        $command = new DestroyTodoCommand(1);

        $this->handler->handle($command);
    }
}