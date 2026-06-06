<?php
session_start();
include("../db.php");

if($StudID!="")
{
	if($a_sts=='E')
	{	
		$sql="update student_archive set archive='N' where id=$StudID";
		execute($sql) or die(error_description());

		$sql="insert into student_m select * from student_archive where id=$StudID ";
		execute($sql) or die(error_description());

		$sql="delete from student_archive where id=$StudID";
		execute($sql) or die(error_description());

	}
	else
	{
		$sql="update student_m set archive='N' where id='$StudID'";
		mysql_query($sql) or die(mysql_error());
	}
}
?>
<table align='center' border='0'>

	 <tr><td align='center'><img src='<?php echo $image ?>' width='110' height='120'> </td></tr>
	<tr height='25'>
		<td><font size=2 color=blue face=verdana><b> <?php echo $fname ?>'s Details are Successfully Updated.</b></font></td>
	</tr>
</table>