<?php
session_start();
include("db.php");
$sql8=execute("select stud_id from exam_topers ");
while($r8=fetcharray($sql8))
{
	$sql9=execute("select class_section_id from student_m where id='$r8[0]'  ");
	while($r9=fetcharray($sql9))
	{
		execute("update exam_topers set sec_id='$r9[0]' where stud_id='$r8[0]' ");	
	}
}

$sql1=execute("select exam_id from exam_topers group by exam_id ");
while($r1=fetcharray($sql1))
{
	$sql3=execute("select sec_id from exam_topers where exam_id='$r1[0]' group by sec_id ");
	while($r3=fetcharray($sql3))
	{
		$sql2=execute("select total_mark from exam_topers where exam_id='$r1[0]' and sec_id='$r3[0]'  group by total_mark ORDER BY total_mark DESC ");
		$k=1;
		while($r4=fetcharray($sql2))
		{
			$sql7=execute("select id from exam_topers where exam_id='$r1[0]' and total_mark='$r4[0]' and sec_id='$r3[0]'  ");
			while($r7=fetcharray($sql7))
			{
				execute("update exam_topers set posi='$k' where id='$r7[0]' ");	
			}
			$k++;
		}
	}
}

?>