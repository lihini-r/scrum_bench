<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SprintSchedule;
use App\Sprint;
use App\Workflow;
use Exception;
use Session;
use Auth;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class SprintController extends Controller
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
        $res_name = Auth::user()->name;
        $current_team_id = "";
        $result_project = "";

        if ($res_des == 'Developer' ) {
			// Get Team that current user has been assigned to
            $result_teams = DB::table('dev_team')->where('user_id', '=', $res_id)->get();

            foreach ($result_teams as $result_team) {
                $current_team_id = $result_team->team_id;
            }

			// Get Project that the Team has been assigned to
            $result_project_ids = DB::table('assign_teams')->where('team_id', '=', $current_team_id)->get();

            foreach ($result_project_ids as $result_project_id) {
                $result_project = $result_project_id->ProjectID;
            }
			
			Log::info("SprintController:index - Dev User : " . $res_id . ", team : " . $current_team_id . ", project : " . $result_project);
			
			// Get Sprints relevant to the resolved Project
            $sprints = Sprint::where('project_id', $result_project)->get();
			
            return view('sprints.index', array('sprints' => $sprints));
        }
        else if($res_des == 'Project Manager'){
			// Get Project that the Project Manager has been assigned to
            $result_project_ids = DB::table('assign_projects')->where('ProjectManager', '=', $res_name)->get();
            foreach ($result_project_ids as $result_project_id) {
                $result_project = $result_project_id->ProjectName;
            }
			
			Log::info("SprintController:index - Project Manager : " . $res_id . ", name : " . $res_name . ", project : " . $result_project);
			
			// Get Sprints relevant to the resolved Project
            $sprints = Sprint::where('project_id', $result_project)->get();
			
            return view('sprints.index', array('sprints' => $sprints));

        }
        else if ($res_des == 'Account Head' || $res_des == 'Administrator') {
            $sprints = Sprint::all();
			
			Log::info("SprintController:index - " . $res_des . ", All Sprints will be displayed");
			
            return view('sprints.index', array('sprints' => $sprints));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('sprints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'project_id' => 'required',
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d|after:start_date'
            ]);

            $input = $request->all();
            $new_sp_name = $this->generateSprintId($request->input('project_id'));
            $input['sprint_name'] = $new_sp_name;
            Sprint::create($input);

			Log::debug("SprintController:store - Creating new Sprint : " . implode(',', array_slice($input, 1)));
			
            Session::flash('flash_message', 'Successfully created ' . $new_sp_name);

        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }

        return redirect()->back();
    }

	/**
     * Generates Next Sprint Display Id for a given project
     *
	 * @param  String $project_id
     * @return Sprint Display Id
     */
    public function generateSprintId($project_id)
    {
        $new_sprint_id = "";
        $result = DB::table('sprints')->where('project_id', '=', $project_id)->get();
        $sprint_ids = array();

        foreach ($result as $res) {
            $sprint_ids[] = $res->sprint_name;
        }

        if (sizeof($sprint_ids) > 0) {
			// Revers the resultant sprint_ids array and get 0th index Sprint as the last added Sprint
            rsort($sprint_ids);
			
			// Substring from '-' in order to get suffix
            $sprint_id_suffix = substr($sprint_ids[0], strpos($sprint_ids[0], "-") + 1);
			
			Log::info("SprintController:generateSprintId - Last Sprint Display Id : " . $sprint_ids[0]);
			
			// Generated Sprint Display Id format : SPRINT-[NEXT_INCREMENTAL_VALUE]
            $new_sprint_id = "SPRINT-" . (intval($sprint_id_suffix) + 1);
        } else {
            $new_sprint_id = "SPRINT-1";
        }

		Log::info("SprintController:generateSprintId - New Generated Sprint Display Id : " . $new_sprint_id);
		
        return $new_sprint_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $sprint = Sprint::find($id);        
        return view('sprints.show', array('sprint' => $sprint));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $sprint = Sprint::find($id);
        return view('sprints.edit', array('sprint' => $sprint));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        try {

            $sprint = Sprint::find($id);

            $this->validate($request, [
                'sprint_name' => 'required',
                'project_id' => 'required',
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d|after:start_date'
            ]);

            $input = $request->all();

            $sprint->fill($input)->save();
			
			Log::debug("SprintController:update - Updating Sprint : " . implode(',', array_slice($input, 2)));

            Session::flash('flash_message', 'Sprint successfully Updated!');

        }catch(Exception $ex){
            Log::error($ex->getMessage());
        }

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
        try {
            $sprint = Sprint::findOrFail($id);

            $sprint->delete();

            DB::table('sprints')->where('id'
                , '=', $id)->delete();

			Log::info("SprintController:destroy - Deleted Sprint : " . $id);
            Session::flash('flash_message', 'Sprint successfully deleted!');

        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }

        return redirect()->route('sprints.index');
    }

    /**
     * Helps to retrieve Sprint Id for a given project
     *
     * @param  String $project_id
     * @return Last Sprint Id
     */
    public static function getLastSprintId($project_id)
    {
        $Last_sprint_id = "";
        $result = DB::table('sprints')->where('project_id', '=', $project_id)->get();
        $sprint_ids = array();

        foreach ($result as $res) {
            $sprint_ids[] = $res->id;
        }

        if (sizeof($sprint_ids) > 0) {
            rsort($sprint_ids);
            $Last_sprint_id = $sprint_ids[0];
        }

        return $Last_sprint_id;
    }

    /**
     * Update Status of the sprint relevant to given Sprint Id
     *
     * @param $id
     * @param Request $request     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function updateSprint($id, Request $request)
    {
        $sprint = Sprint::find($id);

        $input = $request->all();

        $sprint->fill($input)->save();

        Session::flash('flash_message', 'Sprint ' . $input['status'] . ' successfully!');

        return redirect()->back();
    }

    /**
     * Calculate duration of the Sprint (specified by Sprint id) in hours
     *
     * @param $sprint_id
     * @return int sprint duration in hours
     */
    public static function getEstimatedSprintHrs($sprint_id)
    {
        $start_date = "";
        $end_date = "";
        $hours = 0;

        $result = DB::table('sprints')->where('id', '=', $sprint_id)->get();

        foreach ($result as $res) {
            $start_date = $res->start_date;
            $end_date = $res->end_date;
        }

        $start = date_create($start_date);
        $end = date_create($end_date);

        $duration = date_diff($end, $start);

        $hours = ($duration->days * 24);
		
		Log::info('SprintController:getEstimatedSprintHrs - Estimated Sprint duration in Hours : ' . $hours);

        return $hours;
    }

    /**
     * Calculate total logged hours of the Sprint specified by Sprint Id
     *
     * @param $sprint_id
     * @return int sprint total logged hours hours
     */
    public static function getLoggedHours($sprint_id)
    {
        $total_logged_hours = 0;
        $all_logged_hours = 0;
        $story_set = array();
		
		// Get all schedules in "sprint_schedules" table relevant to specified Sprint Id
        $sprints = DB::table('sprint_schedules')->where('sprint_id', '=', $sprint_id)->get();
        foreach ($sprints as $key => $sprint) {
			// From each sprint schedule get Story Id
            $value = $sprint->story_id;
			
			// Retrieve Story details relevant to the Story Id considered in this iteration	
            $contents = DB::table('user_stories')->where('story_id', '=', $value)->get();
			
			// Populate $story_set array with the Retrieved Story Object
            array_push($story_set, $contents);
        }

		// Iterate over $story_set array
        foreach ($story_set as $story) {
            $story[0]->story_id;
			
			// Refer to "worklogs" table and get all worklogs relevant to the Story Id considered in this iteration		
            $work_logs = DB::table('worklogs')->where('story_id', '=', $story[0]->story_id)->get();

			// Calculate Total logged hours for the Story Id considered in this iteration
            foreach ($work_logs as $work_log) {
                $duration = $work_log->duration;
                $total_logged_hours = $total_logged_hours + $duration;
            }

			// Add Total logged hours for the Story to $all_logged_hours variable which will store logged hours relevant all stories in the sprint
            $all_logged_hours = $all_logged_hours + $total_logged_hours;
        }

        return $all_logged_hours;
    }

    /**
     * Calculate total logged hours of the Sprint specified by Sprint id
     *
     * @param $sprint_ids
     * @return String formatted bar chart data
     */
    public static function getAllSprintsBarChartData($sprint_ids)
    {
        $count=0;
        $single_bar="";

        $data_bars = "";
        foreach ($sprint_ids as $key => $sprint) {
            $est_value = self::getEstimatedSprintHrs($sprint->id);
            $logged_value = self::getLoggedHours($sprint->id);

            $single_bar = "[" . $est_value . "," . $logged_value . "]";
            if ($count != 0){
                $data_bars = $data_bars . ",";
            }
            $data_bars = $data_bars . $single_bar;
            $count++;
        }
		
        Log::info('SprintController:getAllSprintsBarChartData - Bar Chart data : ' . $data_bars);
        return $data_bars;
    }

    /**
     * Check whether Sprint specified by Sprint id is closable (All Stories have been approved)
     *
     * @param $sprint_id
     * @return bool true if Sprint is closable
     */
    public static function isSprintClosable($sprint_id){
        $accept=true;
        $stories = array();

        if($sprint_id != null && strcmp($sprint_id,"")!=0){
            $stories=SprintScheduleController::getStoryInSprint($sprint_id);
			
            foreach ($stories as $story_id) {
                $status=WorkflowController::getStoryStatus($story_id);

				// If any story exists with status that is not Approved, Sprint is considered not closable
                if($status!='Approved'){
                    $accept=false;
                    break;
                }
            }
        }else{
            $accept=false;
        }

        return $accept;
    }

    /**
     * Check whether current date is the end date of the Sprint specified by Sprint
     *
     * @param $sprintid
     * @return bool true if current date is the end date of the Sprint
     */
    public static function isDate($sprintid)
    {
        $days=0;
        $endDate="";
        $sprint_results = DB::table('sprints')->where('id', '=', $sprintid)->get();
        foreach ($sprint_results as $key => $sprint_result) {
            $endDate = $sprint_result->end_date;
        }
		
        $end = date_create($endDate);
        $dateNow=date("Y-m-d");
        $now = date_create($dateNow);

        $duration = date_diff($end, $now);

        $days =$duration->days ;

		// If end date is lower than current date, multiply from -1 to indicate that date difference implies overdue time
        if($end < $now ) {
            $days = $days * -1;
        }

        return $days;
    }

    /**
     * Check whether the Project specified by project id contains Sprints
     *
     * @param $project_id
     * @return bool true if the project contains one or more Sprints
     *
     */
    public static function isSprintsExistInProject($project_id)
    {
        $result_sprints = DB::table('sprints')->where('project_id', '=', $project_id)->get();

        $sprint_ids = array();
        $accept = false;
        foreach ($result_sprints as $res) {
            $sprint_ids[] = $res->id;
        }

		// If "sprints" table consists at least one entry relevant to the specified Project Id, set return value to true
        if (sizeof($sprint_ids) > 0) {
            $accept = true;
        }

        return $accept;
    }



}
