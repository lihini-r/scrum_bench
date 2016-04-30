<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserStory;
use Session;
use Illuminate\Support\Facades\DB as DB;
use Auth;
use Illuminate\Http\Request;
use Log;
use Exception;

class StoryController extends Controller
{

    /**
     * Get a list of User Stories assigned to currently logged user
     * @return List of user stories assigned to the currently logged user
     */
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
        $res_name = Auth::user()->name;
        $current_team_id = "";
        $result_project = "";

        if ($res_des == 'Developer') {
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

			Log::info("StoryController:index - Dev User : " . $res_id . ", team : " . $current_team_id . ", project : " . $result_project);
			
			// Get user Stories relevant to the resolved Project
            $user_stories = UserStory::where('project_id', $result_project)->get();
            
			Log::debug("StoryController:index - Selected User Stories :  " . $user_stories);
            return view('user_stories.index', array('user_stories' => $user_stories));
			
        } else if ($res_des == 'Project Manager') {			
			// Get Project that the Project Manager has been assigned to
            $result_project_ids = DB::table('assign_projects')->where('ProjectManager', '=', $res_name)->get();
            foreach ($result_project_ids as $result_project_id) {
                $result_project = $result_project_id->ProjectName;
            }
			
			// Get user Stories relevant to the resolved Project
            $user_stories = UserStory::where('project_id', $result_project)->get();
			
			Log::info("StoryController:index - Project Manager : " . $res_id . ", name : " . $res_name . ", project : " . $result_project);
			Log::debug("StoryController:index - Selected User Stories :  " . $user_stories);
			
            return view('user_stories.index', array('user_stories' => $user_stories));

        } else if ($res_des == 'Account Head' || $res_des == 'Administrator') {
			// For Account Heads and Administrators, return all Stories
            $user_stories = UserStory::all();
           // $user_stories =DB::table('user_stories')->get();
            
			Log::info("StoryController:index - " . $res_des . ", All Stories will be displayed");
			
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
     * Generates Next Story Display Id for a given project
     *
     * @param  String $project_id
     * @return Story Display Id
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
			// Revers the resultant story_ids array and get 0th index Story as the last added Story
            rsort($story_ids);
			
			// Substring from '-' in order to get suffix
            $story_id_suffix = substr($story_ids[0], strpos($story_ids[0], "-") + 1);
			
			Log::info("StoryController:generateStoryId - Last Story Display Id : " . $story_ids[0]);
			
			// Generated Story Display Id format : P[PROJECT_ID]-[NEXT_INCREMENTAL_VALUE]
            $new_story_id = "P" . $project_id . "-" . (intval($story_id_suffix) + 1);
        } else {
            $new_story_id = "P" . $project_id . "-1";
        }

		Log::info("StoryController:generateStoryId - New Generated Story Display Id : " . $new_story_id);
		
        return $new_story_id;
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
			
			Log::debug("StoryController:store - Creating new Story : " . implode(',', array_slice($input, 1)));

            Session::flash('flash_message', 'Story successfully created! ->' . $request->input('project_id'));

        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }

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
     * @param int $story_id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($story_id, Request $request)
    {
        try {

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
            ]);

            $input = $request->all();

            $user_story->fill($input)->save();
			
			Log::debug("StoryController:update - Updating Story : " . implode(',', array_slice($input, 2)));

            Session::flash('flash_message', 'Story successfully Updated!');

        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }

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

    /**
     * Get the Project that currently logged user's team owns
     * @return String Project Id
     */
    public static function getAssignedProject()
    {
        $res_des = Auth::user()->designation;
        $res_id = Auth::user()->id;
        $current_team_id = "";
        $result_project = "";

        if ($res_des == 'Developer' || $res_des == 'Project Manager') {
			// Get Team that current user has been assigned to
            $result_teams = DB::table('dev_team')->where('user_id', '=', $res_id)->get();

            foreach ($result_teams as $result_team) {
                $current_team_id = $result_team->team_id;
            }

			// Get Project that the Team has been assigned to
            $result_project_ids = DB::table('assign_teams')->where('team_id', '=', $current_team_id)->get();

            foreach ($result_project_ids as $result_project_id) {
                $result_projectID = $result_project_id->ProjectID;
            }

        }

        return $result_projectID;
    }

    /**
     * Get List of User Stories that currently logged user's project contains
     * @return List of User Stories
     */
    public static function getStoriesInProject()
    {
        $res_des = Auth::user()->designation;
        $res_id = Auth::user()->id;
        $current_team_id = "";
        $result_project = "";
        $user_stories = "";

        if ($res_des == 'Developer') {
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

			// Get user Stories relevant to the resolved Project
            $user_stories = DB::table('user_stories')->where('project_id', $result_project)->get();

        } else if ($res_des == 'Project Manager' || $res_des == 'Account Head') {
			// For Project Managers and Account Head, return all Stories
            $user_stories = DB::table('user_stories')->get();
        }


        return $user_stories;
    }

	/**
     * Get count of User Stories having a given priority among those have been assinged to logged user
     *
     * @param $priority
     * @return int count of User Stories having a given priority
     */
    public static function getPriority($priority)
    {
        $res_des = Auth::user()->designation;
        $accept = 0;
        if ($res_des == 'Developer') {
            $stories = StoryController::getAssignStories();
            foreach ($stories as $key => $story) {
                $result_priority = $story->priority;
                if ($result_priority == $priority) {
                    $accept++;
                }
            }
        }
        return $accept;
    }

    /**
     * Check whether current date is the due date of the User Story specified by Story Id
     *
     * @param $storyId
     * @return bool true if current date is the due date of the User Story
     */
    public static function isDueDateOfStory($storyId)
    {
        $days = 0;
        $endDate = "";
        $sprint_results = DB::table('user_stories')->where('story_id', '=', $storyId)->get();
        foreach ($sprint_results as $key => $sprint_result) {
            $endDate = $sprint_result->due_date;
        }

        $end = date_create($endDate);
        $dateNow = date("Y-m-d");
        $now = date_create($dateNow);

        $duration = date_diff($end, $now);

        $days = $duration->days;

		// If end date is lower than current date, multiply from -1 to indicate that date difference implies overdue time
        if ($end < $now) {
            $days = $days * -1;
        }

        return $days;
    }

    /**
     * Helps to retrieve Progress of specified User Story as a percentage
     *
     * @param $story_id
     * @param $org_est
     * @return int Progress as a percentage
     */
    public static function progressbar($story_id, $org_est)
    {
        $logged_hrs = WorklogController::getTotalLoggedHours($story_id);
        $est_hrs = intval($org_est);

        if ($est_hrs > $logged_hrs) {

            $progress_value = ($logged_hrs / $est_hrs) * 100;
            return $progress_value;

        } else if ($est_hrs == $logged_hrs) {

            $progress_value = 100;
            return $progress_value;

        } else if ($est_hrs < $logged_hrs) {

            $diff = $est_hrs - $logged_hrs;
            $progress_value = ($diff / $est_hrs) * 100;
            return $progress_value;
        }
    }


}
