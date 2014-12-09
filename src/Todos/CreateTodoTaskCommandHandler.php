<?php namespace App\Todos;

use App\Todo as Task;
use App\Exceptions\ValidationFailedException;
use Illuminate\Validation\Factory;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateTodoTaskCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var Factory
     */
    private $validator;

    /**
     * @var TodosRepository
     */
    private $todosRepository;

    /**
     * @param Factory $validator
     * @param TodosRepository $todosRepository
     */
    function __construct(Factory $validator, TodosRepository $todosRepository)
    {
        $this->validator = $validator;
        $this->todosRepository = $todosRepository;
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

        $todo = $this->todosRepository->create(compact("name"));

        $this->dispatchEventsFor($todo);

        return $todo;
    }

}