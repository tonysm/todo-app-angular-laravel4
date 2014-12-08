<?php namespace App\Todos;

class CreateTodoTaskCommand {
    /**
     * @var string
     */
    public $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

}