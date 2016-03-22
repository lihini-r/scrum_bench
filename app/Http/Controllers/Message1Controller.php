<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Session;
use App\Messages1;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Http\Request;

class Message1Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


			$user = \Auth::user()->name;

			$messages1s = Messages1::where('to',$user)->orderBy('created_at', 'desc')->get();


		//$messages1s = Messages1::all();
		return view('messages1s.index', array('messages1s' => $messages1s));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return to send message form
		return view('messages1s.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response

	public function store()
	{

	}*/
	public function store(Request $request)
	{
		//validate fields
		$this->validate($request, [

			'to' => 'required',
			'message' => 'required',
			'from' => 'required'

		]);

		//request all required fields
		$input = $request->all();

		//$users = DB::table('users')->lists('name');

		//get the inputs
		Messages1::create($input);

		//display success message
		Session::flash('flash_message', 'Message successfully sent!');

		//return back to page
		return redirect()->back();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $messageid
	 * @return Response
	 */
	public function show($messageid)
	{
		//get message data from id
		$messages1 = Messages1::find($messageid);

		//return to view messsages page
		return view('messages1s.show', array('messages1' => $messages1));
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
		//get message by messageid
		DB::table('messages1s')->where('messageid', $id)->delete();
		//$this->db->where('messageid', $id);
		//$this->db->delete('messages1s');

		//return redirect()->back();
		 redirect('messages1s.index',array('messages1' => $id));

	}

}
