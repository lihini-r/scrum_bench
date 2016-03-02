<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sprint;
use Session;
use Auth;
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

        $res_des=Auth::user()->designation;
        $res_id=Auth::user()->id;
        $current_team_id="";
        $result_project="";

        if($res_des=='Developer' || $res_des=='Project Manager') {
            $result_teams = DB::table('dev_team')->where('user_id', '=', $res_id)->get();

            foreach ($result_teams as $result_team) {
                $current_team_id = $result_team->team_id;
            }

            $result_project_ids = DB::table('assign_projects')->where('team_id', '=', $current_team_id)->get();

            foreach ($result_project_ids as $result_project_id) {
                $result_project = $result_project_id->project_id;
            }



            $sprints = Sprint::where('project_id',$result_project)->get();
            return view('sprints.index', array('sprints' => $sprints));
        }

        else if($res_des=='Account Head' || $res_des=='Administrator') {
            $sprints = Sprint::all();
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
    /*public function store()
    {
        //
    }*/

    public function store(Request $request)
    {
        $this->validate($request, [
            //'sprint_name' => 'required',
            'project_id' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date'
        ]);

        $input = $request->all();
        $new_sp_name=$this->generateSprintId($request->input('project_id'));
        $input['sprint_name']=$new_sp_name;
        Sprint::create($input);

        Session::flash('flash_message', 'Successfully created ' . $new_sp_name);

        return redirect()->back();
    }

    public function generateSprintId($project_id)
    {
        $new_sprint_id = "";
        $result = DB::table('sprints')->where('project_id', '=', $project_id)->get();
        $sprint_ids = array();

        foreach ($result as $res) {
            $sprint_ids[] = $res->sprint_name;
        }

        if (sizeof($sprint_ids) > 0) {
            rsort($sprint_ids);
            $sprint_id_suffix = substr($sprint_ids[0], strpos($sprint_ids[0], "-") + 1);
            $new_sprint_id = "SPRINT-" . (intval($sprint_id_suffix) + 1);
        } else {
            $new_sprint_id = "SPRINT-1";
        }

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
    /*
    public function update($id)
    {
        //
    }
    */
    public function update($id, Request $request)
    {
        $sprint = Sprint::find($id);

        $this->validate($request, [
            'sprint_name' => 'required',
            'project_id' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date'
        ]);

        $input = $request->all();

        $sprint->fill($input)->save();

        Session::flash('flash_message', 'Sprint successfully Updated!');

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
    }

}
