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
	public function index()
	{
		//$codeshares = Codeshare::all();
		$codeshares = Codeshare::orderBy('created_at', 'desc')->get();
		$comments = Comment::all();
		return view('codeshares.index', array('codeshares' => $codeshares),array('comments' => $comments));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//$codeshare = Codeshare::where('codeId', '20')->get();
		//$codeshares = Codeshare::all();

		//return to create after submiting details
		return view('codeshares.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//validate fields
		$this->validate($request, [

			'title' => 'required',
			'language'=>'required',
			'sourceCode'=>'required'

		]);

		//request all required fields
		$input = $request->all();

		//get the inputs
		Codeshare::create($input);

		//show successful message
		Session::flash('flash_message', 'Your code successfully posted! check in the code list to view your code');

		//return back to page
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($codeId)
	{
		//get codes by codeId
		$codeshare = Codeshare::find($codeId);

		//get all comments
		//$comments = Comment::all();

		//return to show
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
