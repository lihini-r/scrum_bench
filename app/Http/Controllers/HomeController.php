<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Project;
use App\Color;
use Session;
use App\Accountheaddashboard;
use Illuminate\Http\Request;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$project =Project::all();
		$color =Color::all();
		$count=Color::count();
		return view('home', array('projects' => $project),array('colors' => $color),array('colors' => $count));
		//return view('home');
	}

	public function show($projectid)
	{


	}

}
