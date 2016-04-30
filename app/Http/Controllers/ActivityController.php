<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB as DB;
use Session;

class ActivityController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$latestActivities = Activity::with('user')->latest()->limit(100)->get();
		return view('activities.index', array('latestActivities' => $latestActivities));

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

// cleans all the records in the log

	public static function cleanActivityLog()
	{
		//Activity::truncate();
		DB::table('activity_log')->delete();
		return redirect()->back();


	}


	//delete a particular record in the activity log
	// taking the activity id as the parameter

	public function destroy($id)
	{

		$idea = Activity::findOrFail($id);

		$idea->delete();


		DB::table('activity_log')->where('id'
			, '=', $id)->delete();

		Session::flash('flash_message', 'Activity successfully deleted!');

		return redirect()->route('activities.index');



	}


}
