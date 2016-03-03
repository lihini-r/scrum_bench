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
		$codeshares = Codeshare::all();
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
		return view('codeshares.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'language'=>'required',
			'sourceCode'=>'required'



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
	public function show($codeId)
	{

		$codeshare = Codeshare::find($codeId);

		$comments = Comment::all();

		return view('codeshares.show', array('codeshare' => $codeshare), array('comments' => $comments));
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
