<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Team;
use Session;

use App\AssignProjects;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

use App\Account;

class AssignController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{




	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		//get logged in AH account and pass all project details

		if(\Auth::check() && \Auth::user()->designation === 'Account Head') {

		$user = \Auth::user()->name;

		$account = Account::where('acc_head', $user)->get();

			$project = Project::all();


		}

		return view('assign.create',array('account' => $account,'projects' => $project));


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//insert project managers into assign_projects table and update state of the project in projects table
		//to assign project managerss to projects

		$this->validate($request, [
			'ProjectName' => 'required|unique:assign_projects',
			'ProjectManager'=>'required|unique:assign_projects',


		]);

		$input = $request->all();

		AssignProjects::create($input);

		$pid = $request->get('ProjectName');

		DB::table('projects')->where('ProjectID', '=', $pid)->update(

			[ 'State'=> 'Open']);



		Session::flash('flash_message', 'Project Manager successfully Added!!!');

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
