<?php

use App\Todo;
use Laracasts\Commander\CommanderTrait;
use App\Todos\TodosRepository;

class TodosController extends \BaseController {

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
     * Display a listing of the resource.
     *
     * @return mixed
     */
	public function index()
	{
		return $this->todosRepository->all();
	}


	/**
     * Store a newly created resource in storage.
	 *
	 * @return Response
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
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
