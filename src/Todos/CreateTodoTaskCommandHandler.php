<?php namespace App\Todos;

use App\Todo as Task;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateTodoTaskCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var TodosRepository
     */
    private $todosRepository;

    /**
     * @param TodosRepository $todosRepository
     */
    function __construct(TodosRepository $todosRepository)
    {
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

        $todo = $this->todosRepository->create(compact("name"));

        $this->dispatchEventsFor($todo);

        return $todo;
    }

}