<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Sprint;
use App\Team;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;
class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('search.index');

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
		$this->validate($request, [
			'searchinput' => 'required'
		]);

		$input = $request->all();

		$word=$input['searchinput'];




		$search=Project::where('ProjectName', 'LIKE', '%'. $word .'%')
			->orWhere('duration', 'LIKE', '%'. $word .'%')
			->orWhere('ProjectID', 'LIKE', '%'. $word .'%')
			->orWhere('description', 'LIKE', '%'. $word .'%')
			->orWhere('State', 'LIKE', '%'. $word .'%')
			->get();



		$search1=DB::table('user_stories')->where('summary', 'LIKE', '%'. $word .'%')
			->orWhere('priority', 'LIKE', '%'. $word .'%')
			->orWhere('due_date', 'LIKE', '%'. $word .'%')
			->orWhere('reporter', 'LIKE', '%'. $word .'%')
			->orWhere('description', 'LIKE', '%'. $word .'%')
			->get();




	return view('search.index', array('search' => $search, 'search1' => $search1));





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
	public function destroy($id)
	{
		//
	}

}
