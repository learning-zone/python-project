<html>
<head>
<?php
session_start();
include("../db.php");
$Country=$_GET['Country'];
if(strlen($Country))
{
$sql1=execute("select * from country where country_name='$Country'") or die(error_description());
if(rowcount($sql1)>=1)
{
	echo "<font color=red><b>Duplicate Country Entered !! Cannot Save Details</b></font><br>";
	echo "<font color=red><b><a href=addcountry.php>Back to Add Country Form</a></b></font>";
	die();
}
	$sqlstr="Insert Into country(country_name) Values ('$Country')";
	execute($sqlstr)
  	     or die("Cannot insert into country table!");

	
 }
 else
 {
 	echo "<p align=\"Left\"><b>Please enter valid Country Name</b></p>";
 }
?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="addcountry.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>
