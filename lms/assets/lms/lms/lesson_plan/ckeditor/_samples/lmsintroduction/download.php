<?php
if($_POST)
{
$img_path=$_POST['img_path'];	
}
if($_GET)
{
$img_path=$_GET['img_path'];	
}

$filename="$img_path";
//$filename = '[file name].[extension]';

$ctype="$img_path";

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');


header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: $ctype");

// change, added quotes to allow spaces in filenames


header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filename));
readfile("$filename");
exit();

?>



