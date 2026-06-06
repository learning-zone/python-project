<?php
//session_start();
require("../db1.php");
$Types = $_REQUEST['Types'];
$location_name = $_REQUEST['location_name'];
$dept = $_REQUEST['dept'];
//echo $location_name;
if(strlen($location_name))
{

        $sql1=execute("select * from location_master where location='$location_name' and dept_id=$dept");
		if(rowcount($sql1)!=0)
		{

			$msg="Duplicate Location  Found! Cannot Save Details";

			header("Location:LocationMaster.php?msg=$msg");

			
		}
		if($location_name=='')

		{

		$msg="Location Name Should Not Be Blank...!!!";

		header("Location:LocationMaster.php?msg=$msg");

		

		}

		$sql="insert into location_master(location,dept_id,status) values('$location_name',$dept,'1')";

		$result=execute($sql);

		$msg="Location Name Inserted Successfully..!";

		header("Location:LocationMaster.php?msg=$msg");
}

else

{

$msg="Please enter valid Location Name!!!";

header("Location:LocationMaster.php?msg=$msg");

}

?>

