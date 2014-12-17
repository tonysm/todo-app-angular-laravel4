<?php

namespace App\Tasks;

class DestroyTaskCommand
{
    /**
     * @var int
     */
    public $taskId;

    /**
     * @param int $taskId
     */
    public function __construct($taskId)
    {
        $this->taskId = $taskId;
    }
}
