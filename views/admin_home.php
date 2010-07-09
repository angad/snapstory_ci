<html>
<title>admin | SnapStory </title>
<head>
</head>

<body>
<?php echo form_open("admin/login"); ?> <br/>
Username
<?php echo form_input('username', set_value('username')); ?> <br/>
Password
<?php echo form_password('password', ""); ?><br/>
<?php echo form_submit('login', "Login"); ?>

Forgot Password?<br/>
Change Password<br/>
</body>
</html>
