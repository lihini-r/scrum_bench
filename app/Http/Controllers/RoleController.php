<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Permission;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\DB as DB;
use Session;


class RoleController extends Controller {

	/**;
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();

		return view('roles.index', array('roles' => $roles ));
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
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$role = Role::find($id);
//		$perms = Permission::all();
		$perms =DB::table('roles')->join('permission_role','permission_role.role_id','=','roles.id')->join('permissions','permissions.id','=','permission_role.permission_id')->where('roles.id','=',$id)->get();

		return view('roles.show', array('role' => $role),array('perms'=>$perms));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	public function permission($role_id, $perm_id)
	{
		try {
			DB::table('permission_role')->insert(
				['permission_id' => $perm_id, 'role_id' => $role_id]
			);
			Session::flash('flash_message', 'Profile successfully created!');

		}
		catch(QueryException $e){
			Session::flash('flash_message', 'Permission granted already!');
		}
}

	public function check($role_id, $perm_id)
	{

         $result = DB::table('permission_role')->where('permission_id', '=', $perm_id && 'role_id', '=', $role_id)->first();
		 if($result==null)
		 {
			 return true;
		 }


	}

}
