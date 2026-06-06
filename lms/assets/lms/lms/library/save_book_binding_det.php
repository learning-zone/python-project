<?php
require_once("../db.php");
$library=$_POST['library'];
$acc_no=$_POST['acc_no'];
$des=$_POST['des'];
$Day=$_POST['Day'];
$Mon=$_POST['Mon'];
$Year=$_POST['Year'];

$library=1;
if(!checkdate($Mon,$Day,$Year))
{
	echo "Invalid Date . ";
	die("</td></tr></table>");
}
else
{
	$binding_date=$Year."-".$Mon."-".$Day;
	$sql="insert into lib_book_binding(acc_no,library,binding_date,status,descr) ";
	$sql.=" values('$acc_no','$library','$binding_date','S','".addslashes($des)."') " ;
	$res = execute($sql) or die(error_description());
	echo "Binding Details added Successfully!!";
	echo "<br>";
	echo "<a href='book_binding.php'>Go Back</a>";
}
?>
