<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Team;
use App\User;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB as DB;


use Illuminate\Http\Request;

class TeamController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $team = Team::all();

        return view('teams.index', array('teams' => $team));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        //insert team details to teams & dev_teams tables
        //developer list will be inserted to dev_teams


        $this->validate($request, [

            'TeamName' => 'required',
            'users' => 'required|array|min:1'


        ]);

        $input = $request->all();

        $checked_user_ids = $input['users'];

        unset($input['users']);

        $team_id = Team::create($input)->team_id;

        if (is_array($checked_user_ids)) {
            foreach ($checked_user_ids as $user_id) {
                DB::table('dev_team')->insert(
                    ['team_id' => $team_id, 'user_id' => $user_id]
                );
            }
        }

        Session::flash('flash_message', 'Team successfully created!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($team_id)
    {
        $team = Team::find($team_id);
        return view('teams.show', array('team' => $team));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($team_id)
    {

        $team = Team::find($team_id);

        return view('teams.edit', array('team' => $team));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    /*public function update($id)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $team_id
     * @return Response
     */
    public function destroy($team_id)
    {
         //delete teams



        $team = Team::findOrFail($team_id);

        $team->delete();


        DB::table('assign_teams')->where('team_id'
            , '=', $team_id)->delete();

        Session::flash('flash_message', 'Team successfully deleted!');

        return redirect()->route('teams.index');



    }


    public function update($team_id, Request $request)
    {

        //update team detaails

        $team = Team::find($team_id);

        $this->validate($request, [
            'TeamName' => 'required',
            'assigned_state' => 'required',
            'users' => 'required|array|min:1'



        ]);

        $input = $request->all();

        $checked_user_ids = $input['users'];

        DB::table('dev_team')->where('team_id', '=', $team_id)->delete();

        if (is_array($checked_user_ids)) {
            foreach ($checked_user_ids as $user_id) {
                DB::table('dev_team')->insert(
                    ['team_id' => $team_id, 'user_id' => $user_id]
                );
            }
        }

        unset($input['users']);

        $team->fill($input)->save();

        Session::flash('flash_message', 'Team successfully Updated!');

        return redirect()->back();
    }

}
