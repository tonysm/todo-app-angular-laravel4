<?php

use App\Todo;

class TodosController extends \BaseController {

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
		$name = Input::json("name");

        $validator = Validator::make(compact("name"), Todo::$rules);

        if ($validator->fails())
        {
            return Response::make(["errors" => $validator->messages()], 400);
        }

        $todo = Todo::create(compact("name"));

        return Response::make($todo, 201);
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
