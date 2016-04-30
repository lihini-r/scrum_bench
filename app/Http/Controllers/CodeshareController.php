<?php namespace App\Http\Controllers;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Codeshare;
use App\Comment;
use Illuminate\Http\Request;


class CodeshareController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	//function to view code posts
	public function index()
	{
		$codeshares = Codeshare::orderBy('created_at', 'desc')->get();
		//$comments = Comment::all();
		return view('codeshares.index', array('codeshares' => $codeshares));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	//function to display form to add new code post
	public function create()
	{
		return view('codeshares.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	//function to store code posts
	public function store(Request $request)
	{
		$this->validate($request, [

			'title' => 'required',
			'language'=>'required',
			'sourceCode'=>'required',
			'userName'=>'required'

		]);

		$input = $request->all();

		Codeshare::create($input);
		Session::flash('flash_message', 'Your code successfully posted! check in the code list to view your code');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	//function to show selected code post
	public function show($codeId)
	{
		$codeshare = Codeshare::find($codeId);
		return view('codeshares.show', array('codeshare' => $codeshare));
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

	//function to update useer posted code
	public function update($id, Request $request)
	{
		$codeshare = Codeshare::find($id);

		$this->validate($request, [
			'title',
			'language',
			'sourceCode',
			'userName'
		]);

		$input = $request->all();

		$codeshare->fill($input)->save();

		Session::flash('flash_message', 'Your post successfully Updated!');

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
