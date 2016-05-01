<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lead;
use App\User;
use Illuminate\Http\Request;
use App\Account;
use App\Project;
use Session;

class LeadController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('assign_lead.index');

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//assign project lead

		if(\Auth::check() && \Auth::user()->designation === 'Account Head') {

			$user = \Auth::user()->name;

			$account = Account::where('acc_head', $user)->get();

			$project = Project::all();


		}

		return view('assign_lead.create',array('account' => $account,'projects' => $project));


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'ProjectName' => 'required|unique:leads',
			'ProjectLead'=>'required|unique:leads',


		]);

		$input = $request->all();

		Lead::create($input);



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
