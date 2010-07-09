<html>
<title>Photo Story Preview</title>


<head>
<style>
</style>

<script>
</script>
</head>

<body>
User account controls, back to account page<br/>
<br/> THIS IS A PHOTO+STORY PREVIEW. The content will be screened manually before being published <br/>
<img id = "image" src = "<?php echo 'http://' . $server . '.000space.com/get_img.php?dir=upload&file=' . $name; ?>"></img>
<br/>
Photo caption <?php echo $caption; ?> <br/>
Photo tags <?php echo $tags; ?> <br/>
Story title <?php echo $title; ?> <br/>
Story <?php echo $story; ?> <br/>
</body>
</html>
