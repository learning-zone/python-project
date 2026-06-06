<html>
<head><?php
session_start();
require("../db.php");
$CourseName=$_GET[CourseName];
$CourseAbbr=$_GET[CourseAbbr];
if(strlen($CourseName) && strlen($CourseAbbr) )
{

	$sql1=execute("select * from course_m where coursename='$CourseName' or course_abbr='$CourseAbbr'") or die(error_description());

	if(rowcount($sql1)>0)
	{
		echo "<font color=red><b>Duplicate School Division details !! Cannot Save the Details..</b></font><br>";
		echo "<font color=red><b><a href=courseadd.php> << Back</a></b></font>";
		die();
	}
	$sqlstr="Insert Into coursehead (cname,activation) Values ('$CourseName','Y')";
	execute($sqlstr) or die("Cannot insert into coursehead table!");
	$m=execute("select max(id) from coursehead");
	$ma=fetcharray($m);
	$type=$ma[0];

	$sqlstr="Insert Into course_m (coursename,course_abbr,head_id) Values ('$CourseName','$CourseAbbr','$type')";
	execute($sqlstr) or die("Cannot insert into course table!");
	?>
    <SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="courseadd.php";
	 document.form1.submit();
	 }
	 </script>
        <?php 
       
}
else
{
	echo "<p align=\"Left\"><b>Please enter valid Coursename and Abbreviation</b></p>";
}
?></head>
<body onload="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>