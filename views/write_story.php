<html>
<head>
<title>Write Story</title>

</head>

<body>
<div id = "story">
<?php echo form_open("story/write"); ?><br/>
Story
<?php echo form_input('story', set_value('story')); ?> <br/>
<?php echo form_submit('sub', "Submit"); ?>
<?php echo form_close(); ?>
</div>


</body>


</html>

