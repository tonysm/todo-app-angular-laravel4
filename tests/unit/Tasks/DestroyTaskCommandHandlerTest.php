<?php

namespace unit;

use App\Tasks\DestroyTaskCommand;
use App\Tasks\DestroyTaskCommandHandler;
use Mockery;

class DestroyTaskCommandHandlerTest extends \PHPUnit_Framework_TestCase {

    private $todosRepo;

    private $handler;

    public function setUp()
    {
        $this->todosRepo = Mockery::mock('App\Tasks\TasksRepository');
        $this->handler = new DestroyTaskCommandHandler($this->todosRepo);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    function it_should_delete_task()
    {
        $mockTodo = Mockery::mock('App\Task')->makePartial();

        $this->todosRepo->shouldReceive("delete")
            ->once()
            ->andReturn($mockTodo);

        $command = new DestroyTaskCommand(1);

        $this->assertEquals($mockTodo, $this->handler->handle($command));
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     * @test */
    function it_should_throw_model_not_found()
    {
        $this->todosRepo->shouldReceive("delete")
            ->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException());

        $command = new DestroyTaskCommand(1);

        $this->handler->handle($command);
    }
}