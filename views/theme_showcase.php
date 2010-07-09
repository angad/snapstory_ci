<html>
<title>theme showcase</title>
<head>
</head>


<body>
THEME SHOWCASE
<?php 
echo "Theme name - " . $data['theme_name'] . "<br/>";
echo "Theme link - " . $data['theme_link'] . "<br/>";

for($i=0; $i<$data['size']; $i++)
{
	echo "Picture - " . $i . " server - " .  $data['server' . $i] . " name - " . $data['img_name' . $i] . " tags - " . $data['tags' . $i] . " caption - " . $data['caption' . $i] . "<br/>";
	echo "Story - " . $i . " text - " . $data['story' . $i] . " title - " . $data['title' . $i] . "<br/>";
	echo "------------------<br/>";	
}
?>

</body>


</html>

