<?php

use App\Exceptions\ValidationFailedException;
use App\Tasks\TaskTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laracasts\Commander\CommanderTrait;
use App\Tasks\TasksRepository;

class TasksController extends \BaseController
{
    use CommanderTrait;

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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $tasks = $this->tasksRepository->all();

        return $this->respondsWithCollection($tasks, new TaskTransformer(), 200);
    }

    /**
     * @return mixed
     */
    public function store()
    {
        try {
            $data = [
                "name" => Input::json("name"),
            ];

            $task = $this->execute('App\Tasks\CreateTaskCommand', $data);

            return $this->respondsWithItem($task, new TaskTransformer(), 201);
        } catch (ValidationFailedException $e) {
            return $this->responds(["errors" => $e->getValidator()->messages()], 400);
        }
    }

    /**
     * @param $taskId
     * @return mixed
     */
    public function destroy($taskId)
    {
        try {
            $task = $this->execute('App\Tasks\DestroyTaskCommand', ["taskId" => $taskId]);

            return $this->respondsWithItem($task, new TaskTransformer());
        } catch (ModelNotFoundException $e) {
            return $this->responds(["errors" => [$e->getMessage()]], 400);
        }
    }
}
