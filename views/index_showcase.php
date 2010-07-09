<html>
<title>THIS IS THE MAIN PAGE FOR SNAPSTORY
<head>
</head>

<body>
THIS IS THE MAIN PAGE FOR SNAPSTORY<br/>
LOADING latest5 themes showcase
<?php 
for($i = 0; $i<$data['size']; $i++)
{
	echo "theme name  - " . $data['theme_name' . $i] . "<br/>";
	echo "theme description - " . $data['theme_desc' . $i] . "<br/>";
	echo "theme pic - " . $data['theme_pic' . $i] . "<br/>";
	echo "date start - " . $data['date_start' . $i] . "<br/>";
	echo "date end - " . $data['date_end' . $i] . "<br/>";
	echo "<a href = 'http://code.angad.sg/showcase/theme/" . $data['theme_link' . $i] . "'>View theme showcase</a>";
	echo "------------------------------------<br/>";
}
?>

</body>
</html>

