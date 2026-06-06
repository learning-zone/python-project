<html>
<head><?php
session_start();
include("../db.php");
$cname=$_GET['cname'];
if(strlen($cname))
{
	$sql1=execute("select * from lms_file_type where file_name='$cname'");
	if(rowcount($sql1)>=1)
	{
		echo "<font color=red><b>Duplicate File Type Name Entered !! Cannot Save Details</b></font><br>";
		echo "<font color=red><b><a href=filetype.php>Back to Add File Type Form</a></b></font>";
		die();
	}
	echo 
	$sqlstr="insert into lms_file_type(file_name,status)Values('$cname',1)";
	execute($sqlstr) ;
	
 }
 else
 {
 	echo "<p align=\"Left\"><b>Please Enter Valid File Type Name</b></p>";
 }
?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="filetype.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>
