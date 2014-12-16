<?php

namespace App\Tasks;

use App\Task;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    /**
     * @param  Task  $task
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'id' => (int) $task->id,
            'name' => $task->name,
            'created_at' => $task->created_at->format('Y-m-d'),
            'updated_at' => $task->updated_at->format('Y-m-d'),
            'links' => [
                'rel' => 'self',
                'uri' => '/api/v1/tasks/'.$task->id,
            ]
        ];
    }
}
