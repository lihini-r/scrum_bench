<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Eother;
use Session;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EotherController extends Controller {

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
		return view('eothers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$this->validate($request, [

			'sender' => 'required|Between:3,64|email',
			'recipient' => 'required|Between:3,64|email',
			'subject' => 'required',
			'message' => 'required'

		]);

		$from_email = $_POST['sender']; //sender email
		$recipient_email = $_POST['recipient']; //recipient email
		$subject = $_POST['subject']; //subject of the email
		$message = $_POST['message']; //message body

		$user_email = filter_var($_POST["sender"], FILTER_SANITIZE_EMAIL);

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
		//capture subject and message body from HTML form and use them in the code.
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
			Session::flash('flash_message', 'Could not send mail! Please check your PHP mail configuration.');

		}


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
		//
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
