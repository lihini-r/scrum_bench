<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserStory;
use Session;
use Illuminate\Support\Facades\DB as DB;
use Auth;
use Illuminate\Http\Request;

class StoryController extends Controller
{

    public static function getAssignStories()
    {
        $res_des = Auth::user()->designation;
        $res_id = Auth::user()->id;
        $result_user_stories = null;

        if ($res_des == 'Developer' || $res_des == 'Project Manager') {
            $result_user_stories = DB::table('user_stories')->where('assignee', '=', $res_id)->get();
        }
        return $result_user_stories;

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $res_des = Auth::user()->designation;
        $res_id = Auth::user()->id;
        $current_team_id = "";
        $result_project = "";

        if ($res_des == 'Developer' || $res_des == 'Project Manager') {
            $result_teams = DB::table('dev_team')->where('user_id', '=', $res_id)->get();

            foreach ($result_teams as $result_team) {
                $current_team_id = $result_team->team_id;
            }

            $result_project_ids = DB::table('assign_projects')->where('team_id', '=', $current_team_id)->get();

            foreach ($result_project_ids as $result_project_id) {
                $result_project = $result_project_id->project_id;
            }


            $user_stories = UserStory::where('project_id', $result_project)->get();
            return view('user_stories.index', array('user_stories' => $user_stories));
        } else if ($res_des == 'Account Head' || $res_des == 'Administrator') {
            //$result_id = DB::table('userstories')->where('name', '=', $res_id)->get();

            $user_stories = UserStory::all();
            return view('user_stories.index', array('user_stories' => $user_stories));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_stories.create');

    }


    /**
     * @param $project_id
     * @return string
     */
    public function generateStoryId($project_id)
    {
        $new_story_id = "";
        $result = DB::table('user_stories')->where('project_id', '=', $project_id)->get();
        $story_ids = array();

        foreach ($result as $res) {
            $story_ids[] = $res->story_id;
        }

        if (sizeof($story_ids) > 0) {
            rsort($story_ids);
            $story_id_suffix = substr($story_ids[0], strpos($story_ids[0], "-") + 1);
            $new_story_id = $project_id . "-" . (intval($story_id_suffix) + 1);
        } else {
            $new_story_id = $project_id . "-1";
        }

        return $new_story_id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //$input =new UserStory();
        $this->validate($request, [
            'project_id' => 'required',
            'summary' => 'required',
            'priority' => 'required',
            'assignee' => 'required',
            'reporter' => 'required',
            'description' => 'required',
            'org_est' => 'required',

            'due_date' => 'required|date|date_format:Y-m-d',

        ]);
        $input = $request->all();

        $input['story_id'] = $this->generateStoryId($request->input('project_id'));

        UserStory::create($input);
        Session::flash('flash_message', 'Story successfully created! ->' . $request->input('project_id'));

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int $story_id
     * @return Response
     */
    public function show($story_id)
    {
        $user_story = UserStory::find($story_id);
        return view('user_stories.show', array('user_story' => $user_story));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $story_id
     * @return Response
     */
    public function edit($story_id)
    {
        $user_story = UserStory::find($story_id);

        return view('user_stories.edit', array('user_story' => $user_story));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  int $story_id
     * @return Response
     */
    /*public function update($id)
    {
        //
    }*/

    public function update($story_id, Request $request)
    {
        $user_story = UserStory::find($story_id);

        $this->validate($request, [
            'project_id' => 'required',
            'summary' => 'required',
            'priority' => 'required',
            'assignee' => 'required',
            'reporter' => 'required',
            'description' => 'required',
            'org_est' => 'required',
            'due_date' => 'required|date|date_format:Y-m-d'
            //'end_date' => 'required|date|date_format:Y-m-d|after:start_date'
        ]);

        $input = $request->all();

        $user_story->fill($input)->save();

        Session::flash('flash_message', 'Story successfully Updated!');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $story_id
     * @return Response
     */
    public function updateAssignee($story_id, Request $request)
    {
        $user_story = UserStory::find($story_id);

        $input = $request->all();

        $user_story->fill($input)->save();

        Session::flash('flash_message', 'User assigned successfully !');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public static function getAssignedProject()
    {
        $res_des = Auth::user()->designation;
        $res_id = Auth::user()->id;
        $current_team_id = "";
        $result_project = "";

        if ($res_des == 'Developer' || $res_des == 'Project Manager') {
            $result_teams = DB::table('dev_team')->where('user_id', '=', $res_id)->get();

            foreach ($result_teams as $result_team) {
                $current_team_id = $result_team->team_id;
            }

            $result_project_ids = DB::table('assign_projects')->where('team_id', '=', $current_team_id)->get();

            foreach ($result_project_ids as $result_project_id) {
                $result_projectID = $result_project_id->project_id;

            }


        }

        return $result_projectID;
    }

}
