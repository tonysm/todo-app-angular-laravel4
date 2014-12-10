<?php

namespace App\Todos;

use App\Todo as Task;
use League\Fractal\TransformerAbstract;

class TodoTransformer extends TransformerAbstract
{
    /**
     * @param Task $todo
     * @return array
     */
    public function transform(Task $todo)
    {
        return [
            'id' => (int) $todo->id,
            'name' => $todo->name,
            'created_at' => $todo->created_at->format('Y-m-d'),
            'updated_at' => $todo->updated_at->format('Y-m-d'),
            'links' => [
                'rel' => 'self',
                'uri' => '/api/v1/todos/' . $todo->id
            ]
        ];
    }
} 