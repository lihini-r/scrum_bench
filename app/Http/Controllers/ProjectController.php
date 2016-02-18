<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Team;
use Session;


use Illuminate\Http\Request;

class ProjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	//	$project = Project::all();

		$project=Project::where('Hide','off')->get();

		return view('projects.index', array('projects' => $project));
	}





	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'ProjectName' => 'required',
			'Description' => 'required',
			'State' => 'required',
			'add_date' => 'required|date|date_format:Y-m-d|',
			'due_date' => 'required|date|date_format:Y-m-d|after:add_date'
		]);

		$input = $request->all();

		Project::create($input);


		Session::flash('flash_message', 'Project successfully Added!!!');

		return redirect()->back();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $ProjectID
	 * @return Response
	 */
	public function show($ProjectID)
	{

		$project = Project::find($ProjectID);
		return view('projects.show', array('project' => $project));



	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $ProjectID
	 * @return Response
	 */
	public function edit($ProjectID)
	{
		$project = Project::find($ProjectID);




		return view('projects.edit', array('project' => $project));

	}




	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	/*public function update($id)
	{
		//
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


	public function update($ProjectID, Request $request)
	{
		$project = Project::find($ProjectID);

		$this->validate($request, [
			'ProjectName' => 'required',
			'Description' => 'required',
			'State'=>'required',
			'add_date' => 'required|date|date_format:Y-m-d',
			'due_date' => 'required|date|date_format:Y-m-d|after:add_date'
		]);

		$input = $request->all();

		$project->fill($input)->save();

		Session::flash('flash_message', 'Project successfully Updated!');

		return redirect()->back();
	}

	/*

	public function updatehide($ProjectID, Request $request)
	{
		$project = Project::find($ProjectID);

		$this->validate($request, [
			'ProjectName' => 'required',
			'Description' => 'required',
			'State'=>'required',
			'Hide'=>'required',
			'add_date' => 'required|date|date_format:Y-m-d',
			'due_date' => 'required|date|date_format:Y-m-d|after:add_date'
		]);

		$input = $request->all();

		$project->fill($input)->save();

		Session::flash('flash_message', 'Project successfully Hiden!!!!!!!');

		return redirect()->back();
	}

*/




}
