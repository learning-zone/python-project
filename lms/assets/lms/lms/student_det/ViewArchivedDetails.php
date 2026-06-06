<html>
<head>
<?php
	session_start();
	include("../db.php");
?>

</head>
<body>
<?php
$branch=$_POST['branch'];
$class_section_id=$_POST['class_section_id'];
$sem=$_POST['sem'];
$studfname=$_POST['studfname'];
$app_no=$_POST['app_no'];
$a_sts=$_POST['a_sts'];
if($a_sts=='F' )
	$tname="student_m";
else
	$tname="archive_student";

	$sql.="select id,student_id,usn,first_name,last_name from $tname where id is not null and archive!='N'";
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
	if($class_section_id!='')
	{
	$sql.=" and class_section_id=$class_section_id  ";
	}
	
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
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
<input type="hidden" name="a_sts" value="<?php echo $a_sts ?>">
<table border=0 class=forumline align=center width='60%' cellspacing=0 cellpadding=0>
<tr><td align='center' class='head' colspan='4'><font size="4"><b>Student Details To MOdify</b></font></td>
</tr>
<tr height='25'>
<td Class="rowpic">Apllication No</td>

<td Class="rowpic">Student Name</td>
<td Class="rowpic">Action</td></tr>
<?php
    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
	 $r=fetcharray($rs);
?>
	<tr class='row<?php echo $rowclass ?>' height='25'> 
		<td>&nbsp; <?=$r[student_id]?></td>
		<td><?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>

<td><a href="ModifyArchiveStudentDetail.php?StudID=<?php echo $r[id]?>&a_sts=<?php echo $a_sts ?>">Activate</a>
</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
?>
</table>
</form>
</body>
</html>