
<?php
session_start();
require("../db.php");
$course=$_POST['course'];
$sem=$_POST['sem'];
$sel_student=$_POST['sel_student'];
$sel_section=$_POST['sel_section'];
?>

<?php

$student_len=sizeof($sel_student);

if($sel_student!='')
{
for($i=0;$i<$student_len;$i++)
{
	$student_id=$sel_student[$i];
	$subject_id=$sel_elective;

	$sql="update student_m set class_section_id=$sel_section where id=$student_id";
	//echo $sql."<br>";
	execute($sql);

	/*$sql="update daily_att set class_section_id=$sel_section where id=$student_id";
	echo "$sql<br>";
	execute($sql) or die(mysql_error());
	*/


	if($sem==1 || $sem==2)
	{
		
		$sql="insert into major_master values(NULL,$student_id,$sel_section,$sem,$course,$major)";
		//echo "sql=$sql<br>";
		execute($sql);
	}


}


?>
<br>
<div align='center'><font color='#456853'>Student  are Applied to Section Succesfully.</font><br>
<a href="ViewStudentList.php?course=<?=$course?>&sem=<?=$sem?>&sel_elective=<?=$sel_elective?>&sel_section=<?=$sel_section?>" ><font color='red'><b> Click Here to Go Back.</b></font></a></div>
<?
	}

else
{
	echo "<font color='Red' size='3'><b>Please Select Student !..</b></font>";
}
?>

