<?php

namespace App\Tasks;

use App\Task;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class DestroyTaskCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var TasksRepository
     */
    private $todosRepository;

    /**
     * @param TasksRepository $todosRepository
     */
    public function __construct(TasksRepository $todosRepository)
    {
        $this->todosRepository = $todosRepository;
    }

    /**
     * Handle the command.
     *
     * @param  DestroyTaskCommand $command
     * @return Task
     */
    public function handle($command)
    {
        $task = $this->todosRepository->delete($command->taskId);

        $this->dispatchEventsFor($task);

        return $task;
    }
}
