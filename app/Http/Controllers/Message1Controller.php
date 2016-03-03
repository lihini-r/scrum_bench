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

			$messages1s = Messages1::where('to',$user)->get();


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
		$this->validate($request, [

			'to' => 'required',
			'message' => 'required',
			'from' => 'required'

		]);

		$input = $request->all();
		$name= $input['to'];
		$users = DB::table('users')->lists('name');

		foreach($users as $key=>$user)
		{
			if( $user===$name)
			{
				Messages1::create($input);

				Session::flash('flash_message', 'Message successfully sent!');
			}

			else
			{
				Session::flash('flash_message', 'User not found');
			}



		}

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

		$messages1 = Messages1::find($messageid);
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
		DB::table('messages1s')->where('messageid', $id)->delete();
		//$this->db->where('messageid', $id);
		//$this->db->delete('messages1s');

		//return redirect()->back();
		 redirect('messages1s.index',array('messages1' => $id));

	}

}
