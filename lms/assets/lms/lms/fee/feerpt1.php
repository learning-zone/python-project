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
	window.open(finalVar,'Stud','height=600,width=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</SCRIPT>
</head>
<body>
<?php
	$sql="select id,student_id,first_name,last_name,admission_id,course_admitted,course_yearsem from student_m where archive='N'";
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
	$sql.=" order by first_name";
	//echo $sql;
	$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}

?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='60%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='5'><font size="4"><b>Student wise Fee Report</b></font></td>
</tr>
<tr height='30'>

<td Class="rowpic">&nbsp;&nbsp;&nbsp;Student Reg No</td>
<td Class="rowpic">&nbsp;&nbsp;&nbsp;Student Name</td>
<?php
	for($i=0;$i<rowcount($rs);$i++)
	{
	 $r=fetcharray($rs);
	?>
	<tr height='23'>
		<td>&nbsp;&nbsp;&nbsp;
		   <A HREF="javascript:OpenWind('feerpt2.php?stud_id=<?php echo $r[id]?>');"><?php echo $r[student_id] ?></A>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
	</tr>
	<?php
	}
?>
</table>
</form>
</body>
</html>