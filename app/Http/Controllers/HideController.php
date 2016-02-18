<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Team;
use Session;


use Illuminate\Http\Request;

class HideController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function edit($ProjectID)
	{
		$project = Project::find($ProjectID);




		return view('hide.edit', array('project' => $project));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function update($id)
	{
	}
*/
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function update($ProjectID,Request $request)
	{
		$project = Project::find($ProjectID);

		$this->validate($request, [
			'ProjectName' => 'required',
			'Description' => 'required',
			'State'=>'required',
			'add_date' => 'required|date|date_format:Y-m-d',
			'due_date' => 'required|date|date_format:Y-m-d|after:add_date',
			'Hide'=>'required'
		]);

		$input = $request->all();

		$project->fill($input)->save();

		Session::flash('flash_message', 'Project successfully Hidden!!!!!!!');

		return redirect()->back();
	}

}
