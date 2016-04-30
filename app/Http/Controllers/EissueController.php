<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Eissue;
use Illuminate\Support\Facades\File;
use PhpSpec\Exception\Exception;
use Session;
use Illuminate\Http\Request;

class EissueController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$eissues = Eissue::all();
		return view('eissues.index', array('eissues' => $eissues));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	//function to display email form
	public function create()
	{
		return view('eissues.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	//function to send email
	public function store(Request $request)
	{

		$this->validate($request, [

			'email' => 'required|Between:3,64|email',
			'subject' => 'required',
			'message' => 'required'

		]);

		$from_email = $_POST['email']; //sender email
		$recipient_email = 'temmyrelf@yahoo.com'; //recipient email(lead)
		$subject = $_POST['subject']; //subject of the email
		$message = $_POST['message']; //message body

		$user_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

		//separate html version from plain text version.Boundary for different sections of content in the email.
		$boundary = md5("sanwebe");
		//header
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From:" . $from_email . "\r\n";
		$headers .= "Reply-To: " . $user_email . "" . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();

		//plain text
		$body = "--$boundary\r\n";
		$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
		$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
		$body .= chunk_split(base64_encode($message));



		if(is_uploaded_file($_FILES['File']['tmp_name']) ==true)
		{
			//get file details we need
			$file_tmp_name = $_FILES['File']['tmp_name'];
			$file_name = $_FILES['File']['name'];
			$file_size = $_FILES['File']['size'];
			$file_type = $_FILES['File']['type'];
			$file_error = $_FILES['File']['error'];


			if ($file_error > 0)
			{
				die('upload error');
			}
			//read from the uploaded file & base64_encode content for the mail
			$handle = fopen($file_tmp_name, "r");
			$content = fread($handle, $file_size);
			fclose($handle);
			//capture subject and message body from HTML form and use them in the code.
			$encoded_content = chunk_split(base64_encode($content));


			//attachment
			$body .= "--$boundary\r\n";
			$body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
			$body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
			$body .= "Content-Transfer-Encoding: base64\r\n";
			$body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
			$body .= $encoded_content;

		}




		$sentMail = @mail($recipient_email, $subject, $body, $headers);


		if ($sentMail) //output success or failure messages
		{
			Session::flash('flash_message', 'Your email successfully sent');

		}
		else
		{

			Session::flashDanger('flash_message', 'Oops!!! Something went wrong. Please check your computer\'s Internet connection!');
			//Session::flash('flash_message', 'Oops!!! Something went wrong. Please check your computer\'s Internet connection!');
		}

		//	try {
		//	mail($recipient_email, $subject, $body, $headers);

		//	}

//catch exception
		//catch (phpmailerException $e) {
		//	echo $e->errorMessage(); //Pretty error messages from PHPMailer
		//	}


		//return back to page
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

		$eissue = Eissue::find($id);
		return view('eissues.show', array('eissue' => $eissue));
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

}
