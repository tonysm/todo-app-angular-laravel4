<?php

namespace App\Todos;

use App\Todo as Task;
use App\Todos\Events\TodoTaskDeleted;
use App\Todos\Events\TodoTaskCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodosRepository
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
        return Task::orderBy('created_at', 'DESC')->rememberForever("todos_task_cache")->get();
    }

    /**
     * @param int $id
     * @throws ModelNotFoundException
     * @return Task
     */
    public function delete($id)
    {
        $todo = $this->find($id);

        $todo->delete();

        $todo->raise(new TodoTaskDeleted($todo->id));

        return $todo;
    }

    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data)
    {
        $todo = Task::create($data);

        $todo->raise(new TodoTaskCreated($todo->id));

        return $todo;
    }
} 