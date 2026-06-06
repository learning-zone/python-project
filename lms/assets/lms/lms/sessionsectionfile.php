<?php
session_start();
include("db1.php");
//print_r($_GET);
$r=$_GET["r"];
$sem=$r;
	echo "	<select name='class_section_id' ><option value=''>---Select---</option>";
	$rs_section=execute("SELECT * FROM student_m a,class_section b WHERE a.archive='N' and a.class_section_id=b.id and course_yearsem='$sem' group by b.id");
		
	for($i=0;$i<rowcount($rs_section);$i++)
	
	{
	
	$r_section=fetcharray($rs_section,$i);
	
	if($class_section_id==$r_section[id])
	
	echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
	
	else
	
	echo "<option value='$r_section[id]'>$r_section[section_name]</option>";
	
	
	
	}
	echo "</select>";
?>
