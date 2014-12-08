<?php namespace App\Todos;

use App\Todo as Task;
use App\Exceptions\ValidationFailedException;
use Illuminate\Validation\Factory;
use Laracasts\Commander\CommandHandler;

class CreateTodoTaskCommandHandler implements CommandHandler
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
     * Handle the command.
     *
     * @param CreateTodoTaskCommand $command
     * @throws ValidationFailedException
     * @return Task
     */
    public function handle($command)
    {
        $name = $command->name;

        $validator = $this->validator->make(compact("name"), Task::$rules);

        if ($validator->fails())
        {
            throw new ValidationFailedException($validator);
        }

        return Task::create(compact("name"));
    }

}