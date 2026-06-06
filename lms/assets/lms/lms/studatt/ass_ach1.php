<HTML>
<head>
<?php
session_start();
include("../db.php");
?>
</HEAD>
<?php
$sql = execute("SELECT * FROM users WHERE username='$user'") or die(error_description());
$rs=fetcharray($sql);
$UserId=$rs[id];
?>
<BODY>
<FORM NAME=frm METHOD=POST>
<table class='forumline' align='center' width='80%'>
<tr><td align='center' class='head'>Enter Students Mark</td></tr>
<tr><td class='row3' align='center'><font color='red'>**** Click on Subject Code to Select ****</font></td></tr>
<tr><td>
<?php

	$rs_course=execute("select distinct(a.course_id),a.year_id,c.year_name,a.class_section_id from staff_rights a,course_year c where a.year_id=c.year_id and a.staff_id='$UserId' order by a.course_id ,a.year_id,a.class_section_id") or die(error_description()."e1");

if(rowcount($rs_course)==0)
{
	die("<font color='red' size='4'>No Subject Rights Assigned...!!!</font>");
}
for($jj=0;$jj< rowcount($rs_course);$jj++)
{
	$r_course=fetcharray($rs_course,$jj);
	$Coradmit=$r_course[course_id];
	$courseyr=$r_course[year_id];
	$section_id=$r_course[class_section_id];
	if($section_id !=0)
	{
		$rs_section=execute("select section_name from class_section where id=$section_id");
		$r_section=fetcharray($rs_section);
		$section_name=$r_section[0]." - Section";
		mysql_free_result($rs_section);
	}
	else
	{
		$section_name='No Section';
	}
	if($Coradmit !=0)
	{
		$rs1_course=execute("select coursename from course_m where course_id=$Coradmit");
		$r1_course=fetcharray($rs1_course);
		$course_name=$r1_course[0];
	}
	
	$sqlstr1  = "SELECT b.subject_code, b.subject_name, b.sub_type, a.course_id, b.course_year_id, ";
	$sqlstr1 .= "a.subject_id,b.elective,a.subject_id,a.batch_id,b.sub_types FROM staff_rights a, subject_m b, course_m c, course_year d, ";
	$sqlstr1 .= "subjecttype e WHERE a.staff_id=$UserId and a.subject_id=b.subject_id and a.course_id=c.course_id and a.year_id= d.year_id ";
	$sqlstr1 .= "and a.subject_type=e.subtype_id and b.status=1 and a.course_id=$Coradmit and a.year_id=$courseyr and a.class_section_id=$section_id order by d.year_id,b.subject_code,a.class_section_id";
	//echo "query:$sqlstr1";
	$rs = execute($sqlstr1) or die(mysql_error()."eeee");
	$num = rowcount($rs);
	if($num == 0)
	{
		echo "<DIV ALIGN=CENTER><FONT COLOR=#FF0000 SIZE=2><B>Match Not Found</B></FONT></DIV>";
		die();
	}
	echo "<table class='forumline' align='center' width='100%'>";
	echo "<TBODY>";
	echo "<tr><td colspan=4 class='row3' align='center'><font size='2.5' color='blue'>$course_name :  $r_course[year_name] / $section_name</font></td></tr>";
	echo "<TR>";
	echo "<TD CLASS='row3' align='center' width='6%'><B>Sl. No.</B></TD>";
	echo "<TD CLASS='row3' align='center' width='28%'><B>Subject Code</B></TD>";
	echo "<TD CLASS='row3' align='center' width='66%'><B>Subject Name</B></TD>";
	echo "</TR>";
	$tempI = 1;
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		$practical_batch=$r[batch_id];
		if($practical_batch !=0)
		{
			$rs_batch=execute("select batch_name from batch_master where id=$practical_batch");
			$r_batch=fetcharray($rs_batch);
			$batch_name=" [".$r_batch[0]."]";
			mysql_free_result($rs_batch);
		}
		else
		{
			$batch_name='';
		}
		$ele="";
		if($r[sub_types]=='2')
		{
			$ele=" [Elective]";
		}
		elseif($r[sub_types]=='3')
		{
			$ele=" [Audit]";
		}
		elseif($r[sub_types]=='4')
		{
			$ele=" [Suplimentary]";
		}
		echo "<TR>";
		echo "<TD CLASS='row2' align='center'><B>$tempI</B></TD>";
		echo "<TD nowrap>";
		?>
		&nbsp;&nbsp;<A HREF="assach1.php?prm=<?=$Coradmit?>&sem=<?=$courseyr?>&sec=<?=$section_id?>&bid=<?=$practical_batch?>&subn=<?=$r[5]?>"><?=$r[0]?></A>
		<?
		echo "<font color='red'>$batch_name</font></TD>";
		echo "<TD CLASS='row2'><B>&nbsp;&nbsp;$r[1]</B><font color=brown>$ele</font></TD>";
		$tempI = $tempI + 1;
	}
	echo "</td></tr>";
	echo "</table>";
}
?>
</FORM>
</table>
</BODY>
</HTML>