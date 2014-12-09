<?php

namespace App\Todos;

use App\Todo as Task;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class DestroyTodoCommandHandler implements CommandHandler
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
     * @param DestroyTodoCommand $command
     * @return Task
     */
    public function handle($command)
    {
        $todo = $this->todosRepository->find($command->id);

        $todo->delete();

        $this->dispatchEventsFor($todo);

        return $todo;
    }
}