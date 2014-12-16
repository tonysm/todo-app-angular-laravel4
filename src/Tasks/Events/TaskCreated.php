<?php

namespace App\Tasks\Events;

class TaskCreated
{
    /**
     * @var string
     */
    public $taskId;

    /**
     * @param string $taskId
     */
    public function __construct($taskId)
    {
        $this->taskId = $taskId;
    }
}
