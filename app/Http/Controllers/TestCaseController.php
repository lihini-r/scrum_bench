<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TestCase;
use Session;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Http\Request;

class TestCaseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


		$user = \Auth::user()->id;


		$test = TestCase::where('uid',$user)->get();

		return view('test_case.index', array('test' => $test));




	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$user = \Auth::user()->id;
		$user_story=DB::table('user_stories')->where('assignee',$user)->get();

		return view('test_case.create', array('user_story' => $user_story));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'TestCaseName' => 'required',
			'Scenario' => 'required',
			'TestSteps' => 'required',
			'ExpectedOutcome' => 'required',
			'uid' => 'required',
			'user_story' => 'required',
			'ActualOutcome'=>'required',
			'Pass_Fail'=>'required',
			'Comments'=>'required'
		]);

		$input = $request->all();

		TestCase::create($input);


		Session::flash('flash_message', 'Test Case successfully Created!!!');

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
	public function edit($TestCaseID)
	{
		$test = TestCase::find($TestCaseID);

		return view('test_case.edit', array('test' => $test));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($TestCaseID, Request $request)
	{
		$test = TestCase::find($TestCaseID);

		$this->validate($request, [
			'TestCaseID' => 'required',
			'ActualOutcome' => 'required',
			'Pass_Fail'=>'required',
			'Comments' => 'required'
		]);

		$input = $request->all();

		$test->fill($input)->save();

		Session::flash('flash_message', 'Test Case successfully Modified!');

		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($TestCaseID)
	{
		$test = TestCase::findOrFail($TestCaseID);

		$test->delete();




		Session::flash('flash_message', 'Test Case successfully deleted!');

		return redirect()->route('test_case.index');

	}

}
