<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Log;
use Exception;
use App\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class WorkflowController extends Controller
{
    /**
     * Get the Next State that a User Story should be moved to if its current state is as specified by the param
     *
     * @param $currentState
     * @return String Next State
     */
    public static function getNextState($currentState)
    {
        $WORKFLOW_STATUS_LIST = array("To-Do", "In-Progress", "Testing", "Review", "Resolved", "Closed");
        $WORKFLOW_NEXT_STATUS_INDEX_LIST = array("To-Do" => 1, "In-Progress" => 2, "Testing" => 3, "Review" => 4, "Resolved" => 5, "Closed" => 5);
        return $WORKFLOW_STATUS_LIST[$WORKFLOW_NEXT_STATUS_INDEX_LIST[$currentState]];
    }

    /**
     * Get the Next Action that a User Story status change button should have if its current state is as specified by the param
     *
     * @param $currentState
     * @return String Next State
     */
    public static function getNextAction($currentState)
    {
        $WORKFLOW_ACTION_LIST = array("To-Do" => "Start", "In-Progress" => "Start Testing", "Testing" => "To Review", "Review" => "Resolve", "Resolved" => "Close", "Closed" => "Closed");
        return $WORKFLOW_ACTION_LIST[$currentState];
    }

    /**
     * Get the Next State that a User Story should be moved to if its current state is as specified by the param
     *
     * @param $currentState
     * @return String Next State
     */
    public static function getNextStatePM($currentState)
    {
        $WORKFLOW_STATUS_LIST = array("To-Do", "In-Progress", "Testing", "Review", "Resolved", "Approved");
        $WORKFLOW_NEXT_STATUS_INDEX_LIST = array("To-Do" => 1, "In-Progress" => 2, "Testing" => 3, "Review" => 4, "Resolved" => 5, "Approved" => 5);
        return $WORKFLOW_STATUS_LIST[$WORKFLOW_NEXT_STATUS_INDEX_LIST[$currentState]];
    }

    /**
     * Get the Next Action that a User Story status change button should have if its current state is as specified by the param
     *
     * @param $currentState
     * @return String Next State
     */
    public static function getNextActionPM($currentState)
    {
        $WORKFLOW_ACTION_LIST = array("To-Do" => "Start", "In-Progress" => "Start Testing", "Testing" => "To Review", "Review" => "Resolve", "Resolved" => "Approve", "Approved" => "Approved");
        return $WORKFLOW_ACTION_LIST[$currentState];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
        try {
            $input = $request->all();

            Workflow::create($input)->id;

			Log::debug("WorkflowController:store - Creating new workflow entry : " . implode(',', array_slice($input, 1)));
			
            Session::flash('flash_message', 'workflow successfully created!');			

        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }

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
    public function update($id, Request $request)
    {
        try {

            $user_story = Workflow::find($id);

            $input = $request->all();

            $user_story->fill($input)->save();

			Log::debug("WorkflowController:update - Updating workflow having Id : " . $id . " with " . implode(',', array_slice($input, 2)));
			
            Session::flash('flash_message', 'User assigned successfully !');			

        } catch (Exception $ex) {
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
        //
    }

    /**
     * Get the status of the User Story specified by its Id
     *
     * @param  int $story_id
     * @return Response
     */
    public static function getStoryStatus($story_id)
    {
        $result = DB::table('workflows')->where('story_id', '=', $story_id)->get();
        $statuses = array();

		// Set default value for $last_status as "To-Do"
        $last_status = "To-Do";

        foreach ($result as $res) {
            $statuses[] = $res->status;
        }

        if (sizeof($statuses) > 0) {
            $last_status = $statuses[sizeof($statuses) - 1];
        }
		
		Log::info("WorkflowController:getStoryStatus - Status for User Story : " . $story_id . " - " . $last_status);

        return $last_status;
    }


    /**
     * Get the number of User Stories exists in specified status
     *
     * @param $status
     * @return Response
     */
    public static function getStatusCount($status)
    {
        $res_des = Auth::user()->designation;
		
        $count = 0;
        if ($res_des == 'Developer') {
            $stories = StoryController::getAssignStories();
            foreach ($stories as $key => $story) {
                $result_status = WorkflowController::getStoryStatus($story->story_id);
                if ($result_status == $status) {
                    $count++;
                }
            }
        }
		
		Log::info("WorkflowController:getStatusCount - Number of User Stories having status : " . $status . " - " . $count);

        return $count;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function updateWorkflowStatus($id, Request $request)
    {
        $user_story = Workflow::find($id);

        $input = $request->all();

        $user_story->fill($input)->save();

		Log::info("WorkflowController:updateWorkflowStatus - Updating workflow status having Id : " . $id . " with " . implode(',', array_slice($input, 2)));
		
        Session::flash('flash_message', 'User assigned successfully !');	

        return redirect()->back();
    }

}
