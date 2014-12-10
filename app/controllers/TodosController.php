<?php

use App\Exceptions\ValidationFailedException;
use App\Todos\TodoTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laracasts\Commander\CommanderTrait;
use App\Todos\TodosRepository;

class TodosController extends \BaseController
{
    use CommanderTrait;

    /**
    * @var App\Todos\TodosRepository
    */
    private $todosRepository;

    /**
    * @param TodosRepository $todosRepository
    */
    function __construct(TodosRepository $todosRepository)
    {
        $this->todosRepository = $todosRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $todos = $this->todosRepository->all();

        return $this->respondsWithCollection($todos, new TodoTransformer(), 200);
    }


    /**
     * @return mixed
     */
    public function store()
    {
        try
        {
            $data = [
                "name" => Input::json("name")
            ];

            $todo = $this->execute('App\Todos\CreateTodoTaskCommand', $data);

            return $this->respondsWithItem($todo, new TodoTransformer(), 201);
        }
        catch (ValidationFailedException $e)
        {
            return $this->responds(["errors" => $e->getValidator()->messages()], 400);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try
        {
            $todo = $todo = $this->execute('App\Todos\DestroyTodoCommand', ["id" => $id]);

            return $this->respondsWithItem($todo, new TodoTransformer());
        }
        catch (ModelNotFoundException $e)
        {
            return $this->responds(["errors" => [$e->getMessage()]], 400);
        }
    }
}
