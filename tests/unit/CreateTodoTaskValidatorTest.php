<?php

namespace unit;

use App\Todos\CreateTodoTaskCommand;
use App\Todos\CreateTodoTaskValidator;
use Mockery;

class CreateTodoTaskValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;
    private $validatorHandler;

    public function setUp()
    {
        $this->validator = Mockery::mock('Illuminate\Validation\Factory');
        $this->validatorHandler = new CreateTodoTaskValidator($this->validator);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    function it_works_when_validation_passes()
    {
        $command = new CreateTodoTaskCommand("lorem ipsum");

        $validation = Mockery::mock('Illuminate\Validation\Validator');

        $validation->shouldReceive('fails')
            ->once()
            ->andReturn(false);

        $this->validator->shouldReceive("make")
            ->once()
            ->andReturn($validation);

        $this->validatorHandler->validate($command);
    }

    /**
     * @expectedException \App\Exceptions\ValidationFailedException
     * @test
     */
    function it_should_throw_validation_failed_exception_when_validation_fails()
    {
        $command = new CreateTodoTaskCommand("lorem ipsum");

        $validation = Mockery::mock('Illuminate\Validation\Validator');

        $validation->shouldReceive('fails')
            ->once()
            ->andReturn(true);

        $this->validator->shouldReceive("make")
            ->once()
            ->andReturn($validation);

        $this->validatorHandler->validate($command);
    }
} 