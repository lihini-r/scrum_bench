<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Team;
use App\AssignProjects;
use App\User;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Auth\Guard;



use Illuminate\Http\Request;

class HideController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//PROJECT MANAGER DASHBOARD(hide/index.blade.php)

		if(\Auth::check() && \Auth::user()->designation === 'Project Manager') {

			$user = \Auth::user()->name;

			$prjman = AssignProjects::where('ProjectManager', $user)->get();

			foreach ($prjman as $pj) {

					$pjt_id = $pj->ProjectName;

				$projects = Project::where('ProjectID', $pjt_id)->get();

				$projectids = DB::table('assign_teams')->where('ProjectID', $pjt_id)->get();

			}




		}

		return view('hide.index', array('projects' => $projects,'prjman' => $prjman,'projectids' =>$projectids));

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
	public function show($team_id)
	{ //show assigned team details on pm dashboard

		$team = Team::find($team_id);
		return view('hide.show', array('team' => $team));
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


	//To Hide projects from View(projects/index)
	public function update($ProjectID,Request $request)
	{
		$project = Project::find($ProjectID);

		$this->validate($request, [
			'ProjectName' => 'required',
			'Description' => 'required',
			'State'=>'required',
			'Hide'=>'required'
		]);

		$input = $request->all();

		$project->fill($input)->save();

		Session::flash('flash_message', 'Project successfully Hidden!!!!!!!');

		return redirect()->back();
	}

}
