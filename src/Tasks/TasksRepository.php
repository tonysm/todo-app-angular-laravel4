<?php

namespace App\Tasks;

use App\Task;
use App\Tasks\Events\TaskDeleted;
use App\Tasks\Events\TaskCreated;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TasksRepository
{
    /**
     * @param $id
     * @throws ModelNotFoundException
     * @return Task
     */
    public function find($id)
    {
        return Task::findOrFail($id);
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
     * @param  int                    $id
     * @throws ModelNotFoundException
     * @return Task
     */
    public function delete($id)
    {
        $todo = $this->find($id);

        $todo->delete();

        $todo->raise(new TaskDeleted($todo->id));

        return $todo;
    }

    /**
     * @param  array $data
     * @return Task
     */
    public function create(array $data)
    {
        $todo = Task::create($data);

        $todo->raise(new TaskCreated($todo->id));

        return $todo;
    }
}
