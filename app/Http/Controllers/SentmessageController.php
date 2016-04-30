<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Session;
use App\Messages1;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Http\Request;
class SentmessageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	//Function to get messages sent by current logged in user ordered by date and time in descending order-to get the most recent message sent
	public function index()
	{

		$user = \Auth::user()->name;
		$messages1s = Messages1::where('from', $user)->orderBy('created_at', 'desc')->get();

		return view('sentmessages.index', array('messages1s' => $messages1s));
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

	//delete user's messages
	public function destroy($messageid)
	{
		$messages1=Messages1::findOrFail($messageid);
		$messages1->delete();
		DB::table('messages1s')->where('messageid','=', $messageid)->delete();
		return redirect()->route('sentmessages.index');
	}

}
