<?php

namespace App\Tasks;

class DestroyTaskCommand
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
