<html>
<head>
<?php
session_start();
require("../db.php");
?>
</head>
<body>
<?php
$course=$_POST['course'];
$sem=$_POST['sem'];
$sel_section=$_POST['sel_section'];
$to_section=$_POST['to_section'];
$sel_student=$_POST['sel_student'];
$student_len=sizeof($sel_student);
for($i=0;$i<$student_len;$i++)
{
	$student_id=$sel_student[$i];

	$section_id=$sel_section;


	$sql="update student_m  set class_section_id=$to_section where id=$student_id and class_section_id=$section_id";

	execute($sql);

	$sql="update daily_att  set class_section_id=$to_section where id=$student_id and class_section_id=$section_id";

	execute($sql);




}
?>
<br>
<div align='center'><font color=#456853>Student Section Changed Succesfully.</font><br>
<a href="change_student_section.php?course=<?=$course?>&sem=<?=$sem?>&sel_section=<?=$sel_section?>&to_section=<?=$to_section?>" > <font color='red'>Click Here to Go Back.</font></a></div>
<!--Message-->

</body>
</html>
