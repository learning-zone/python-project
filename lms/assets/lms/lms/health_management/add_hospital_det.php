<html>

<head><?php

session_start();

include("../db.php");

$hospital=$_GET['hospital'];

if(strlen($hospital))

{

	$sql1=execute("select * from hospital_tab where hospital_name='$hospital'") or die(error_description());

	if(rowcount($sql1)>=1)

	{

		echo "<font color=red><b>Duplicate Name Entered !! Cannot Save Details</b></font><br>";

		echo "<font color=red><b><a href=add_hospital.php>Back to Add Hospital Form</a></b></font>";

		die();

	}

	$sqlstr="Insert Into hospital_tab(hospital_name) Values ('$hospital')";

	execute($sqlstr) or die("Cannot insert into hospital table!");

	

 }else{

 	echo "<p align=\"Left\"><b>Please Enter Valid hospital Name</b></p>";

 }

?>

<SCRIPT LANGUAGE ="JavaScript">

	function reload1()

	{

    document.form1.action="add_hospital.php";

	 document.form1.submit();

	 }

	 </script>

</head>

<body onLoad="reload1()" >

 <form name="form1" method="post">

     </form>

     </body>

     </html>

