<?php namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests;
use App\Http\Controllers\Auth;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;



class AccountController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$accounts = Account::all();

		return view('accounts.index', array('accounts' => $accounts));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('accounts.create');
	}


	/* Show the form for listing hidden project accounts*/

	public function show_hidden()
	{
		$accounts = Account::all();

		return view('accounts.show_hidden', array('accounts' => $accounts));
	}

	//Strore newly created records to the database

	public function store(Request $request)
	{
		$acc_head = User::lists('name', 'designation');

		$this->validate($request, [
			'acc_name' => 'required|unique:accounts',
			'description' => 'required',
			'acc_head' => 'required |unique:accounts',


		]);

		$input = $request->all();

		Account::create($input);

		Session::flash('flash_message', 'Account successfully created!');

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
		$account = Account::find($id);

		return view('accounts.show', array('account' => $account));


	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$account = Account::find($id);

		return view('accounts.edit', array('account' => $account));

	}




	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	//Update the account details by taking the account id

	public function update($id, Request $request)
	{
		$account = Account::find($id);

		$this->validate($request, [
			'acc_name' => 'required',
			'description' => 'required',
			'acc_head' => 'required',
		]);

		$input = $request->all();

		$account->fill($input)->save();

		Session::flash('flash_message', 'Account successfully Updated!');

		return redirect()->back();
	}


	//Draw the project progress bar
	// project id as the parameter
	//returns the progress markup to the view

	public static function showProjectProgress($pid)
	{


		$user_stories=DB::table('user_stories')->where('project_id',$pid)->get();

		$tot_org_est=0;
		$finished_org_est=0;

		$usr_strs=DB::table('workflows')->where('status',"Closed")->get();

		foreach($user_stories as $user_story)
		{

			$tot_org_est=$tot_org_est+$user_story->org_est;


			foreach($usr_strs as $usr_stry)
			{
				if($user_story->story_id==$usr_stry->story_id)
				{
					$finished_org_est=$finished_org_est+$user_story->org_est;
				}
			}
		}

		$success_class = "progress-bar-success";
		$danger_class = "progress-bar-yellow";
		$in_progress_class = "progress-bar-primary";
		$label_string = "";
		$final_style_class = "";
		$progress_value = 0;
		$background_color = "#cfcfcf";


		if( $tot_org_est!=0 ){

			$progress_value = ($finished_org_est / $tot_org_est) * 100;
			$label_string = round($progress_value);

			if($progress_value>50)
			{
				$final_style_class = $success_class ;
			}

			elseif($progress_value>25)
			{
				$final_style_class =  $in_progress_class  ;
			}

			else
			{
				$final_style_class =   $danger_class  ;
			}

			$progress_markup = "<div class='progress progress-xs progress-striped active' style='background-color: " . $background_color . "; width: 80%; '>";
			$progress_markup = $progress_markup . "<div class='progress-bar " . $final_style_class . "' style='width: " . $progress_value . "%'></div>";
			$progress_markup = $progress_markup . "</div>";
			$progress_markup = $progress_markup . "<span class='badge bg-red'>" . $label_string . "%</span>";

			return $progress_markup;

		}
		else {
			$label_string = round($progress_value);

			$progress_markup = "<div class='progress progress-xs progress-striped active' style='background-color: " . $background_color . "; width: 80%; '>";
			$progress_markup = $progress_markup . "<div class='progress-bar " . $final_style_class . "' style='width: " . $progress_value . "%'></div>";
			$progress_markup = $progress_markup . "</div>";
			$progress_markup = $progress_markup . "<span class='badge bg-red'>" . $label_string . "%</span>";

			return $progress_markup;
		}


	}


	//Hide the project account by taking
	// account id as the parameter

	public function hide($id)
	{
		DB::table('accounts')
			->where('id', $id)
			->update(['Hide' => "on"]);



		Session::flash('flash_message', 'Account successfully Hidden!');

		return redirect()->back();
	}




}
