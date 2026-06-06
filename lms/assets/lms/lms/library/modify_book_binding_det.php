<?php
require_once("../db1.php");
$library=$_POST['library'];
$rbb=$_POST['rbb'];

$dte=date("Y-m-d");
while( list(,$Value) = each($rbb))
{
	$sql="update lib_book_binding set status='R',return_date='$dte' where id='$Value' ";
	execute($sql) or die(error_description());
}
$msg="Updated details !!!";
header("Location:return_book_binding.php?library=$library&msg=$msg");
?>
