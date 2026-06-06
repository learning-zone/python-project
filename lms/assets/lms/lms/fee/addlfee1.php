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
	window.open(finalVar,'Stud','height=700,width=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</SCRIPT>
</head>
<body>
<?php
$cyr=$_SESSION['AcademicYear'];
$sql="select id,student_id,first_name,last_name,admission_type,course_admitted,course_yearsem from student_m where archive='N'";
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
$sql.= " order by first_name";

$rs=execute($sql) or die(mysql_error());

if(rowcount($rs)==0)
{
	echo "<font color=><b>No Student Records Found !!</b></font>";
	die();
}
?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='50%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='3'><b>Student Details</b></td>
</tr>
<tr height='30'>
<td Class="rowpic" align='center' nowrap>Sl No</td>
<td Class="rowpic">&nbsp;&nbsp;&nbsp;Student ID</td>
<td Class="rowpic">&nbsp;&nbsp;&nbsp;Student Name</td>
<?php
$sno=1;
$flg=0;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	$kkk=fetcharray(execute("select head_id from course_m where course_id='$r[course_admitted]'"));
	
	$chksql=execute("select id from fee_master where studid=$r[id] and pid='$branch' and sid='$sem' and admid='$r[admission_type]' and accyr='$cyr' and status=0");
	if(rowcount($chksql)>0)
	{
		$flg=1;
		$crs=fetcharray($chksql);
		if($sno<10)
			$sno="0".$sno;
		?>
		<tr height='23'><td align='center'><?=$sno?></td>
		<td>&nbsp;&nbsp;&nbsp;
		<A HREF="javascript:OpenWind('add_addlfee.php?mid=<?php echo $crs[id]?>');"><?php echo $r[student_id] ?></A>	
		</td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
		</tr>
		<?php
		$sno++;
	}
}
if($flg==0)
{
	echo "</table><br>";
	echo "<font color=><b>Fee sturcture not applied to the students..!!</b></font>";
	die();
}
?>
</table>
</form>
</body>
</html>