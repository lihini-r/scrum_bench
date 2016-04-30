<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Session;
use App\Todolist;

use Illuminate\Support\Facades\DB as DB;


class TodolistController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	//function to view user tasks added to to-do list
	public function index()

	{
		$user = \Auth::user()->name;

		$tasks = Todolist::where('userName',$user)->orderBy('created_at', 'desc')->get();
		return view('todolists.index', array('tasks' => $tasks));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('todolists.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	//function to store tasks
	public function store(Request $request)
	{
		//validate fields
		$this->validate($request, [

			'task' => 'required',
			'userName'=> 'required'

		]);

		$input = $request->all();
		//$users = DB::table('users')->lists('name');
		Todolist::create($input);
		Session::flash('flash_message', 'Task added successfully sent!');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	//delete user tasks from to-do list
	public function destroy($taskid)
	{
		$tasks=Todolist::findOrFail($taskid);
		$tasks->delete();
		DB::table('todolists')->where('task_id','=', $taskid)->delete();


		return redirect()->route('todolists.index');


	}

}
