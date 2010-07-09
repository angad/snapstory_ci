<?php


//error redirect function
function err_redirect($error)
{
	echo "<html> <body> <form action = 'http://code.angad.sg/index.php/snap/error/' method = 'POST' name = 'error_form'> 
<input type='hidden' name='error' value='" .  $error . "'/> </form> <script language='javascript' type='text/javascript'>
	document.error_form.submit(); </script> </body> </html>";

}

//success redirect function
function suc_redirect($success)
{
	echo "<html> <body> <form action = 'http://code.angad.sg/index.php/snap/success/' method = 'POST' name = 'success_form'> 
<input type='hidden' name='success' value='" .  $success . "'/> <input type='hidden' name='server' value='snapimg1'/> </form> <script language='javascript' type='text/javascript'> document.success_form.submit(); </script> </body> </html>";
}

//Captch checker-------------------------------
require_once('recaptchalib.php');
$privatekey = "6LcEO7sSAAAAACHEy8GdVFpTDs-oWL9vaqe1HSgo";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
	$error = "captcha";
	err_redirect($error);
}
//---------------------------------------------



//Check upload image MIME information and size--
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg")) //For IE - pjpeg
&&($_FILES["file"]["size"] < 20000000)) //max image size 20MB
{
	if ($_FILES["file"]["error"] > 0)
	{
		$error = "file" . $_FILES["file"]["error"];
		err_redirect($error);
	}
	else
	{
		$imageinfo = getimagesize($_FILES["file"]["tmp_name"]);	
		if($imaginfo['mime'] != 'image/gif' && $imageinfo['mime']!='image/jpeg')
		{
			$error = "inv";
			err_redirect($error);
		}
		else
		{
			$ext = substr(strrchr($_FILES["file"]["name"], "."), 1);
			$rand_name = md5(rand() * time());
			$path = "upload/" . $rand_name . '.' . $ext;
			if (file_exists("upload/" . $_FILES["file"]["name"]))
			{
				$error = "exists";
				err_redirect($error);
	      		}
			move_uploaded_file($_FILES["file"]["tmp_name"], $path);
			$success = $rand_name . '.' . $ext;
			suc_redirect($success);
		}
	}
}
else
  {
  $error = "inv";
	err_redirect($error);
  }
?>
