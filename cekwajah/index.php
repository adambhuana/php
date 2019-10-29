<?php

include "FaceDetector.php";

$detector = new svay\FaceDetector('detection.dat');
$detector->faceDetect('cameras/i.jpg');
$detector->toJpeg();
?>
