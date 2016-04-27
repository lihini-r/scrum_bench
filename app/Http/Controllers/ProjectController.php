<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Team;
use App\User;
use Session;
use Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Auth\Guard;


use Illuminate\Http\Request;
use App\Account;

class ProjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//get only unhidden project details

		if(\Auth::check() && \Auth::user()->designation === 'Account Head') {

			$user = \Auth::user()->name;

			$account = Account::where('acc_head',  $user)->get();

			foreach($account as $acc){

				$aname=$acc->acc_name;

			$project = Project::where('Hide', 'off')->where('acc_name', $aname)->get();

			}
		}

		return view('projects.index', array('projects' => $project,'account' => $account));
	}





	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		if(\Auth::check() && \Auth::user()->designation === 'Account Head') {

			$user = \Auth::user()->name;

			$account = Account::where('acc_head', $user)->get();

		}


		return view('projects.create',array('account' => $account));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{


try{
		$this->validate($request, [
			'ProjectName' => 'required',
			'Description' => 'required',
			'State' => 'required',
			'duration' => 'required|integer'
		]);

		$input = $request->all();

		Project::create($input);





			Log::debug("ProjectController:store - Creating new Project : " . implode(',', array_slice($input, 1)));
			

		Session::flash('flash_message', 'Project successfully Added!!!');


        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }


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





	}


	public function update($ProjectID, Request $request)
	{
		$project = Project::find($ProjectID);

		$this->validate($request, [
			'ProjectName' => 'required',
			'Description' => 'required',
			'State'=>'required',
			'duration' => 'required|integer'
		]);

		$input = $request->all();

		$project->fill($input)->save();

		Session::flash('flash_message', 'Project successfully Updated!');

		return redirect()->back();
	}




}


