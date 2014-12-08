<?php

namespace App\Todos;

use App\Todo as Task;
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
        return Task::all();
    }
} 