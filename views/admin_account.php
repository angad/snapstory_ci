<html>
<title>admin | SnapStory </title>

<head>
</head>


<body>
Create new theme<br/>
<?php echo form_open("admin/new_theme"); ?><br/>
Theme name
<?php echo form_input('theme_name', set_value('theme_name')); ?> <br/>
Date Start
<?php echo form_input('date_start', set_value('date_start')); ?> <br/>
Date End
<?php echo form_input('date_end', set_value('date_end')); ?> <br/>
Theme description
<?php echo form_input('theme_desc', set_value('theme_desc')); ?> <br/>
Theme pic link
<?php echo form_input('theme_pic', set_value('theme_pic')); ?> <br/>

<?php echo form_submit('sub', "Submit"); ?>
<?php echo form_close(); ?>

</body>

</html>
