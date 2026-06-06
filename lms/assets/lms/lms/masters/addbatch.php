<?php
require("../db.php");
$Type=$_REQUEST['Type'];
$Sel=$_POST['Sel'];
$newYear=$_POST['newYear'];
if(trim($Type) == "Mod")
{
	while( list(,$Value) = each($Sel) )
	{

		$SubName = $_POST['yr'.$Value];

		$sqlstr="Update batch_master Set batch_name='" . $SubName ."' where id=" . $Value;
		execute($sqlstr)
			or die(mysql_error());
	}

	header("Location:batchmaster.php");
}
	elseif(trim($Type) == "Add")
	{
	if($newYear == "")
	{
	 die("<div align='center' class='error_msg'><b>Empty Batch Name not allowed<b><br><a href=batchmaster.php><font color='red'>Click Here to Go Back</font></a></div>");
	}

	$sqlstr="Insert Into batch_master(batch_name) VALUES('$newYear')";

	echo($sqlstr);

	execute($sqlstr);

header("Location:batchmaster.php");
}

?>
