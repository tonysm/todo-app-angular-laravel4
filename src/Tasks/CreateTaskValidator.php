<?php

namespace App\Tasks;

use App\Exceptions\ValidationFailedException;
use Illuminate\Validation\Factory;
use App\Task;

class CreateTaskValidator
{
    /**
     * @var Factory
     */
    private $validator;

    /**
     * @param Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param  CreateTaskCommand         $command
     * @throws ValidationFailedException
     */
    public function validate($command)
    {
        $data = ["name" => $command->name];

        $validator = $this->validator->make($data, Task::$rules);

        if ($validator->fails()) {
            throw new ValidationFailedException($validator);
        }
    }
}
