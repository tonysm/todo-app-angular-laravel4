<?php

namespace App\Tasks;

use App\Task;
use App\Tasks\Events\TaskDeleted;
use App\Tasks\Events\TaskCreated;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TasksRepository
{
    /**
     * @param $taskId
     * @throws ModelNotFoundException
     * @return Task
     */
    public function find($taskId)
    {
        return Task::findOrFail($taskId);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Task::orderBy('created_at', 'DESC')
            ->rememberForever("tasks_task_cache")
            ->get();
    }

    /**
     * @param  int                    $taskId
     * @throws ModelNotFoundException
     * @return Task
     */
    public function delete($taskId)
    {
        $task = $this->find($taskId);

        $task->delete();

        $task->raise(new TaskDeleted($task->id));

        return $task;
    }

    /**
     * @param  array $data
     * @return Task
     */
    public function create(array $data)
    {
        $task = Task::create($data);

        $task->raise(new TaskCreated($task->id));

        return $task;
    }
}
