<?php

use App\Todo;
use Laracasts\Commander\CommanderTrait;

class TodosController extends \BaseController {

    use CommanderTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Todo::latest()->get();
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
		$todo = Todo::find($id);

        $todo->delete();

        return Response::make($todo, 200);
	}


}
