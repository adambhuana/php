<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>
<html>
<head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
	
</head>

<body>
	<h1>VIEW</h1>
	<div class='slideshow' style='width: 320px; height: 240px; float: left; position: relative;'>
		<img src='cameras/1.jpg'>
	</div>
</body>

</html>