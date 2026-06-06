<?php
session_start();
include("../db.php");
include("../urlaccess.php");
?>
<HTML>
<HEAD>
<TITLE>MIST</TITLE>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
 document.studret.action="Finalise_Marks_Percentage_Wise.php";
 document.studret.submit();
}
function frm_load()
{
 document.studret.action="View_Shortage_Attendance.php";
 document.studret.submit();
}
</script>
</HEAD>
<BODY>
<?php
	echo "<FORM METHOD=POST ACTION='report_student_percent_wise.php' NAME='studret'>";
	echo "<INPUT TYPE=HIDDEN NAME=type VALUE='$type'>";
	echo "<TABLE  class=forumline align=center>";
	echo "<TBODY>";
	echo "<tr><td class=head align=center colspan=2> View Students Percentage Wise</td></tr>";
	echo "<tr><td  align=center colspan=2>SELECT THE FOLLOWING:</td></tr>";
	echo "<TR>";
	echo "<TD WIDTH=30% ALIGN=LEFT ><B> Curriculam :</B></TD>";
	echo "<TD WIDTH=70% ALIGN=LEFT><SELECT NAME='course' onChange='frm_load()'>";
	if($course==0)
	{
	?>
		<option value=''>-- Select Curriculam --</option>
		<?php
	}
	$rs = execute("SELECT course_id,coursename FROM course_m order by coursename");
	$num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		$sel='';
		if($r[0]==$course)
		{
			$sel='selected';
		}
		echo "<OPTION VALUE='$r[0]' $sel >$r[1]</OPTION>";
	}

	echo "</SELECT></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD WIDTH=30% ALIGN=LEFT ><B>Academic Year:</B></TD>";
	$cy=date('Y');
	echo "<TD WIDTH=70% ALIGN=LEFT><SELECT NAME='acayr'>";
	echo "<OPTION VALUE=0>Select Year</OPTION>";
	$d=date('Y');
	$d1=$d+1;
	$d2=$d-2;
					for($m=$d2;$m<$d1;$m++)
					{
						$sel='';
					if($acayr==$m)
					{
						$sel='selected';
					}
					$n=$m+1;
					$n=substr($n,2);
						echo "<OPTION VALUE='$m' $sel>$m-$n</OPTION>";
					}
		echo "</SELECT></TD>";
		echo "</TR>";
		echo "<TR>";
		echo "<TD WIDTH=30% ALIGN=LEFT ><B>Class:</B></TD>";
		echo "<TD WIDTH=70% ALIGN=LEFT><SELECT NAME='course_year' onChange='frm_load()'>";
		echo "<OPTION VALUE=0>SELECT</OPTION>";
		if($course!=0)
		{
			$sar = "SELECT * FROM course_year ";
		}
		
	$r=execute($sar);
	$num = rowcount($r);
	for($i=0;$i<$num;$i++)
	{
		$rsy = fetcharray($r, $i);
		$sel='';
		if($rsy[0]==$course_year)
		{
			$sel='selected';
		}
		echo "<OPTION VALUE='$rsy[0]' $sel >$rsy[1]</OPTION>";
	}
	echo "</SELECT></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD WIDTH=30% ALIGN=LEFT ><B> Section:</B></TD>";
	echo "<TD WIDTH=70% ALIGN=LEFT><SELECT NAME='course_section' onChange='frm_load()'>";
	$r1 = execute("SELECT * FROM class_section ");
	$num1 = rowcount($r1);
	for($i=0;$i<$num1;$i++)
	{
		$rsy1 = fetcharray($r1, $i);
		$sel='';
		if($rsy1[0]==$course_section)
		{
			$sel='selected';
		}
		echo "<OPTION VALUE='$rsy1[0]' $sel >$rsy1[1]</OPTION>";
	}
	echo "</SELECT></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "<TD WIDTH=30% ALIGN=LEFT ><B>Sessional :</B></TD>";
	if($course_year == 0)
	{
		die();
	}
	else
	{
		$rs=execute("select * from sessional_msaster where Course_ID='$course' and Course_Year_ID='$course_year' AND Academic_Year=$acayr");
		echo "select * from sessional_master where Course_ID='$course' and Course_Year_ID='$course_year' AND Academic_Year=$acayr";

		if(rowcount($rs)==0)
		{
			echo "<TD WIDTH=70% ALIGN=LEFT><font color='red'><b> Add Sessionals Details first</b></font></td>";
			die();
		}
		else
		{
			echo "<TD WIDTH=70% ALIGN=LEFT><SELECT NAME='Sessions'>";

			$num = rowcount($rs);
			for ($i=0;$i<$num;$i++)
			{
				$r = fetcharray($rs, $i);
				$sel='';
				if($r[2]==$Sessions)
				{
					$sel='selected';
				}
				echo "<OPTION VALUE='$r[2]' $sel >$r[2]</OPTION>";
			}
			echo "</SELECT></TD>";
		}
	}
echo "</TR>";
echo "<tr>";
echo "<td> Percentage</td>";
echo "<td   align=left>";
echo "<b>From %tage </b><input type='text' name='per_from' value=0 size=3>";
echo "<b>To %tage </b><input type='text' name='per_to' value=0 size=3>";
echo "</td></tr>";

if($course!=0)
{
	echo "<TR>";
	echo "<TD WIDTH=30% ALIGN=LEFT ><B>Select Subject :</B></TD>";
	$sql="select * from subject_m where course_id=$course and course_year_id=$course_year";
	$sql  = "SELECT distinct(a.subject_id), a.subject_name,a.subject_code FROM subject_m a,marks_m b WHERE a.subject_id=b.subject_id and a.course_id=$course and a.course_year_id=$course_year  ORDER BY a.subject_id ASC";
	$rs=execute($sql);
if(rowcount($rs) >0)
{
	echo "<td>";
	echo "<select name='subject[]' size='4' multiple>";

	for($i=0;$i< rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
		echo "<option value=$r[0] selected> $r[subject_code] - $r[subject_name]</option>";

	}
	echo "</select>";
	echo "</td>";
	echo "</tr>";
	echo "<TR>";
	echo "<TD COLSPAN=2 WIDTH=80% ALIGN=center>";
	echo "<INPUT TYPE=SUBMIT class=bgbutton NAME='studmoddel' VALUE='Submit'></TD>";
	echo "</TR>";
}
else
{
	echo "<font color='red'><b>Subject Details are not entered.</b></font>";
	die();

}
}
else
{
	echo "<TR>";
	echo "<TD WIDTH=30% ALIGN=LEFT ><B>Select Subject :</B></TD>";

//for subjects display of first and second sem
		$MySubCodeArray=array();
		$SubjectName=array();
		$Subjectcode=array();
		$tsql_1=execute("select distinct(maj_id) from major_master where section_id=$course_section and sem_id=$course_year");
		$rs_tgsql1=fetcharray($tsql_1);
		if(is_null($rs_tgsql1[0]))
		{
			echo "<font color=red><b>Please Enter Students</b></font><br><br>";
			die();
		}
		$tsql=execute("select * from common_m where course_year_id=$course_year");
		for($ki=0;$ki<rowcount($tsql);$ki++)
		{
			$trs=fetcharray($tsql,$ki);
			$MySubCodeArray[$ki]="common_m_".$trs["subject_id"];
			$SubjectName[$ki]=$trs["subject_name"];
			$Subjectcode[$ki]=$trs["subject_id"];
		}
		$tsql1=execute("select * from major where major_id=$rs_tgsql1[0] and course_year_id=$course_year");
		for($kii=0;$kii<rowcount($tsql1);$kii++)
		{
			$trs1=fetcharray($tsql1,$kii);
			$MySubCodeArray[$ki]="major_".$trs1["id"];
			$SubjectName[$ki]=$trs1["subject_name"];
			$Subjectcode[$ki]=$trs1["id"];
			$ki++;
		}

	echo "<td>";
	echo "<select name='subject[]' size='4' multiple>";
	for($i=0;$i< sizeof($MySubCodeArray);$i++)
	{
		echo "<option value=$Subjectcode[$i] selected> $SubjectName[$i]</option>";
	}
		echo "</select>";
		echo "</td>";
		echo "</tr>";
		echo "<TR>";
		echo "<TD COLSPAN=2 WIDTH=80% ALIGN=center>";
		echo "<INPUT TYPE=SUBMIT class=bgbutton NAME='studmoddel' VALUE='Submit' onclick=go()></TD>";
		echo "</TR>";
}
echo "</TBODY>";
echo "</TABLE>";
echo "</FORM>";
echo "</BODY>";
echo "</HTML>";
?>