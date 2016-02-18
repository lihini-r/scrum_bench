<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sprint;
use Session;
use Illuminate\Http\Request;

class SprintController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sprints = Sprint::all();
		return view('sprints.index', array('sprints' => $sprints));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()

	{


		return view('sprints.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	/*public function store()
	{
		//
	}*/
	
	public function store(Request $request)
	{
		$this->validate($request, [
			'sprint_name' => 'required',
			'project_id' => 'required',
			'start_date' => 'required|date|date_format:Y-m-d',
			'end_date' => 'required|date|date_format:Y-m-d|after:start_date'
		]);
		
		$input = $request->all();

		Sprint::create($input);
		
		Session::flash('flash_message', 'Sprint successfully created!');

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
		$sprint = Sprint::find($id);
		return view('sprints.show', array('sprint' => $sprint));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$sprint = Sprint::find($id);

		return view('sprints.edit', array('sprint' => $sprint));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update($id)
	{
		//
	}
    */
	public function update($id, Request $request)
	{
		$sprint = Sprint::find($id);

		$this->validate($request, [
			'sprint_name' => 'required',
			'project_id' => 'required',
			'start_date' => 'required|date|date_format:Y-m-d',
			'end_date' => 'required|date|date_format:Y-m-d|after:start_date'
		]);

		$input = $request->all();

		$sprint->fill($input)->save();

		Session::flash('flash_message', 'Sprint successfully Updated!');

		return redirect()->back();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	}

}
