<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Worklog;
use Session;
use App\UserStory;
use Auth;
use Illuminate\Http\Request;

class WorklogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$worklogs = Worklog::all();
		return view('worklogs.index', array('worklogs' => $worklogs));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$input = $request->all();

		$new_id = Worklog::create($input)->id;

		Session::flash('flash_message', 'worklog successfully created!');
		Session::put($input['story_id'].'-'.Auth::user()->id, 'started');
		Session::put($input['story_id'].'-'.Auth::user()->id."-id", $new_id);

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
	/*public function update($id)
	{
		//
	}*/


	public function update($id, Request $request)
	{
		$worklog = Worklog::find($id);

		$input = $request->all();

		$worklog->fill($input)->save();

		Session::flash('flash_message', 'worklog successfully Updated!');
		Session::put($input['story_id'].'-'.Auth::user()->id, 'finished');

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
		//
	}

}
