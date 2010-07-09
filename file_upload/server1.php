<html>
<head>
</head>
<body>

<form action="http://snapimg1.000space.com/upload_file.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<?php require_once('recaptchalib.php');
$publickey = "6LcEO7sSAAAAAPi6DS3VbaPQlwvco3mjEmE2NfWB";
echo recaptcha_get_html($publickey);
?>
<input type="submit" name="submit" value="Submit" />
</form>
</body>
</html>
