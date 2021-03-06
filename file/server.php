<?php
session_start();
$post = $_POST;

if($post)
{	
	$sess = $_SESSION;

	if(!isset($sess['token']) || $sess['token'] !== $post['token'])
	{
		die(json_encode(['status'=>false,'msg'=>'Unable to send feedback. Please try later']));
	}	

	try
	{	
		$username 	= $post['name'];
		$email 		= $post['email'];
		$mobile 	= $post['mobile'];
		$rating 	= $post['rating'];
		$msg 		= $post['msg'];

		if(!empty($rating) && !empty($msg) && !empty($username))
		{
			$msg = '<!DOCTYPE html>
					<html>
					<body>

					<p><strong>Hello Administrator</strong></p>
					<p>Please find the below user details.</p>

					<table width="40%">
					  <tr>
					    <td>User Name</td>
					     <td>'.$username.'</td>
					  </tr>
					  <tr>
					    <td>e-mail</td>
					     <td>'.$email.'</td>
					  </tr>
					  <tr>
					    <td>Mobile</td>
					     <td>'.$mobile.'</td>
					  </tr>
					  <tr>
					    <td>Rating</td>
					    <td>'.$rating.'</td>
					  </tr>
					   <tr>
					    <td>Message</td>
					    <td>'.$msg.'</td>
					  </tr>
					  <tr><td></br></br></td></tr>
					  <tr>
					    <td><b>Thanks & Regards</b></td>
					  </tr>
					  <tr>
					  <td><b>Smartsunenergy Team</b></td>
					  </tr>
					  </tr>
					</table>

					</body>
					</html>
				';
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			//$headers .= 'From: <test@gmail.com>' . "\r\n";
			
			//operation@smartsunenergy.in
		
			if(mail("operation@smartsunenergy.in","Feedback",$msg,$headers))
			{
				die(json_encode(['status'=>true,'msg'=>'Feedback sent successfully.']));
			}
			else
			{
				die(json_encode(['status'=>false,'msg'=>'Error something went wrong']));
			}
		}
		else
		{
			die(json_encode(['status'=>false,'msg'=>'Unable to send feedback. Please try later']));
		}

	}
	catch(Exception $e)
	{
		die(json_encode(['status'=>false,'msg'=>'Error something went wrong']));
	}
}
else
{
	die(json_encode(['status'=>false,'msg'=>'Error something went wrong']));
}


?>