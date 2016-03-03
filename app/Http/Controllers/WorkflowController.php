<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Workflow;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{

    public static function getNextState($currentState){
        $WORKFLOW_STATUS_LIST = array("To-Do", "In-Progress", "Testing", "Review", "Resolved", "Closed");
        $WORKFLOW_NEXT_STATUS_INDEX_LIST = array("To-Do"=>1, "In-Progress"=>2, "Testing"=>3, "Review"=>4, "Resolved"=>5, "Closed"=>5);
        return $WORKFLOW_STATUS_LIST[$WORKFLOW_NEXT_STATUS_INDEX_LIST[$currentState]];
    }

    public static function getNextAction($currentState){
        $WORKFLOW_ACTION_LIST = array("To-Do" => "Start", "In-Progress" => "Start Testing", "Testing" => "To Review", "Review" => "Resolve", "Resolved" => "Close", "Closed" => "Closed");
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
    /*public function store()
    {
        //
    }*/

    public function store(Request $request)
    {
        $input = $request->all();

        Workflow::create($input)->id;



        Session::flash('flash_message', 'workflow successfully created!');

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

}
