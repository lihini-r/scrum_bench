<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Worklog;
use Session;
use App\UserStory;
use Auth;
use Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class WorklogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $worklogs = Worklog::all();
        return view('worklogs.index', array('worklogs' => $worklogs));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

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

            $new_id = Worklog::create($input)->id;

			Log::debug("WorklogController:store - Creating new workflog entry : " . implode(',', array_slice($input, 1)));
			
            Session::flash('flash_message', 'worklog successfully created!');
            Session::put($input['story_id'] . '-' . Auth::user()->id, 'started');
            Session::put($input['story_id'] . '-' . Auth::user()->id . "-id", $new_id);
			
			Log::info("WorklogController:store - Session Data key:" . $input['story_id'] . '-' . Auth::user()->id . ", value:" . 'started');
			Log::info("WorklogController:store - Session Data key:" . $input['story_id'] . '-' . Auth::user()->id . "-id, value:" . $new_id);

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
            $worklog = Worklog::find($id);
            $sdate = null;
            $input = $request->all();

            $result = DB::table('worklogs')->where('id', '=', $id)->get();

            foreach ($result as $res) {
                $sdate = $res->work_start_date;
            }

            $end = date_create($input['work_end_date']);

            $start = date_create($sdate);

            $duration = date_diff($end, $start);

            $hours = $duration->h;
            $hours = $hours + ($duration->days * 24);

            $input['duration'] = $hours;

            $worklog->fill($input)->save();
			
			Log::debug("WorklogController:update - Updating workflog entry : " . implode(',', array_slice($input, 2)));

            Session::flash('flash_message', 'worklog successfully Updated!');
            Session::put($input['story_id'] . '-' . Auth::user()->id, 'finished');
			
			Log::info("WorklogController:update - Session Data key:" . $input['story_id'] . '-' . Auth::user()->id . ", value:" . 'finished');

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
     * Calculate total logged hours of the Story specified by Story Id
     *
     * @param $story_id
     * @return int total logged hours hours relevant to the Story
     */
    public static function getTotalLoggedHours($story_id)
    {
        $total_logged_hours = 0;
        $work_logs = DB::table('worklogs')->where('story_id', '=', $story_id)->get();

        foreach ($work_logs as $work_log) {
            $duration = $work_log->duration;
            $total_logged_hours = $total_logged_hours + $duration;
        }
		
		Log::info("WorklogController:getTotalLoggedHours for Story Id:" . $story_id . " - " . $total_logged_hours);
		
        return $total_logged_hours;
    }

}
