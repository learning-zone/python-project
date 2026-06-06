<?php
if($_POST)
{
	$media=$_POST['media'];
}
if($_REQUEST)
{
	$med=$_REQUEST['med'];
}

if($media==1) // Books CD
{
	header("Location:addMediaDet.php?media=$media");
}
if($media==2) // Books CD
{
	header("Location:add_book_cd.php?media=$media");
}
if($media==3)  //Book Floppy
{
	header("Location:add_book_floppy.php?media=$media");
}
if($media==4)  //Othere CD
{
	header("Location:add_other_cd.php?media=$media");
}
if($media==5)  //Projects Reports
{
	header("Location:add_project_report.php?media=$media");
}
if($media==6)  //Bound Volume
{
	header("Location:add_bound_media.php?media=$media");
}
?>