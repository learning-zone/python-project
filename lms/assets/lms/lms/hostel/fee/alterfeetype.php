<?php
session_start();

require("../../db.php");
$Types = $_REQUEST['Types'];
$dfname = $_POST['dfname'];
/*


deletion or updation for fee_type


Satish.H.S
21-07-2003
*/


if($Types == "" && strtoupper($Types) != "MOD" && strtoupper($Types) != "DEL" && strtoupper($Types) != "ACT")
{
	die("<div class=\"label\">Please use proper procedure to <u>alter fee types</u>.<br></div>");
}

//Activate deleted fee types.

if(strtoupper($Types) == "ACT")
{

	while(list(,$value) = each($dfname))
	{
		$sql = "UPDATE hostel_fee_type set status=1 where fee_id = $value";
		execute($sql);
		echo $sql;
	}

	header("Location: feetypeadd.php");
}


//Modify / de-activate the fee types.

while(list(,$value) = each($fid))
{
	$temp = "fName$value";
	$name = $$temp;

	if(strtoupper($Types) == "MOD")
	{
		$sql = "update	hostel_fee_type set fee_name = '$name' WHERE fee_id = $value";
		echo $sql . "<br>";
		execute($sql);

	}
	else if(strtoupper($Types) == "DEL")
	{
		$sql = "update	hostel_fee_type set status = 0 WHERE fee_id = $value";
		execute($sql);
	}

	header("Location: feetypeadd.php");

}

?>


