<html>
<head><?php
session_start();
include("../db.php");
$cname=$_GET['cname'];
if(strlen($cname))
{
	$sql1=execute("select * from lms_units where unit_name='$cname'");
	if(rowcount($sql1)>=1)
	{
		echo "<font color=red><b>Duplicate Unit Name Entered !! Cannot Save Details</b></font><br>";
		echo "<font color=red><b><a href=units.php>Back to Add Unit Form</a></b></font>";
		die();
	}

	$sqlstr="insert into lms_units(unit_name,status)Values('$cname',1)";
	execute($sqlstr);
	
 }
 else
 {
 	echo "<p align=\"Left\"><b>Please Enter Valid Unit Name</b></p>";
 }
?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="units.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>
