<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Codeshare;
use App\Comment;
use Session;
use Illuminate\Http\Request;

class CommentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//get all comments
		$comments = Comment::all();
		//return to show
		return view('codeshares.show', array('comments' => $comments));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return to show
		return view('codeshares.show');
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

			'name'=>'required',
			'comment' => 'required',
			'codeId' => 'required'

		]);

		//request all required fields
		$input = $request->all();

		//get the inputs
		Comment::create($input);

		//display success message
		Session::flash('flash_message', 'Comment successfully Added!');

		//return back to page
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

		//$comment = Comment::find($id);
		//return view('codeshare.show', array('comments' => $comment));
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
