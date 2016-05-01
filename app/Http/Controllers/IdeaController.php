<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Idea;
use Session;

use App\User;
use Illuminate\Support\Facades\DB as DB;
use Auth;


class IdeaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

     $pms=DB::table('assign_projects')->where('ProjectManager',Auth::user()->name)->get();

        foreach($pms as $key => $pm)
	    {
		    $id= $pm->ProjectName;

		    $ideas=DB::table('ideas')->where('project_id',$id)->get();

	    }


		return view('ideas.index', array('ideas' => $ideas));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('ideas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
		'idea_id' => 'required|unique:ideas',
			'project_id' => 'required',
			'title' => 'required',
			'description' => 'required',
			'priority' => 'required ',


		]);

		$input = $request->all();

		Idea::create($input);

		Session::flash('flash_message', 'Idea successfully created!');

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
		$idea = Idea::find($id);

		return view('ideas.show', array('idea' => $idea));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($idea_id)
	{

		$idea = Idea::find($idea_id);

		return view('ideas.edit', array('idea' => $idea));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$idea = Idea::find($id);

		$this->validate($request, [
			'idea_id' => 'required',
			'project_id' => 'required',
			'title' => 'required',
			'description' => 'required',
			'priority' => 'required',
		]);

		$input = $request->all();

		$idea->fill($input)->save();

		Session::flash('flash_message', 'Idea successfully Updated!');

		return redirect()->back();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */



	public function destroy($idea_id)
	{

		$idea = Idea::findOrFail($idea_id);

		$idea->delete();


		DB::table('ideas')->where('idea_id'
			, '=', $idea_id)->delete();

		Session::flash('flash_message', 'Idea successfully deleted!');

		return redirect()->route('ideas.index');


	}



	//generates an id for the newly creating ideas
	//parameter project id
    //returns newly created id

	public static function generateIdeaID($project_id)
	{
		$new_idea_id = "";
		$results = DB::table('ideas')->where('project_id', '=', $project_id)->get();
		$idea_ids = array();

		foreach ($results as $result) {
			$idea_ids[] = $result->idea_id;
		}

		if (sizeof($idea_ids) > 0) {
			rsort($idea_ids);
			$idea_id_suffix = substr($idea_ids[0], strpos($idea_ids[0], "D") + 1);
			$new_idea_id = "P".$project_id . "-ID" . (intval($idea_id_suffix) + 1);
		} else {
			$new_idea_id = "P".$project_id . "-ID1";
		}

		return $new_idea_id;

	}


	//used to display the ideas priority with different colours
	//parameters idea priority
	//returns badge colour

	public static function getBadgeColour($status)
	{
		$color=null;
		if($status=="High")
		{
           $color=  "label pull-right bg-red";
		}
		else if($status=="Medium")
		{
			$color=  "label pull-right bg-yellow";
		}
		else if($status=="Low")
		{
			$color=  "label pull-right bg-green";
		}
		return $color;
	}


}
