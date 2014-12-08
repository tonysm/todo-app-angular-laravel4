<?php

namespace App\Todos;

use App\Todo as Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laracasts\Commander\CommandHandler;

class DestroyTodoCommandHandler implements CommandHandler
{
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

        return $todo;
    }
}