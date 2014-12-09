<?php

namespace App\Todos\Events;


class TodoTaskCreated
{
    /**
     * @var string
     */
    public $todoId;

    /**
     * @param string $todoId
     */
    public function __construct($todoId)
    {
        $this->todoId = $todoId;
    }
} 