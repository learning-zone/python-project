<html>
<head>
<?php
	session_start();
	include("../db.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$app_no=$_POST['app_no'];
	$studfname=$_POST['studfname'];
	$academic_year=$_SESSION['AcademicYear'];
	
	//print_r($_POST);
?>
<script language='javascript'>


function reload_frm()
{
	<!--document.frm1.action='viewphotodet.php?student_id=$stid';-->
	document.frm1.submit();
}
</script>

</head>
<body>
<?php
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$app_no=$_POST['app_no'];
$stid=$_POST['stid'];
$a_year=$_POST['a_year'];
$un=$_POST['un'];
$studfname=$_POST['studfname'];
	$sql.="select id,student_id,student_id,first_name,last_name,course_yearsem from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
	if($app_no!='')
	{
	 $sql.=" and student_id='$app_no'";
	}
	
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and first_name like '$studfname%'";
	}
	 $sql.=" order by course_yearsem, first_name";
	$rs=execute($sql) or die(mysql_error());

	if(rowcount($rs)==0)
	{
		echo "<font>No Records Found !!";
		die();
	}

?>
<form method='post' action="viewphotodet_cafeteria.php" name="frm1" >
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<input type="hidden" name="a_year" value="<?php echo $a_year?>">
<input type="hidden" name="un" value="<?php echo $un ?>">
<br>
<table border=1 class=forumline align=center width='70%' cellspacing=0 cellpadding=0>
<tr><td align='center' class='head' colspan='5'>Select Student</td>
</tr>
<tr height='25'>

<td Class="rowpic">SL.No</td>
<td Class="rowpic">Student Id</td>
<td Class="rowpic">Student Name</td>
<td Class="rowpic">Grade</td>

<td width="15%" align='center' Class="rowpic">Select</td></tr>
<?php
    $rowclass=1;
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		$clnam=fetcharray(execute("select year_name from course_year where year_id='$r[course_yearsem]'"));

		
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
		?>
		<td>&nbsp;<?php echo ($i+1) ?></td>
		<td>&nbsp; <?php if($r[student_id]!="") echo $r[student_id]; else echo $r[student_id]; ?></td>
		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
		<td>&nbsp;&nbsp;<?=$clnam[0]?></td>
		<td align='center'>
        <input type='radio' name='stid' value='<?=$r[id]?>' onChange="reload_frm(0)"></td>


</tr>
<?php
	$rowclass = 1 - $rowclass;
	}
?></table>
<br>
<!--<div align='center'><input type="submit" class='bgbutton' value="Submit" name="studdet"></div>
--></form>
</body>
</html>
