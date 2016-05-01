<?php namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\ReleaseBacklog;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;


use Illuminate\Http\Request;

class ReleaseBacklogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        //get completed projects and released projects details of logged in AH

		if(\Auth::check() && \Auth::user()->designation === 'Account Head') {

			$user = \Auth::user()->name;

			$account = Account::where('acc_head', $user)->get();

			foreach ($account as $acc) {

				$aname = $acc->acc_name;

				$pro_names = DB::table('projects')->where('State','Completed')->where('acc_name',$aname)->get();

				$projects=DB::table('release_backlogs')->where('acc_name',$aname)->get();

			}
		}



		return view('release_backlog.index', array('projects' => $projects , 'pname' => $pro_names));




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
	public function store(Request $request)
	{
		//change state of the project to be released

		$this->validate($request, [
			'ProjectName' => 'required',
             'acc_name' =>'required',
			'release_date' => 'required|date|date_format:Y-m-d|',



		]);

		$input = $request->all();

		$pname = $input['ProjectName'];

		ReleaseBacklog::create($input);


		DB::table('projects')
			->where('ProjectName', $pname)
			->update(array('State' => 'Released'));



		Session::flash('flash_message', 'Project successfully   Released!!!');

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



	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
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
