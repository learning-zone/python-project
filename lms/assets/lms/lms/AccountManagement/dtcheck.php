<?php 
$dt1 = isset($_REQUEST["date51"]) ? $_REQUEST["date51"] : "";
$dt2 = isset($_REQUEST["date52"]) ? $_REQUEST["date52"] : "";
if($dt1=='0000-00-00')
{
echo "<script>alert('Select From Date');window.location.href='balancesheet.php';</script>";
}
else
{
	if($dt2=='0000-00-00')
	{
		echo "<script>alert('Select To Date');window.location.href='balancesheet.php';</script>";
	}
	else
	{
		echo "<script>window.location.href='viewbalancesheet.php';</script>";
	}
}
?>