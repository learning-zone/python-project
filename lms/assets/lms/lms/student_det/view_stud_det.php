<html>
<head>
<?php
	session_start();
	include("../db.php");
?>

</head>
<script language="JavaScript">
		function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
<body>
<?php
$app_no=$_POST['app_no'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$_POST['studfname'];
$a_year=$_POST['a_year'];
$class_section_id=$_POST['class_section_id'];
$un=$_POST['un'];
	$sql.="select id,student_id,usn,first_name,last_name from student_m where id is not null and archive='N'";
	if($app_no!='')
	{
	 $sql.=" and student_id='$app_no'";
	}
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
	 $sql.=" and first_name='$studfname'";
	}
	if($a_year!=0)
	{
		$sql.=" and academic_year='$a_year'";
	}
	if($class_section_id!='')
	{
	$sql.=" and class_section_id=$class_section_id  ";
	}
	
	if($un!=0)
	{
        $sql.=" and usn='$un'";
    }
		$sql.=" order by first_name";
		$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}

?>
<form name="frm" method="post">
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<input type="hidden" name="a_year" value="<?php echo $a_year?>">
<input type="hidden" name="un" value="<?php echo $un ?>">

<table border=1 class=forumline cellpadding="0" cellspacing="0" align=center width='60%' >
<tr><td align='center' class='head' colspan='3'><font size="4"><b>View Student Details</b></font></td>
</tr>
<tr height='25'>
<td align="center" Class="rowpic">Slno</td>
<td align="center"  Class="rowpic">Student ID</td>
<td align="center"  Class="rowpic">Student Name</td>
</tr>
<?php
    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
	 $r=fetcharray($rs);
?>
	<tr class='row<?php echo $rowclass ?>' height='25'>
		<td align="center" ><?=$i+1?></td>
        <td align="center" ><a href="view_Apl.php?StudID=<?php echo $r[id]?>&app_num=<?php echo $app_num ?>&branch=<?php echo $branch ?>&sem=<?php echo $sem ?>&studfname=<?php echo $studfname ?>&a_year=<?php echo $a_year ?>&un=<?php echo $un ?>"><?=$r[student_id]?></a></td>
        
	
		<td  >&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>


</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
?>
</table>
<br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
</form>
</body>
</html>