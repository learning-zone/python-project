<html>
<head><?php
session_start();
include("../db.php");
$nationality=$_GET['nationality'];
if(strlen($nationality))
{
	$sql1=execute("select * from nationality where nation='$nationality'") or die(error_description());
	if(rowcount($sql1)>=1)
	{
		echo "<font color=red><b>Duplicate Nationality Name Entered !! Cannot Save Details</b></font><br>";
		echo "<font color=red><b><a href=national.php>Back to Add NAtionality Form</a></b></font>";
		die();
	}
	$sqlstr="Insert Into nationality(nation) Values ('$nationality')";
	execute($sqlstr) or die("Cannot insert into nationality table!");
	
 }else{
 	echo "<p align=\"Left\"><b>Please Enter Valid Nationality Name</b></p>";
 }
?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="national.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>
