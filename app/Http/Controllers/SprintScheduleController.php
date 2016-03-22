<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SprintSchedule;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB as DB;
use Auth;

class SprintScheduleController extends Controller
{

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
        $result_ids="";


        $result_teams = DB::table('dev_team')->where('user_id', '=', $res_id)->get();

        foreach ($result_teams as $result_team) {
            $current_team_id = $result_team->team_id;
        }

        $result_project_ids = DB::table('assign_teams')->where('team_id', '=', $current_team_id)->get();

        foreach ($result_project_ids as $result_project_id) {
            $result_project = $result_project_id->ProjectID;
        }

        $result_sprints_ids = DB::table('sprints')->where('project_id', '=', $result_project)->get();
        foreach ($result_sprints_ids as $result_sprints_id) {
            $result_ids = $result_sprints_id->id;
        }

        $sprint_schedules = SprintSchedule::where('sprint_id', $result_ids)->get();
        return view('sprint_schedules.index', array('sprint_schedules' => $sprint_schedules, 'sprint_id' => $result_ids));




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
        $input = $request->all();

        $stories_to_add = $input['stories_to_add'];
        $sprint_id = $input['sprint_id'];
        DB::table('sprint_schedules')->where('sprint_id', '=', $sprint_id)->delete();

        unset($input['stories_to_add']);


        $story_id_str = "";

        if (is_array($stories_to_add)) {
            foreach ($stories_to_add as $story_id) {
                $input['story_id'] = $story_id;
                SprintSchedule::create($input);
                $story_id_str = $story_id_str . " " . $story_id;
            }

        }

        Session::flash('flash_message', 'Stories Added to Speint Successfully! - ' . $story_id_str);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
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

    public static function isStoryExistInSprint($story_id, $sprint_id)
    {
        $result_user_stories = DB::table('sprint_schedules')->where('story_id', '=', $story_id)->where('sprint_id', '=', $sprint_id)->get();
        $story_ids = array();
        $accept = false;
        foreach ($result_user_stories as $res) {
            $story_ids[] = $res->story_id;
        }

        if (sizeof($story_ids) > 0) {
            $accept = true;
        }

        return $accept;

    }

    public static function getStoryInSprint($sprint_id)
    {
        $result_user_stories = DB::table('sprint_schedules')->where('sprint_id', '=', $sprint_id)->get();
        $story_ids = array();

        foreach ($result_user_stories as $res) {
            $story_ids[] = $res->story_id;
        }
        return $story_ids;
    }




}
