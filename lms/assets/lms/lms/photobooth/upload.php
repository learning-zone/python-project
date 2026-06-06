<?php
$phid = $_REQUEST['phid'];
$phpath = $_REQUEST['phpath'];
/*
	This file receives the JPEG snapshot
	from webcam.swf as a POST request.
*/

// We only need to handle POST requests:
if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	exit;
}

$folder = $phpath;

if($folder=='../student_images/temp/')
	$rfg=1;
else
{
if($folder=='../staff_images/temp/')
	$rfg=2;
else
	$rfg=3;
}
//$filename = md5($_SERVER['REMOTE_ADDR'].rand()).'.jpg';
$filename=$phid.".jpg";

$original = $folder.$filename;

// The JPEG snapshot is sent as raw input:
$input = file_get_contents('php://input');

if(md5($input) == '7d4df9cc423720b7f1f3d672b89362be'){
	// Blank image. We don't need this one.
	exit;
}

$result = file_put_contents($original, $input);
if (!$result) {
	echo '{
		"error"		: 1,
		"message"	: "Failed save the image. Make sure you chmod the uploads folder and its subfolders to 777."
	}';
	exit;
}
/*
$info = getimagesize($original);
if($info['mime'] != 'image/jpeg'){
	unlink($original);
	exit;
}

// Moving the temporary file to the originals folder:
//rename($original,'uploads/original/'.$filename);
//$original = 'uploads/original/'.$filename;

// Using the GD library to resize 
// the image into a thumbnail:

$origImage	= imagecreatefromjpeg($original);
$newImage	= imagecreatetruecolor(154,110);
imagecopyresampled($newImage,$origImage,0,0,0,0,154,110,520,370); 

imagejpeg($newImage,'uploads/thumbs/'.$filename);
*/
if($rfg==1)
	echo '{"status":1,"message":"Success!","filename":"'.$filename.'"}';
else
{ if($rfg==2)
	echo '{"mstatus":1,"message":"Success!","filename":"'.$filename.'"}';
else
	echo '{"mmstatus":1,"message":"Success!","filename":"'.$filename.'"}';
}

?>