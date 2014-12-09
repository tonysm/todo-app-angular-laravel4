<?php

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
        return $this->todosRepository->all();
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

            return Response::make($todo, 201);
        }
        catch (\App\Exceptions\ValidationFailedException $e)
        {
            return Response::make(["errors" => $e->getValidator()->messages()], 400);
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

            return Response::make($todo, 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return Response::make(["errors" => [$e->getMessage()]], 400);
        }
    }
}
