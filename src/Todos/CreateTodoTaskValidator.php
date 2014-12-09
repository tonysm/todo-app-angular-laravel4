<?php

namespace App\Todos;

use App\Exceptions\ValidationFailedException;
use Illuminate\Validation\Factory;
use App\Todo as Task;

class CreateTodoTaskValidator
{
    /**
     * @var Factory
     */
    private $validator;

    /**
     * @param Factory $validator
     */
    function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param CreateTodoTaskCommand $command
     * @throws ValidationFailedException
     */
    public function validate($command)
    {
        $data = ["name" => $command->name];

        $validator = $this->validator->make($data, Task::$rules);

        if ($validator->fails())
        {
            throw new ValidationFailedException($validator);
        }
    }
} 