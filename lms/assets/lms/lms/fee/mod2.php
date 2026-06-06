<html>
<head>
<?php
session_start();
include("../db.php");
?>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=800,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}

function reload_frm()
{
	document.frm1.action='id_card1.php'
	document.frm1.submit();
}

</SCRIPT>
</head>
<body>
<?php $branch=$_POST["branch"];
$sem=$_POST["sem"];
$class_section_id=$_POST["class_section_id"];

?>
<?php
	$sql="select id,student_id,first_name,last_name,admission_type,course_admitted,class_section_id,course_yearsem,academic_year from student_m where archive='N'";
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql.=" and class_section_id=$class_section_id";
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
	$rs=execute($sql) or die(mysql_error());
	if(rowcount($rs)==0)
	{
		echo "<font color=brown><b>No Student Records Found !!</b></font>";
		die();
	}
?>
<form name="frm" method="post" action="genfeedueint_recpt.php" >

<table border=1 class=forumline align=center width='60%' cellspacing='0' cellpadding='1'>
<tr><td align='center' class='head' colspan='5'><font size="4"><b>Student Details</b></font></td>
</tr>
<tr height='30'>
<td Class="rowpic" align='center' nowrap>Sl No</td>
<td Class="rowpic" align='center' nowrap>Student ID</td>
<td Class="rowpic" align='center' nowrap>Student Name</td>
<td Class="rowpic" align='center' nowrap>Class/Section</td>

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
	
	
	<A HREF="javascript:OpenWind('genfeedueint_recpt.php?stud_id=<?php echo $r[id]?>&day=<?= @$cdt1 ?>&mon=<?= @$cmt1 ?>&year=<?= @$cyr1 ?>&tmid=<?= @$tmid ?>');"><?php echo $r[student_id]?> </A>		
		  </td>
		<td>&nbsp;&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?php echo $r[last_name]?></td>
		<?php
		
		$cname=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));
		$secname=fetcharray(execute("select section_name from class_section where id='$r[class_section_id]'"));
		echo "<td align='center'>$cname[0] / $secname[0]</td>";
		?>
		
		
		</tr>
		<?php
		 $sno++;
	}
}
if($fg==0)
	die("<div><font color='brown'><b>First time fee receipt already generated for all students. Use Generate Addl Fee Receipt Link.</b></font></div>");	
?>
</table>
<table>
<div align="center"><input type="submit" class='bgbutton' value="Submit" name="studdet"></div>
</table></form>
</body>
</html>
