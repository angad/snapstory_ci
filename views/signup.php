<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml">

<head>

<title>User Sign-Up</title>

<style>
</style>

<script>
</script>

</head>

<body>

<div id = "top">

	<?php echo validation_errors(); ?>
	Create New User
	<?php echo form_open("user/submit"); ?><br/>
	Name
	<?php echo form_input('name', set_value('name')); ?> <br/>
	Desired Username
	<?php echo form_input('username', set_value('username')); ?> <br/>
	Desired Password
	<?php echo form_password('pwd', ""); ?> <br/>
	Password Confirm
	<?php echo form_password('pwdconf', ""); ?> <br/>
	email id
	<?php echo form_input('email', set_value('email')); ?> 
	<br/> captcha here
	<br/>
	<?php echo form_submit('sub', "Submit"); ?>
	<?php echo form_close(); ?>

	<br/>
	<?php echo form_open("user/login"); ?> <br/>
	Username
	<?php echo form_input('username', set_value('username')); ?> <br/>
	Password
	<?php echo form_password('pwd', ""); ?><br/>
	<?php echo form_submit('login', "Login"); ?>
	
	<br/>
	<fb:login-button perms="email,publish_stream,user_photos" autologoutlink="true"></fb:login-button>

    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
      FB.init({appId: '132809166742172', status: true,
               cookie: true, xfbml: true});
      FB.Event.subscribe('auth.login', function(response) {
        window.location.reload();
      });
    </script>
</div>
</body>
</html>
