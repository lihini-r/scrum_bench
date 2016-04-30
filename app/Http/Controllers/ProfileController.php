<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
Use App\Http\Controllers\Auth;
use App\Profile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\DB as DB;



class ProfileController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$profiles = Profile::all();
		return view('profiles.index', array('profiles' => $profiles));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('profiles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'id'=>'required',

			'about' => 'required',
			'prof_qual' => 'required',
			'acad_qual' => 'required',

		]);

		$input = $request->all();

		Profile::create($input);

		Session::flash('flash_message', 'Profile successfully created!');

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
		$profile = Profile::find($id);
		return view('profiles.show', array('profile' => $profile));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$profile = Profile::find($id);

		return view('profiles.edit', array('profile' => $profile));

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function update($id, Request $request)
	{
		$profile = Profile::find($id);

		$this->validate($request, [
			'user_id'=>'required',
			'about' => 'required',
			'prof_qual' => 'required',
			'acad_qual' => 'required',

		]);

		$input = $request->all();

		$profile->fill($input)->save();

		Session::flash('flash_message', 'Profile successfully Updated!');

		return redirect()->back();
	}





	//uploads a profile picture to the public path
	//parameters user id


	public static function uploadProfilePicture($id, Request $request)
	{
		$x = $id . ".";
		$image = $request->file('profile_pic');

		if ($image != null) {

			try
			{
				if (substr($image->getMimeType(), 0, 5) == 'image')
				{

					$imageName = $image->getClientOriginalExtension();

					$image->move(public_path() . '/dist/img/', $x . $imageName);

					$prof_pic_name = $x . $imageName;

					DB::table('profiles')->where('id', $id)->update(array('profile_pic' => $prof_pic_name));

					return redirect()->back();

				}
				else
				{
					Session::flash('flash_message', 'Please select a valid image !');
					return redirect()->back();
				}
			}
			catch(Exception $e){
				Session::flash('flash_message', $e);
				return redirect()->back();
			}


		}
		else
		{
			Session::flash('flash_message', 'No image selected !');
			return redirect()->back();
		}

	}




}
