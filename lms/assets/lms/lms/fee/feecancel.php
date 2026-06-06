<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<?php
	session_start();
	include("../db.php");
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
$cyr=$temp_year_detalis;
if($rcptno!='')
{
	$sql=execute("select id from fee_payment where docid='".strtoupper($rcptno)."' and recptstatus=0 and accyr='$cyr'");
	if(rowcount($sql)>0)
	{
		$rs=fetcharray($sql);
		header("Location:cancelfee.php?mid=$rs[0]");
	}
	else
	{
		echo "<font color=brown><b>Receipt number not Found !!</b></font>";
		die();
	}
}
else
{
	$sql="select id,student_id,first_name,last_name,admission_id,course_admitted,course_yearsem from student_m where archive='N'";
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
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
}
?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='60%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='3'><font size="4"><b>Student List</b></font></td>
</tr>
<tr height='30'>
<td Class="rowpic" nowrap align='center'>Sl No</td>
<td Class="rowpic">&nbsp;&nbsp;&nbsp;Student ID</td>
<td Class="rowpic">&nbsp;&nbsp;&nbsp;Student Name</td>
<?php
$sno=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
	 $r=fetcharray($rs);
	 if($sno<10)
		 $sno="0".$sno;
	?>
	<tr height='23'><td align='center'><?=$sno?></td>
		<td>&nbsp;&nbsp;&nbsp;
		   <A HREF="javascript:OpenWind('cancelfee1.php?stud_id=<?php echo $r[id]?>');"><?php echo $r[student_id] ?></A>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
	</tr>
	<?php
	$sno++;
	}
?>
</table>
</form>
</body>
</html>