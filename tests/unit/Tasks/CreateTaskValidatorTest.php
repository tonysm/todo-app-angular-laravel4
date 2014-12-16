<?php

namespace unit;

use App\Tasks\CreateTaskCommand;
use App\Tasks\CreateTaskValidator;
use Mockery;

class CreateTaskValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    /**
     * @var CreateTaskValidator
     */
    private $validatorHandler;

    function setUp()
    {
        $this->validator = Mockery::mock('Illuminate\Validation\Factory');
        $this->validatorHandler = new CreateTaskValidator($this->validator);
    }

    function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    function it_works_when_validation_passes()
    {
        $command = new CreateTaskCommand("lorem ipsum");

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
        $command = new CreateTaskCommand("lorem ipsum");

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