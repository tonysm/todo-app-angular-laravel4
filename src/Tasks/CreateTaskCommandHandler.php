<?php namespace App\Tasks;

use App\Exceptions\ValidationFailedException;
use App\Task;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateTaskCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var TasksRepository
     */
    private $tasksRepository;

    /**
     * @param TasksRepository $tasksRepository
     */
    public function __construct(TasksRepository $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    /**
     * Handle the command.
     *
     * @param  CreateTaskCommand         $command
     * @throws ValidationFailedException
     * @return Task
     */
    public function handle($command)
    {
        $name = $command->name;

        $todo = $this->tasksRepository->create(compact("name"));

        $this->dispatchEventsFor($todo);

        return $todo;
    }
}
