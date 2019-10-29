<?php
session_start();
$_SESSION['face']='';
if(isset($_POST['hapusfoto']))
{
	$filename = '1.jpg';
	$url = 'cameras/' . $filename;
	if(file_exists($url)) {
		unlink($url);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>

function openwebcam(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 

</script>
</head>

<body>
<a href="javascript:openwebcam('camera1.php','OK',800,600);">Daftarkan Wajah Anda Terlebih dahulu</a>
<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="textarea"></label>
    <?php
	$filename = '1.jpg';
	$url = 'cameras/' . $filename;
	if(file_exists($url)) {
		$cek=true;
	}
	else
	{
		$cek=false;
	}
	?> 
  </p>
  <p>
  <?php
		if($cek==true)
  		{
			include "FaceDetector.php";

            $detector = new svay\FaceDetector('detection.dat');
            $detector->faceDetect('cameras/1.jpg');
			if(!(is_null($detector->getface())))
	        {
				require 'image.compare.class.php';
				$class = new compareImages;
				//echo $class->compare('1.jpg','2.jpg');
				if($class->compare('cameras/1.jpg','cameras/2.jpg')<=10)
				{
					//echo $class->compare('cameras/1.jpg','cameras/2.jpg');
					echo "Welcome<br>";

  ?>                     
                         <textarea name="komen" id="komen" cols="45" rows="5" <?php  if($cek==false)
  {?> disabled="disabled"<?php }else{?>autofocus<?php }?>></textarea><br />
  <img src="cameras/1.jpg" width="100" height="100"/>
  						<input type="submit" name="hapusfoto" id="button2" value="Delete" />
  </p>
  <?php 
				}
				else
				{
					echo "Maaf, anda siapa?<br>";
?>
                         <textarea name="komen" id="komen" cols="45" rows="5" disabled="disabled"></textarea><br />
                  <img src="cameras/1.jpg" width="100" height="100"/>
  						<input type="submit" name="hapusfoto" id="button2" value="Delete" />	
  <?php      
				}
			 }
		     else
			 {
				 $_SESSION['face']='no';
				 $face=$_SESSION['face'];
				 echo '<textarea name="komen" id="komen" cols="45" rows="5" disabled="disable"></textarea><br>';
				 echo "<img src='cameras/1.jpg' width='100' height='100'/><br>Gambar ini Bukan Muka";
				 echo "<input type='submit'name='hapusfoto' id='button2' value='Delete' />";
			 }
		}
        else
        {
  ?>
  
   <?php
  if($cek==false)
  {
  ?>
   <textarea name="komen" id="komen" cols="45" rows="5" <?php  if($cek==false)
  {?> disabled="disabled"<?php }else{?>autofocus<?php }?>></textarea><br />
    <img src="cameras/guest.jpg" width="50" height="50"/>
    <input type="submit" name="button" id="button" value="Take Picture" onclick="openwebcam('camera.php','OK',800,600);" />
     <?php 
  }
  ?>
  <?php
		}
	
  ?>
  
</form>
</body>
</html>