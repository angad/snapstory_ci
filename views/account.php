<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<title>User Account Information</title>

<head>
<style>
</style>
</head>

<body>

<div id = "user">
Username <?php echo $username; ?>
<br/>
Name <?php echo $name; ?>
<br/>
email <?php echo $email; ?>
<br/>
</div>


<div id = "logout">
<?php if($fb_logged_in) { ?>
<fb:login-button perms="email,publish_stream,user_photos" autologoutlink="true"></fb:login-button>
<?php } else { ?>
<a href = "http://code.angad.sg/index.php/user/logout">Logout</a>
<?php } ?>
</div>

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
