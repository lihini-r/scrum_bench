<?php namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Illuminate\Http\Request;

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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$acc_head = User::lists('name', 'designation');

		$this->validate($request, [
			'acc_name' => 'required',
			'description' => 'required',
			'acc_head' => 'required',


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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function update($id)
	{
		//
	}*/

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

}
