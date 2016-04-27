<?php namespace App\Http\Controllers;

use App\AssignProjects;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use Illuminate\Http\Request;

use App\Team;
use App\User;


use App\Account;
use Session;

use Illuminate\Support\Facades\DB as DB;

class AssignTeamsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	//TO VIEW WITH HIDDEN PROJECTS ON PROJECTS INDEX(projects/index.blade)
	public function index()
	{

		if(\Auth::check() && \Auth::user()->designation === 'Account Head') {

			$user = \Auth::user()->name;

			$account = Account::where('acc_head',  $user)->get();

			foreach($account as $acc){

				$aname=$acc->acc_name;

				$project = Project::where('acc_name', $aname)->get();

			}
		}

		return view('assign_teams.index', array('projects' => $project,'account' => $account));


	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	//get logged  in  project managers' project details
	//get all team details
    //to assign teams for project

		if(\Auth::check() && \Auth::user()->designation === 'Project Manager') {

			$user = \Auth::user()->name;

			$prjman = AssignProjects::where('ProjectManager',$user)->get();

			foreach($prjman as $pj) {

				$pjt_id = $pj->ProjectName;


				$projects = Project::where('ProjectID', $pjt_id)->get();

			}

			$teams =Team::all();
		}




		return view('assign_teams.create', array('projects' => $projects,'prjman' => $prjman,'teams' => $teams));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//insert assigned teams for project

		$this->validate($request, [

			'ProjectName' => 'required',
			'teams' => 'required|array|min:1'


		]);

		$input = $request->all();

		$checked_team_ids = $input['teams'];

		unset($input['teams']);

		$pid = $request->get('ProjectName');

		if (is_array($checked_team_ids)) {
			foreach ($checked_team_ids as $team_id) {

				DB::table('assign_teams')->insert(

							[ 'ProjectID'=> $pid,'team_id' => $team_id]
				     );

					DB::table('teams')->where('team_id', '=', $team_id)->update(

						[ 'assigned_state'=> 'assigned']



					);

			}
		}

		Session::flash('flash_message', 'Team successfully created!');

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
	public function destroy($id)
	{
		//
	}

}
