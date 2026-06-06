<html>
<head>
<?php
session_start();
include("../db.php");
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$student_id=$_POST['student_id'];
$studfname=$_POST['studfname'];

?>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</SCRIPT>
</head>
<body>
<?php
	$sql="select id,student_id,first_name,last_name,admission_type,course_admitted,course_yearsem,academic_year,class_section_id from student_m where archive='N'";
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
	if($student_id!='')
	{
		$sql.=" and student_id='$student_id'";
	}
	$sql.=" order by course_admitted,course_yearsem,class_section_id,first_name";
	$rs=execute($sql) or die(mysql_error());
	if(rowcount($rs)==0)
	{
		echo "<font color=brown><b>No Student Records Found !!</b></font>";
		die();
	}
?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='60%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='4'><font size="4"><b>Student Details</b></font></td>
</tr>
<tr height='30'>
<td Class="rowpic" align='center' nowrap>Sl No</td>
<td Class="rowpic" align='center' nowrap>Student ID</td>
<td Class="rowpic" align='center' nowrap>Student Name</td>
<td Class="rowpic" align='center' nowrap>Section</td></tr>
<?php
$sno=1;
$fg=0;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	$cyr=$r[academic_year];
	$chkstud=execute("select id from fee_master where studid='$r[id]' and status=0 and pid='$r[course_admitted]' and sid='$r[course_yearsem]' and accyr='$cyr' and tmid='$tmid'");
	if(rowcount($chkstud)==0)
	{
		$fg=1;
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='23'><td align='center'>$sno</td>";
		?>
		<td>&nbsp;&nbsp;&nbsp;
		   <A HREF="javascript:OpenWind('generateReceipt.php?stud_id=<?php echo $r[id]?>&course=<?php echo $r[course_admitted] ?>&sem=<?php echo $r[course_yearsem] ?>&adm_id=<?php echo $r[admission_type] ?>&stud_yr=<?php echo $r[academic_year]?>');"><?php echo $r[student_id] ?></A>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
		<?php
		$cname=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		echo "<td align='center'>$cname[0] / $secname[0]</td></tr>";
		$sno++;
	}
}
if($fg==0)
	die("<div><font color='brown'><b>First time fee receipt already generated for all students. Use Generate Addl Fee Receipt Link.</b></font></div>");	
?>
</table>
</form>
</body>
</html>
