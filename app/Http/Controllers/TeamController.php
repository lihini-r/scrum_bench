<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Team;
use App\User;
use Session;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TeamController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$team = Team::all();

		//$project=Project::where('Hide','off')->get();

		return view('teams.index', array('teams' => $team));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('teams.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [

			'TeamName' => 'required',
			'Developers' => 'required'

		]);

		$input = $request->all();

		Team::create($input);


		Session::flash('flash_message', 'Team successfully created!');

		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($team_id)
	{
		$team = Team::find($team_id);
		return view('teams.show', array('team' => $team));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($team_id)
	{

		$team = Team::find($team_id);

		return view('teams.edit', array('team' => $team));

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
	}*/

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $team_id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function update($team_id, Request $request)
	{
		$team = Team::find($team_id);

		$this->validate($request, [
			'TeamName' => 'required',
			'Developers' => 'required',
			'assigned_state'=>'required'
		]);

		$input = $request->all();


		$team->fill($input)->save();

		Session::flash('flash_message', 'Team successfully Updated!');

		return redirect()->back();
	}

}
