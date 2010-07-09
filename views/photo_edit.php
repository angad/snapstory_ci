<html>
<title>Edit Photo
</title>

<head>
<style>
</style>

<script type = 'text/javascript'>
</script>
</head>

<body>

<img id = "image" src = "<?php echo 'http://' . $server . '.000space.com/get_img.php?dir=upload&file=' . $name; ?>"></img>


<div id = "edit">
Tags/Caption/Likes/Story
<?php echo form_open("snap/edit"); ?><br/>
Photo Tags
<?php echo form_input('tags', set_value('tags')); ?> <br/>
Photo Caption
<?php echo form_input('caption', set_value('caption')); ?> <br/>
Story Title
<?php echo form_input('title', set_value('title')); ?> <br/>
Story
<?php echo form_input('story', set_value('story')); ?> <br/>
<?php echo form_hidden('link', $link); ?>
<?php echo form_submit('sub', "Submit"); ?>
<?php echo form_close(); ?>
</div>

</body>
</html>
