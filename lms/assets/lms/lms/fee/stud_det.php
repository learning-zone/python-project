<html>
<head>
<?php
	session_start();
	include("../db.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$student_id=$_POST['student_id'];
	$admid=$_POST['admid'];

?>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud1','height=600,width=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</SCRIPT>
</head>
<body>
<?php
	$sql="select id,studid,pid,sid as sid1,balamt,admid from fee_master where pstatus=1 and status=0 and balamt>0";
	if($student_id!='')
	{
		$rsql=execute("select id from student_m where student_id='$student_id'");
		if(rowcount($rsql) > 0)
		{
			$r=fetcharray($rsql);
			$sql.=" and studid='$r[id]'";
			
		}
		else
			die("<font color=''><b>Student ID Wrong..!!!</b></font>");
	}
	if($branch!=0)
	{
		$sql.=" and pid=$branch";
	}
	if($sem!=0)
	{
		$ss=$sem;
		$sql.=" and sid='$ss'";
	}
	
	if($admid!=0)
	{
		$sql.=" and admid=$admid";
	}
	echo $sql;
	$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font color=><b>No Students List for selected condition !!</b></font>";
		die();
	}

?>
<form name="frm" method="post">
<table border=1 class=forumline align=center width='70%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='4'><font size="4"><b>Fee Due List</b></font></td>
</tr>
<tr height='30'>
<td Class="rowpic" align='center' nowrap>&nbsp;&nbsp;&nbsp;Sl No</td>
<td Class="rowpic" align='center' nowrap>&nbsp;&nbsp;&nbsp;Student ID</td>
<td Class="rowpic" align='center' nowrap>&nbsp;&nbsp;&nbsp;Student Name</td>
<td Class="rowpic" align='center' nowrap>&nbsp;&nbsp;&nbsp;Balance Amount</td></tr>
<?php
$sno=1;
for($i=0;$i<rowcount($rs);$i++)
{
	 $r=fetcharray($rs);
	 $sql1=execute("select student_id,first_name,last_name from student_m where id='$r[studid]'");
	 if(rowcount($sql1)==0)
		$sql1=execute("select student_id,first_name,last_name from student_archive where id='$r[studid]'");
	 if(rowcount($sql1)>0)
	{
		$r1=fetcharray($sql1);
		if($sno<10)
			 $sno="0".$sno;
			?>
			<tr height='23'>
			<td align='center'><?=$sno?></td>
			<td nowrap>&nbsp;&nbsp;
		   <A HREF="javascript:OpenWind('addlfeerpt1.php?mid=<?php echo $r[id]?>&stud_id=<?php echo $r[studid]?>&course=<?php echo $r[pid] ?>&sem=<?php echo $r[sid1] ?>&adm_id=<?php echo $r[admid]?>');"><?php echo $r1[student_id] ?></A>		
		  </td>
			<td nowrap>&nbsp;&nbsp;&nbsp;<?=$r1[first_name]?>&nbsp;<?php echo $r1[last_name]?></td>
			<td align='right'><?=$r[balamt]?>.00&nbsp;&nbsp;</td>
		</tr>
		<?php
		$sno++;
	}
}
?>
</table>
</form>
</body>
</html>