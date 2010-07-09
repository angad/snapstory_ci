<html>

<head>

<title>Create Post</title>

<style>
</style>

<script>
</script>

</head>

<body>
<div id = "top">
	Enter Post 
	<?php echo form_open("editor/submit"); ?>
	<?php echo form_input('title', " "); ?>
	<?php echo form_input('post', " "); ?>
	<?php echo form_submit('asubmit', "Submit post"); ?>
	<br />
	<?php echo form_close(); ?>
	<?php echo form_open("editor/load/10"); ?>
	<?php echo form_submit('loader', "Load 10 posts"); ?>
</div>
</body>
</html>
