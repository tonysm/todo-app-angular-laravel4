<?php

namespace App\Todos\Events;

class TodoTaskDeleted {

    /**
     * @var string
     */
    public $todoId;

    /**
     * @param string $todoId
     */
    function __construct($todoId)
    {
        $this->todoId = $todoId;
    }

} 