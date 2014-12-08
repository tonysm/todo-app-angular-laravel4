<?php

namespace App\Todos;

class DestroyTodoCommand
{
    /**
     * @var int
     */
    public $id;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

}