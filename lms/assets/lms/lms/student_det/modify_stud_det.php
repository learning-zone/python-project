<html>
<head>
<?php
	session_start();
	include("../db.php");
?>
</head>
<body>
<?php
if(isset($_POST['studdet']))
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$class_section_id=$_POST['class_section_id'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];
}
else
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];

}
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
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='50%'>
<tr><td align='center' class='head' colspan='5'><font size="4"><b>Modify Student Details</b></font></td>
</tr>
<tr height='25'>
<td Class="rowpic" align='center'>Sl No</td>
<td Class="rowpic" align='center'>Student ID</td>
<td Class="rowpic" align='center'>Student Name</td></tr>
<?php
  $rowclass=1;
  $sno=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		if($sno<10)
			$sno="0".$sno;
		?>
		<tr class='row<?php echo $rowclass ?>' height='30'> 
		<td align='center'><?=$sno?></td>
		<td>&nbsp;&nbsp;
        <a href="modify_Apl.php?StudID=<?php echo $r[id]?>&app_num=<?php echo $app_num ?>&branch=<?php echo $branch ?>&sem=<?php echo $sem ?>&studfname=<?php echo $studfname ?>&a_year=<?php echo $a_year ?>&un=<?php echo $un ?>"><?=$r[student_id]?></a></td>
		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td></tr>
		<?php
		$sno++;
		$rowclass = 1 - $rowclass;
	}
?>
</table>
</form>
</body>
</html>


